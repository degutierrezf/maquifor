@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Listar Pagos por DTE
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - DETALLE DTE PAGO -
@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-paste"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Factura</span>
                    <span class="info-box-number">{{ $id_dte }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">$ Monto</span>
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
                    <span class="info-box-text">$ Pagado</span>
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
                    <span class="info-box-text">$ Pendiente</span>
                    <span class="info-box-number">$ {{  number_format($pend,0,',','.') }}</span>
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
            <h3 class="box-title">Detalle de Pagos Factura Nº {{ $id_dte }}</h3>
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
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
