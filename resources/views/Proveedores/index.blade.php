@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Nuevo Proveedor
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - PROVEEDORES -
@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-10">
            <!-- Horizontal Form -->
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">REGISTRO DE NUEVO PROVEEDOR</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form class="form-horizontal" name="form" action="{{ url('Proveedores/GuardarNuevo') }}" role="form"
                      method="POST">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">RUT:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control pull-right" name="rut"  maxlength="12" placeholder="00.000.000-0" required>
                            </div>

                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Fecha Ingreso:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control pull-right" name="fecha">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Razón Social:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control pull-right" name="r_soc" maxlength="55" placeholder="Nombre o Razón Social del Proveedor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Giro:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control pull-right" name="giro" placeholder="Giro del Proveedor" maxlength="55">
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Dirección:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control pull-right" name="direccion" maxlength="55" placeholder="Calle, Número, Depto, Población">
                            </div>
                            <label for="exampleInputEmail1" class="col-sm-1 control-label">Ciudad:</label>
                            <div class="col-sm-4">
                                <select class="form-control pull-right" name="comunas">
                                    <?php  foreach ($comunas as $cs) { ?>
                                    <option class="form-control pull-right" value="<?php echo $cs->id_comunas ?>"><?php echo $cs->comunas ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Teléfono:</label>
                            <div class="col-sm-3">
                                <input type="number" min="0" class="form-control pull-right" name="telefono" placeholder="900000000">
                            </div>

                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Correo Electrónico:</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control pull-right" name="correo" maxlength="55" placeholder="Correo Electrónico de Proveedor">
                            </div>
                        </div>
                        <hr>

                        <div class="form-group" >
                            <label for="exampleInputEmail1" class="col-sm-2 control-label">Observaciones al Proveedor:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="obs_cli" rows="5" placeholder="Observaciones al Proveedor, hasta 1500 Caracteres ..."></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button name="boton" type="submit" class="btn btn-primary pull-right">Registrar Proveedor</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-2">
            <a class="btn btn-app btn" href="/Proveedores/Listar">
                <i class="fa fa-list-ul"></i> Ver lista de Proveedores
            </a>
        </div>
    </div>


@endsection
