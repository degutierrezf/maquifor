<?php

namespace App\Http\Controllers;

use App\Proveedores;
use Illuminate\Http\Request;
use DB;
use Illuminate\Contracts\Session\Session;
use App\Clientes;

class dteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function GuardarEmitido()
    {

        try {
            $fecha = $_POST['fecha_em'];
            $num_doc = $_POST['n_doc'];
            $netodoc = $_POST['neto'];
            $iva = $_POST['iva'];
            $otro_i = $_POST['otro_impuesto'];
            $total = $_POST['total'];
            $obs = $_POST['obs'];
            $estado = 0;
            $tipo_doc = $_POST['tipo'];
            $fec_ven = $_POST['fecha_ven'];
            $cli = $_POST['id_cliente'];

            DB::table('dte_emitidos')->Insert([
                'fecha' => $fecha,
                'num_dte' => $num_doc,
                'neto_doc' => $netodoc,
                'iva' => $iva,
                'otro_imp' => $otro_i,
                'total' => $total,
                'obs' => $obs,
                'pagado' => 0,
                'estado_dte' => $estado,
                'tipos_documento_id_t_doc' => $tipo_doc,
                'fec_vencimiento' => $fec_ven,
                'clientes_id_cliente' => $cli
            ]);

                return redirect('Clientes/DTE')->with('status', 'DTE Asignada al Cliente!');
            } catch (\Illuminate\Database\QueryException $ex) {
               return redirect('Clientes/DTE')->with('error', 'ERROR, No se asigno la DTE al Cliente!');
            }

    }

    public function DetalleDTE_R(){

        $id = $_POST['id_dte'];

        $total = DB::table('dte_recibidos')
                ->where('id_dte_r','=', $id)
                ->sum('total');

        $sum = DB::table('pagos_emitidos')
                ->where('dte_recibidos_id_dte_r','=', $id)
                ->sum('valor_doc');

        $pend = $total - $sum;

        $DTEs = DB::table('pagos_emitidos')
                ->join('dte_recibidos', 'id_dte_r', '=','dte_recibidos_id_dte_r')
                ->join('tipos_docs_pago', 'id_tipo_docs_p', '=', 'tipos_docs_pago_id_tipo_docs_p')
                ->where('dte_recibidos_id_dte_r','=', $id)
                ->get();

        return view('Dte.detalle_dte_r', [
            'dte' => $DTEs,
            'sum' => $sum,
            'id_dte' => $id,
            'total' => $total,
            'pend' => $pend
        ]);
    }

    public function DetalleDTE_E(){

        $id = $_POST['id_dte'];

        $total = DB::table('dte_emitidos')
            ->where('id_dte_e','=', $id)
            ->sum('total');

        $sum = DB::table('pagos_recibidos')
            ->where('dte_emitidos_id_dte_e','=', $id)
            ->sum('valor_doc');

        $cobra = DB::table('dte_emitidos')
            ->where('id_dte_e','=', $id)
            ->sum('cobrado');

        $DTEs = DB::table('pagos_recibidos')
            ->join('dte_emitidos', 'id_dte_e', '=','dte_emitidos_id_dte_e')
            ->join('tipos_docs_pago', 'id_tipo_docs_p', '=', 'tipos_docs_pago_id_tipo_docs_p')
            ->where('dte_emitidos_id_dte_e','=', $id)
            ->get();

        $cuentas = DB::table('cuentas_pagos')
            ->get();

        return view('Dte.detalle_dte_e', [
            'dte' => $DTEs,
            'sum' => $sum,
            'id_dte' => $id,
            'total' => $total,
            'cobra' => $cobra,
            'cuentas' => $cuentas
        ]);
    }

    public function GuardarRecibido()
    {

        try {
            $fecha = $_POST['fecha_em'];
            $num_doc = $_POST['n_doc'];
            $netodoc = $_POST['neto'];
            $iva = $_POST['iva'];
            $otro_i = $_POST['otro_impuesto'];
            $total = $_POST['total'];
            $obs = $_POST['obs'];
            $estado = 1;
            $tipo_doc = $_POST['tipo'];
            $fec_ven = $_POST['fecha_ven'];;
            $pro = $_POST['id_proveedor'];;

            DB::table('dte_recibidos')->Insert([
                'fecha' => $fecha,
                'num_doc' => $num_doc,
                'neto_doc' => $netodoc,
                'iva' => $iva,
                'otro_imp' => $otro_i,
                'total' => $total,
                'obs' => $obs,
                'pagado' => 0,
                'estado' => $estado,
                'tipos_documento_id_t_doc' => $tipo_doc,
                'fec_vencimiento' => $fec_ven,
                'proveedores_id_proveedor' => $pro
            ]);

            return redirect('Proveedores/DTE')->with('status', 'DTE Asignada al Proveedor!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('Proveedores/DTE')->with('error', 'ERROR, No se asigno la DTE al Proveedor!');
        }

    }

    public function FichaDTE(){


        $id = $_POST['id'];

        $cli_pro = DB::table('clientes')
                ->leftjoin('dte_emitidos', 'id_cliente', '=', 'clientes_id_cliente')
                ->where('id_cliente', $id)
                ->get();


        return view('Dte.ficha_dte',
            [
                'cli_pro'=>$cli_pro
        ]);

    }

    public function pro_nc(){

        $proveedores = Proveedores::where('estado','<>',2)->get();

        return view('Proveedores.recibir_nc', [
            'proveedores' => $proveedores,
        ]);
    }

    public function cli_nc(){

        $clientes = Clientes::where('estado','<>',2)->get();

        return view('Clientes.emitir_nc', [
            'clientes' => $clientes,
        ]);
    }

    public function cli_emitir(){

        try{

        $id = $_POST['id_cliente'];
        $fecha = $_POST['fecha_em'];
        $n_doc = $_POST['n_doc'];
        $neto = $_POST['neto'];
        $iva = $_POST['iva'];
        $o_imp = $_POST['otro_impuesto'];
        $total = $_POST['total'];
        $obs = $_POST['obs'];

        DB::table('nc_emitidas')->Insert([
            'fecha' => $fecha,
            'num_doc' => $n_doc,
            'neto_doc' => $neto,
            'iva' => $iva,
            'otro_imp' => $o_imp,
            'total' => $total,
            'obs' => $obs,
            'estado' => 1,
            'cliente_id_cliente' => $id
        ]);

        return redirect('Clientes/NC')->with('status', 'NC Asignada al Cliente!');
        } catch (\Illuminate\Database\QueryException $ex) {
        return redirect('Clientes/NC')->with('error', 'ERROR, No se asigno la NC al Cliente!');
        }

    }

    public function pro_recibir(){

        try{

            $id = $_POST['id_proveedor'];
            $fecha = $_POST['fecha_em'];
            $n_doc = $_POST['n_doc'];
            $neto = $_POST['neto'];
            $iva = $_POST['iva'];
            $o_imp = $_POST['otro_impuesto'];
            $total = $_POST['total'];
            $obs = $_POST['obs'];

            DB::table('nc_recibidas')->Insert([
                'fecha' => $fecha,
                'num_doc' => $n_doc,
                'neto_doc' => $neto,
                'iva' => $iva,
                'otro_imp' => $o_imp,
                'total' => $total,
                'obs' => $obs,
                'estado' => 1,
                'proveedor_id_proveedor' => $id
            ]);

            return redirect('Proveedores/NC')->with('status', 'NC Asignada al Proveedor!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('Proveedores/NC')->with('error', 'ERROR, No se asigno la NC al Proveedor!');
        }

    }

    public function Depositar(){

        // ID PAGO
        $id_pago_r = $_POST['id_pago'];
        $id_cuenta = $_POST['id_cuenta'];

        $fecha = date_create();

        $monto = DB::table('pagos_recibidos')
            ->where('id_pago_r', $id_pago_r)
            ->sum('valor_doc');


        DB::table('depositos')->insert([
           'fecha_dep' => $fecha,
            'monto' => $monto,
            'cuentas_pagos_id_cuentas' => $id_cuenta,
            'pagos_recibidos_id_pago_r' => $id_pago_r
        ]);

       // printf($monto);
        //die();

        DB::table('pagos_recibidos')
            ->where('id_pago_r',$id_pago_r)
            ->update(['estado_p_r' => 1]);

        return redirect('Clientes/DTEs');
    }

    public function Aprobar(){

        // ID PAGO
        $id_pago_r = $_POST['id_pago_dte'];

        // ID DTE
        $id_dte = DB::table('pagos_recibidos')
            ->where('id_pago_r', '=', $id_pago_r)
            ->sum('dte_emitidos_id_dte_e');

        DB::table('pagos_recibidos')
            ->where('id_pago_r',$id_pago_r)
            ->update(['estado_p_r' => 2]);

        $val_actual = DB::table('dte_emitidos')
            ->where('id_dte_e',$id_dte)
            ->sum('cobrado');

        $val_doc = DB::table('pagos_recibidos')
            ->where('id_pago_r', '=', $id_pago_r)
            ->sum('valor_doc');

        $val_final = $val_doc + $val_actual;

        DB::table('dte_emitidos')
            ->where('id_dte_e',$id_dte)
            ->update(['cobrado' => $val_final]);

        return redirect('Clientes/DTEs');
    }

    public function AprobarFactura(){

        // ID Factura
        $id_dte = $_POST['id_dte'];

        DB::table('dte_emitidos')
            ->where('id_dte_e',$id_dte)
            ->update(['estado_dte' => 2]);

        return redirect('Clientes/DTEs');
    }

}
