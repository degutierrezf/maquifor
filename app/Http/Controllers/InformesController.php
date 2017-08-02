<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\DTE_E;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class InformesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pagos_r()
    {

        $dte_r = DB::table('dte_recibidos')
            ->join('proveedores','id_proveedor','=','proveedores_id_proveedor')
            ->join('tipos_documento','id_t_doc', '=', 'tipos_documento_id_t_doc')
            ->whereColumn('dte_recibidos.pagado', 'dte_recibidos.total')
            ->get();

        return view('Informes.pagos_r', [
            'dte_r'=>$dte_r
        ]);
    }

    public function pagos_e()
    {

        $dte_e = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->join('tipos_documento','id_t_doc', '=', 'tipos_documento_id_t_doc')
            ->whereColumn('dte_emitidos.pagado', 'dte_emitidos.total')
            ->get();

        return view('Informes.pagos_e', [
            'dte_e'=>$dte_e
        ]);
    }

    public function pagos_r_pend()
    {
        $dte_r = DB::table('dte_recibidos')
            ->join('proveedores','id_proveedor','=','proveedores_id_proveedor')
            ->join('tipos_documento','id_t_doc', '=', 'tipos_documento_id_t_doc')
            ->whereColumn('dte_recibidos.pagado','<>' ,'dte_recibidos.total')
            ->get();

        return view('Informes.pagos_pend_r', [
            'dte_r'=>$dte_r
        ]);
    }

    public function pagos_e_pend()
    {
        $dte_e = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->join('tipos_documento','id_t_doc', '=', 'tipos_documento_id_t_doc')
            ->whereColumn('dte_emitidos.pagado', '<>', 'dte_emitidos.total')
            ->get();

        return view('Informes.pagos_pend_e', [
            'dte_e'=>$dte_e
        ]);
    }

    public function info_cli(){

        $cli = DB::table('clientes')
                ->get();

        return view('Informes.informe_cliente', [
            'cli' => $cli
        ]);
    }

    public function generar(){

        $nom_cli = DB::table('clientes')
            ->get();
        $f_ini = $_POST['f_ini'];
        $f_fin = $_POST['f_fin'];
        $cli = $_POST['cliente'];

        $res = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->where('clientes_id_cliente', $cli)
            ->wheredate('fecha','>=',$f_ini.' 00:00:00')
            ->wheredate('fecha','<=',$f_fin.' 00:00:00')
            ->get();

        $total_n = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->where('clientes_id_cliente', $cli)
            ->wheredate('fecha','>=',$f_ini.' 00:00:00')
            ->wheredate('fecha','<=',$f_fin.' 00:00:00')
            ->sum('neto_doc');

        $total_i = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->where('clientes_id_cliente', $cli)
            ->wheredate('fecha','>=',$f_ini.' 00:00:00')
            ->wheredate('fecha','<=',$f_fin.' 00:00:00')
            ->sum('iva');

        $total_t = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->where('clientes_id_cliente', $cli)
            ->wheredate('fecha','>=',$f_ini.' 00:00:00')
            ->wheredate('fecha','<=',$f_fin.' 00:00:00')
            ->sum('total');

        $num_doc = DB::table('dte_emitidos')
            ->join('clientes','id_cliente','=','clientes_id_cliente')
            ->where('clientes_id_cliente', $cli)
            ->wheredate('fecha','>=',$f_ini.' 00:00:00')
            ->wheredate('fecha','<=',$f_fin.' 00:00:00')
            ->count();


        return view('Informes.informe_clientes', [
            'informe'=>$res,
            'total_n' => $total_n,
            'total_i' => $total_i,
            'total_t' => $total_t,
            'num_doc' => $num_doc,
            'cli' => $nom_cli
        ]);
    }

    public function chile(){

        $movimientos = DB::table('depositos')
            ->join('pagos_recibidos','pagos_recibidos_id_pago_r','=','id_pago_r')
            ->join('dte_emitidos','dte_emitidos_id_dte_e','=','id_dte_e')
            ->join('tipos_docs_pago', 'tipos_docs_pago_id_tipo_docs_p','=','id_tipo_docs_p')
            ->where('cuentas_pagos_id_cuentas', 1)
            ->orderBy('id_depositos', 'desc')
            ->get();

        return view('Informes.chile',[
           'movi' => $movimientos
        ]);

    }

    public function santander(){

        $movimientos = DB::table('depositos')
            ->join('pagos_recibidos','pagos_recibidos_id_pago_r','=','id_pago_r')
            ->join('dte_emitidos','dte_emitidos_id_dte_e','=','id_dte_e')
            ->join('tipos_docs_pago', 'tipos_docs_pago_id_tipo_docs_p','=','id_tipo_docs_p')
            ->where('cuentas_pagos_id_cuentas', 2)
            ->orderBy('id_depositos', 'desc')
            ->get();

        return view('Informes.santander',[
            'movi' => $movimientos
        ]);

    }

    public function cajachica(){

        $movimientos = DB::table('depositos')
            ->join('pagos_recibidos','pagos_recibidos_id_pago_r','=','id_pago_r')
            ->join('dte_emitidos','dte_emitidos_id_dte_e','=','id_dte_e')
            ->join('tipos_docs_pago', 'tipos_docs_pago_id_tipo_docs_p','=','id_tipo_docs_p')
            ->where('cuentas_pagos_id_cuentas',3)
            ->orderBy('id_depositos', 'desc')
            ->get();

        return view('Informes.cajachica',[
            'movi' => $movimientos
        ]);

    }

    public function cheques(){

        $cheques = DB::table('pagos_recibidos')
            ->join('dte_emitidos', 'dte_emitidos_id_dte_e', '=', 'id_dte_e')
            ->join('clientes', 'clientes_id_cliente', '=', 'id_cliente')
            ->where('estado_p_r','<>',2)
            ->where('tipos_docs_pago_id_tipo_docs_p','=','1')
            ->orderBy('fecha_cobro', 'asc')
            ->get();

        return view('Informes.cheques',[
            'cheques' => $cheques
        ]);

    }

}