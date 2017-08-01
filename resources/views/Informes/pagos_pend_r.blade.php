@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Pagos Realizados a Proveedores
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - PROVEEDORES -
@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-industry"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Proveedores</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Proveedores Activos</span>
                    <span class="info-box-number"></span>
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
                <span class="info-box-icon bg-green"><i class="fa fa-industry"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Proveedores Inactivos</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-industry"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Proveedores OBS</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>


    <a href="/Proveedores">
        <button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip"
                title="Registrar un nuevo proveedor en ERP">
            <i class="fa fa-industry"></i> Registrar Nuevo Proveedor
        </button>
    </a>

    <br><br>
    <div class="info-box">
        <div class="box-header">
            <h3 class="box-title">Listado General de Pagos PENDIENTES por hacer</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>PROVEEDOR</th>
                    <th>Nº DOCUMENTO</th>
                    <th>TIPO</th>
                    <th>MONTO FACTURADO</th>
                    <th>MONTO PAGADO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dte_r as $d_r)
                    <tr>
                        <td>{{  $d_r -> id_dte_r }}</td>
                        <td>{{  $d_r -> fecha }}</td>
                        <td>{{  $d_r -> rsocial }}</td>
                        <td>{{  $d_r -> num_doc }}</td>
                        <td>{{  $d_r -> tipo_documento }}</td>
                        <td>$ {{  number_format($d_r -> total,0,',','.') }}</td>
                        <td>$ {{  number_format($d_r -> pagado,0,',','.') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>PROVEEDOR</th>
                    <th>Nº DOCUMENTO</th>
                    <th>TIPO</th>
                    <th>MONTO FACTURADO</th>
                    <th>MONTO PAGADO</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
