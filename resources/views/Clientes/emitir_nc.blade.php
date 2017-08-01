@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Emisión NC
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - EMISIÓN NC -
@endsection

@section('main-content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="info-box">
        <div class="box-header">
            <h3 class="box-title">Listado General de Clientes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>RUT</th>
                    <th>NOMBRE / RAZÓN SOCIAL</th>
                    <th>GIRO</th>
                    <th>TELÉFONO</th>
                    <th>CORREO ELECTRÓNICO</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clientes as $cli)
                    <tr>
                        <td>{{  $cli -> id_cliente }}</td>
                        <td>{{  $cli -> rut }}</td>
                        <td>{{  $cli -> rsocial}}</td>
                        <td>{{  $cli -> giro}}</td>
                        <td>{{  $cli -> telefono}}</td>
                        <td>{{  $cli -> mail}}</td>
                        <td>
                            <center>
                                @if( $cli -> estado == 1)
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip"
                                            title="Activo">
                                        <i class="fa fa-check"></i> Activo
                                    </button>
                                @elseif($cli->estado ==2)
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip"
                                            title="Inactivo">
                                        <i class="fa fa-times"></i> Inactivo
                                    </button>
                                @else
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip"
                                            title="Con Observaciones">
                                        <i class="fa fa-info"></i> Con Observaciones
                                    </button>
                                @endif
                            </center>
                        <td>
                            <center>
                                <button id="btn_add_dte" type="button" class="btn btn-success btn-xs btn_add_dte" data-toggle="tooltip"
                                        title="Agregar NC">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <br><br>
                                <form class="" name="form" action="{{ url('FichaDTE') }}" role="form"
                                      method="POST" enctype="multipart/form-data">

                                    <div class="">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input class="form-control pull-right" id="id" type="hidden" name="id" value="{{  $cli -> id_cliente }}">
                                        <input class="form-control pull-right" id="tipo" type="hidden" name="tipo" value="1">
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn-xs btn-primary">
                                            <i class="fa fa-eye "></i>
                                        </button>
                                    </div>
                                </form>
                            </center>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>RUT</th>
                    <th>NOMBRE / RAZÓN SOCIAL</th>
                    <th>GIRO</th>
                    <th>TELÉFONO</th>
                    <th>CORREO ELECTRÓNICO</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>


    <div class="modal fade" id="add_dte"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="favoritesModalLabel">Agregar Nota de Crédito Cliente </h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" name="form" action="{{ url('Clientes/EmitirNC') }}" role="form"
                          method="POST" enctype="multipart/form-data">

                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="form-control pull-right" id="id_cliente" type="hidden" name="id_cliente">
                            <div class="form-group">

                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Cliente</label>
                                <div class="col-sm-9">
                                    <input class="form-control pull-right" id="nom_cliente" type="text" name="nom_cliente"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Fecha Emisión</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" type="date" name="fecha_em" required>
                                </div>
                                <label for="exampleInputEmail1" class="col-sm-2 control-label">N° Doc:</label>
                                <div class="col-sm-3">
                                    <input class="form-control pull-right" type="number" min="1" name="n_doc" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">$ Neto</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" id="neto" type="number"  min="1" name="neto" required>
                                </div>
                                <label for="exampleInputEmail1" class="col-sm-1 control-label">$ IVA</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" id="iva" type="number" min="0" name="iva" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label"></label>
                                <div class="col-sm-2">

                                </div>
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">$ Otro Impuesto</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" id="otro_impuesto" type="number" min="0" name="otro_impuesto" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">$ Total</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" id="total" type="number" min="1" name="total" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Observaciones</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control pull-right" name="obs" id="" cols="10" rows="2"></textarea>
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove "></i> Cancelar
                            </button>


                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-check "></i> Agregar NC a Cliente
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection