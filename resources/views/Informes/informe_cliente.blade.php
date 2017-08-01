@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Nuevo Cliente
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - CLIENTES -
@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-10">
            <!-- Horizontal Form -->
            <div class="box box-success">

                <div class="box-header with-border">
                    <h3 class="box-title">REPORTE DE VENTAS POR CLIENTE</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form class="form-horizontal" name="form" action="{{ url('Informes/Generar') }}" role="form"
                      method="POST">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Fecha Inicio:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control pull-right" name="f_ini" required>
                            </div>

                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Fecha Fin:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control pull-right" name="f_fin" required>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-2 control-label">Cliente</label>
                        <div class="col-sm-10">
                            <select class="form-control pull-right" name="cliente">
                                <?php  foreach ($cli as $cli) { ?>
                                <option class="form-control pull-right" value="<?php echo $cli->id_cliente ?>"><?php echo $cli->rsocial ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button name="boton" type="submit" class="btn btn-success pull-right">Ver Reporte Cliente</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-2">
            <a class="col-sm-10 btn btn-app btn" href="/Clientes">
                <i class="fa fa-user-plus"></i> Nuevo Cliente
            </a>

            <a class="col-sm-10 btn btn-app btn" href="/Clientes/Listar">
                <i class="fa fa-users"></i> Ver lista de Clientes
            </a>

            <a class="col-sm-10 btn btn-app btn" href="/Clientes/DTE">
                <i class="fa fa-plus"></i> Crear Factura
            </a>
        </div>
    </div>


@endsection
