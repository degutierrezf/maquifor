<?php

namespace App\Http\Controllers;

use App\Comunas;
use App\DTE_R;
use App\Proveedores;
use Illuminate\Http\Request;
use DB;

class ProveedoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        $comunas = Comunas::orderBy('comunas')->get();

        return view('Proveedores.index', ['comunas' => $comunas]);
    }

    public function Listar()
    {

        $proveedores = Proveedores::get();
        $activos = Proveedores::where('estado', 1)->count();
        $inactivos = Proveedores::where('estado', 2)->count();
        $otros = Proveedores::where('estado', 3)->count();
        $total = Proveedores::count();

        return view('Proveedores.mostrar', [
            'proveedores' => $proveedores,
            'act' => $activos,
            'ina' => $inactivos,
            'otros' => $otros,
            'total' => $total
        ]);
    }

    public function GuardarNuevoPago()
    {

        $fecha = $_POST['fecha'];
        $num_doc = $_POST['n_doc'];
        $valor_doc = $_POST['max_total'];
        $obs = $_POST['obs'];
        $fecha_cobro = $_POST['fecha_cobro'];
        $banca = $_POST['banco'];
        $dte_emitidos_id_dte_r = $_POST['id_fact'];
        $tipos_docs_pago_id_tipo_docs_p = $_POST['tipo'];

        DB::table('pagos_emitidos')->Insert([
            'fecha' => $fecha,
            'num_doc' => $num_doc,
            'valor_doc' => $valor_doc,
            'obs' => $obs,
            'fecha_cobro' => $fecha_cobro,
            'plaza' => $banca,
            'dte_recibidos_id_dte_r' => $dte_emitidos_id_dte_r,
            'tipos_docs_pago_id_tipo_docs_p' => $tipos_docs_pago_id_tipo_docs_p
        ]);

        return back();
    }

    public function GuardarNuevo()
    {

        $rut = $_POST['rut'];
        $rs = $_POST['r_soc'];
        $giro = $_POST['giro'];
        $dir = $_POST['direccion'];
        $com = $_POST['comunas'];
        $tel = $_POST['telefono'];
        $mail = $_POST['correo'];
        $obs = $_POST['obs_cli'];
        $est = 1;

        DB::table('proveedores')->Insert([
            'rut' => $rut,
            'rsocial' => $rs,
            'giro' => $giro,
            'direccion' => $dir,
            'telefono' => $tel,
            'mail' => $mail,
            'obs_pro' => $obs,
            'estado' => $est,
            'comunas_id_comunas' => $com
        ]);

        return back();
    }

    public function emitir_dte()
    {
        $tipodoc = DB::table('tipos_documento')->get();

        $proveedores = Proveedores::where('estado','<>',2)->get();
        $activos = Proveedores::where('estado', 1)->count();
        $inactivos = Proveedores::where('estado', 2)->count();
        $otros = Proveedores::where('estado', 3)->count();
        $total = Proveedores::count();

        $total_a = DB::table('dte_recibidos')
            ->whereYear('fecha', date("Y"))
            ->sum('neto_doc');

        $total_m = DB::table('dte_recibidos')
            ->whereMonth('fecha', date("m"))
            ->sum('neto_doc');

        $total_i = DB::table('dte_recibidos')
            ->whereMonth('fecha', date("m"))
            ->sum('iva');

        $num_fac = DB::table('dte_recibidos')
            ->whereMonth('fecha', date("m"))
            ->count('id_dte_r');

        return view('Proveedores.recibir_dte', [
            'proveedores' => $proveedores,
            'act' => $activos,
            'ina' => $inactivos,
            'otros' => $otros,
            'total' => $total,
            'total_a' => $total_a,
            'total_m' => $total_m,
            'total_i' => $total_i,
            'num_fac' => $num_fac,
            'tipo_doc' => $tipodoc
        ]);
    }

    public function revisar_dte()
    {

        $total_a = DB::table('dte_recibidos')
            ->whereYear('fecha', date("Y"))
            ->sum('neto_doc');

        $total_m = DB::table('dte_recibidos')
            ->whereMonth('fecha', date("m"))
            ->sum('neto_doc');

        $total_i = DB::table('dte_recibidos')
            ->whereMonth('fecha', date("m"))
            ->sum('iva');

        $num_fac = DB::table('dte_recibidos')
            ->whereMonth('fecha', date("m"))
            ->count('id_dte_r');

        $tipo_pag = DB::table('tipos_docs_pago')->get();
        $bancos = DB::table('bancos')->get();

        $dte_r = DTE_R::join('proveedores', 'proveedores_id_proveedor', '=', 'id_proveedor')
            ->whereColumn('total','<>', 'pagado')
            ->get();

        return view('Proveedores.revisar_dte_r', [
            'dte_r' => $dte_r,
            'tipo_pg' => $tipo_pag,
            'total_a' => $total_a,
            'total_m' => $total_m,
            'total_i' => $total_i,
            'num_fac' => $num_fac,
            'bancos' => $bancos
        ]);
    }

    public function Modificar()
    {

        $id = $_POST['rut'];
        $nombre = $_POST['razon'];
        $giro = $_POST['giro'];
        $fono = $_POST['fono'];
        $mail = $_POST['mail'];

        DB::table('proveedores')
            ->where('rut', $id)
            ->update([
                'rsocial' => $nombre,
                'giro' => $giro,
                'telefono' => $fono,
                'mail' => $mail
            ]);

        return back();

    }

    public function Eliminar()
    {

        $id = $_POST['rut_del'];

        DB::table('proveedores')
            ->where('rut', $id)
            ->update(['estado' => 2]);

        return back();
    }
}
