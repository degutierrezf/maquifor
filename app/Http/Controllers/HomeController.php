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


        $num_cli = DB::table('clientes')
            ->count();

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
            'pend_cli' => $pend_cli,
            'pend_cli_peso' =>$pend_cli_peso,
            'pagado_cli' => $pagado_cli
        ]);
    }
}