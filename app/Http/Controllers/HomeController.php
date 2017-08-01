<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        $num_prov = DB::table('proveedores')
            ->count();

        $num_cli = DB::table('clientes')
            ->count();


        //Pagos Pendientes Proveedor

        $pend_prov = DB::table('dte_recibidos')
            ->whereColumn('total','<>', 'pagado')
            ->count();

        $pend_prov_peso = DB::table('dte_recibidos')
            ->whereColumn('total','<>', 'pagado')
            ->sum('total');

        $pagado_prov = DB::table('dte_recibidos')
            ->whereColumn('total', 'pagado')
            ->sum('total');

        //Pagos Pendientes Cliente

        $pend_cli = DB::table('dte_emitidos')
            ->whereColumn('total','<>', 'pagado')
            ->count();

        $pend_cli_peso = DB::table('dte_emitidos')
            ->whereColumn('total','<>', 'pagado')
            ->sum('total');

        $pagado_cli = DB::table('dte_emitidos')
            ->whereColumn('total', 'pagado')
            ->sum('total');


        return view('adminlte::home', [
            'num_cli'=>$num_cli,
            'num_pro'=>$num_prov,
            'pend_pro'=>$pend_prov,
            'pend_pro_peso'=>$pend_prov_peso,
            'pagado_pro' =>$pagado_prov,
            'pend_cli' => $pend_cli,
            'pend_cli_peso' =>$pend_cli_peso,
            'pagado_cli' => $pagado_cli
        ]);
    }
}