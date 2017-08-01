@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Listar Pagos por DTE
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - DETALLE DTE PAGO -
@endsection

@section('main-content')

    <div class="row">
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">$ Total</span>
                    <span class="info-box-number">$ {{  number_format($total,0,',','.') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">$ Documentado</span>
                    <span class="info-box-number">$ {{  number_format($sum,0,',','.') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">$ Cobrado</span>
                    <span class="info-box-number">$ {{  number_format($cobra,0,',','.') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <br><br>
    <div class="info-box">
        <div class="box-header">
            <h3 class="box-title">Detalle de Pagos Factura</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nº FACTURA</th>
                    <th>$ PAGO</th>
                    <th>$ TOTAL</th>
                    <th>FECHA COBRO</th>
                    <th>FORMA DE PAGO</th>
                    <th>PLAZA</th>
                    <th>ESTADO</th>
                    <th>ACCION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dte as $dte)
                    <tr>
                        <td>{{  $dte -> num_doc }}</td>
                        <td>$ {{  number_format($dte -> valor_doc,0,',','.') }}</td>
                        <td>$ {{  number_format($dte -> total,0,',','.') }}</td>
                        <td>{{ $dte -> fecha_cobro }}</td>
                        <td>{{ $dte -> tipos_docs_pago }}</td>
                        <td>{{ $dte -> plaza }}</td>
                        <td>
                            <center>
                                    @if( $dte -> estado_p_r == 0)
                                        <button type="button" class="btn col-sm-10 btn-warning btn-xs" data-toggle="tooltip"
                                                title="DOCUMENTADO">
                                            <i class="fa fa-info"></i> DOCUMENTADO
                                        </button>
                                    @elseif($dte->estado_p_r == 1)
                                        <button type="button" class="btn col-sm-10 btn-primary btn-xs" data-toggle="tooltip"
                                                title="DEPOSITADO">
                                            <i class="fa fa-dollar"></i> DEPOSITADO
                                        </button>
                                    @else
                                        <button type="button" class="btn col-sm-10 btn-success btn-xs" data-toggle="tooltip"
                                                title="APROBADO CE">
                                            <i class="fa fa-check"></i> APROBADO
                                        </button>
                                @endif
                            </center>
                        </td>
                        <td>
                            @if( $dte -> estado_p_r == 0 && Auth::user()->level!=2)
                            <form action="{{ url('Depositar') }}" method="post">
                                <input type="hidden" name="id_pago_dte" value="{{  $dte -> id_pago_r }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn col-sm-12 btn-primary btn-xs" data-toggle="tooltip"
                                        title="Depositar">
                                    <i class="fa fa-dollar"></i> DEPOSITAR
                                </button>
                            </form>
                                @else
                                <form action="{{ url('Depositar') }}" method="post">
                                    <input type="hidden" name="id_pago_dte" value="{{  $dte -> id_pago_r }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn col-sm-12 btn-primary btn-xs" data-toggle="tooltip"
                                            title="Depositar" disabled>
                                        <i class="fa fa-dollar"></i> DEPOSITAR
                                    </button>
                                </form>
                            @endif
                            <br><br>
                            @if(Auth::user()->level==2)
                                @if( $dte -> estado_p_r == 1)
                            <form action="{{ url('Aprobar') }}" method="post">
                                <input type="hidden" name="id_pago_dte" value="{{  $dte -> id_pago_r }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn col-sm-12 btn-success btn-xs" data-toggle="tooltip"
                                        title="Aprobar">
                                    <i class="fa fa-check"></i> APROBAR
                                </button>
                            </form>
                                @else
                                    <form action="{{ url('Aprobar') }}" method="post">
                                        <input type="hidden" name="id_pago_dte" value="{{  $dte -> id_pago_r }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn col-sm-12 btn-success btn-xs" data-toggle="tooltip"
                                                title="Aprobar" disabled>
                                            <i class="fa fa-check"></i> APROBAR
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Nº FACTURA</th>
                    <th>$ PAGO</th>
                    <th>$ TOTAL</th>
                    <th>FECHA COBRO</th>
                    <th>FORMA DE PAGO</th>
                    <th>PLAZA</th>
                    <th>ESTADO</th>
                    <th>ACCION</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



@endsection
