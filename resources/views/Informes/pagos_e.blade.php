@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Pagos Recibidos de Cliente
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - CLIENTES -
@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Clientes</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Clientes Activos</span>
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
                <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Clientes Inactivos</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">N° Clientes OBS</span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>


    <a href="/Clientes">
        <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip"
                title="Registrar un nuevo Cliente en ERP">
            <i class="fa fa-industry"></i> Registrar Nuevo Cliente
        </button>
    </a>

    <br><br>
    <div class="info-box">
        <div class="box-header">
            <h3 class="box-title">Listado General de Pagos Cerrados a Clientes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>CLIENTE</th>
                    <th>Nº DOCUMENTO</th>
                    <th>TIPO</th>
                    <th>MONTO FACTURADO</th>
                    <th>MONTO PAGADO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dte_e as $d_e)
                    <tr>
                        <td>{{  $d_e -> id_dte_e }}</td>
                        <td>{{  $d_e -> fecha }}</td>
                        <td>{{  $d_e -> rsocial }}</td>
                        <td>{{  $d_e -> num_doc }}</td>
                        <td>{{  $d_e -> tipo_documento }}</td>
                        <td>$ {{  number_format($d_e -> total,0,',','.') }}</td>
                        <td>$ {{  number_format($d_e -> pagado,0,',','.') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>CLIENTE</th>
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
