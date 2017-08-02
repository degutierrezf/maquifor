@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Registro Pagos DTE
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - PAGOS DTE -
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

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Emitido Año</span>
                    <span class="info-box-number">$ {{number_format($total_a,0,',','.')}}</span>
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
                    <span class="info-box-text">Total Emitido Mes</span>
                    <span class="info-box-number">$ {{number_format($total_m,0,',','.')}}</span>
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
                    <span class="info-box-text">Total IVA Mes</span>
                    <span class="info-box-number">$ {{number_format($total_i,0,',','.')}}</span>
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
                    <span class="info-box-text">N° Facturas Mes</span>
                    <span class="info-box-number">{{$num_fac}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>


    <a href="DTE">
        <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip"
                title="Registrar un nuevo cliente en ERP">
            <i class="fa fa-user"></i> Registrar Nuevo Documento
        </button>
    </a>

    <br><br>
    <div class="info-box">
        <div class="box-header">
            <h3 class="box-title">Facturas Pendientes de Pago & Sin Documentar</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>N° FACT.</th>
                    <th>FECHA EMISIÓN</th>
                    <th>FECHA VENCIMIENTO</th>
                    <th>TOTAL</th>
                    <th>DOCUMENTADO</th>
                    <th>COBRADO</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dte_e as $dte)
                    <tr>
                        <td>{{  $dte -> id_dte_e }}</td>
                        <td><b>{{  $dte -> rsocial }}</b></td>
                        <td>{{  $dte -> num_dte}}</td>
                        <td>{{  date('d M Y', strtotime($dte -> fecha)) }}</td>
                        <td>{{  date('d M Y', strtotime($dte -> fec_vencimiento)) }}</td>
                        <td>$ {{  number_format($dte -> total,0,',','.') }}</td>
                        <td>$ {{  number_format($dte -> pagado,0,',','.') }}</td>
                        <td>$ {{  number_format($dte -> cobrado,0,',','.') }}</td>
                        <td>
                            <center>
                                @if($dte->estado_dte == 2)
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip"
                                            title="PAGADA">
                                        <i class="fa fa-check"></i> PAGADA
                                    </button>
                                @else
                                @if( $dte -> pagado == $dte -> total )
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip"
                                            title="Documentado">
                                        <i class="fa fa-check"></i> DOCUMENTADO
                                    </button>
                                @elseif($dte->pagado == 0)
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip"
                                            title="Impaga">
                                        <i class="fa fa-times"></i> SIN DOCUMENTO <br> DE RESPALDO
                                    </button>
                                @else
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip"
                                            title="Parcialmente Documentado">
                                        <i class="fa fa-info"></i> PARCIALMENTE DOCUMENTADO
                                    </button>
                                @endif
                                @endif
                            </center>
                        <td>
                            <center>
                                @if(Auth::user()->level!=2)
                                <button id="btn_add_dte" type="button" class="btn col-sm-12 btn-success btn-xs btn_add_dte"
                                        data-toggle="tooltip"
                                        title="Registrar Pago DTE">
                                    <i class="fa fa-plus"></i> REGISTRAR
                                </button>
                                @endif
                                <br><br>
                                <form action="{{ url('DetalleDTEEmitidas') }}" method="post">
                                    <input type="hidden" name="id_dte" value="{{  $dte -> id_dte_e }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn col-sm-12 btn-primary btn-xs" data-toggle="tooltip"
                                            title="Ver Detalle Pago DTE">
                                        <i class="fa fa-eye"></i> DETALLES
                                    </button>
                                </form>
                                <br> <br>
                                @if(Auth::user()->level==2)

                                @if( $dte -> cobrado == $dte -> total && $dte -> estado_dte != 2)
                                <form action="{{ url('AprobarFactura') }}" method="post">
                                    <input type="hidden" name="id_dte" value="{{  $dte -> id_dte_e }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn col-sm-12 btn-success btn-xs" data-toggle="tooltip"
                                            title="Aprobar CE">
                                        <i class="fa fa-dollar"></i> APROBAR
                                    </button>
                                </form>
                                    @else
                                        <form action="{{ url('AprobarFactura') }}" method="post">
                                            <input type="hidden" name="id_dte" value="{{  $dte -> id_dte_e }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn col-sm-12 btn-danger btn-xs" data-toggle="tooltip"
                                                    title="Aprobar CE" disabled>
                                                <i class="fa fa-dollar"></i> APROBAR
                                            </button>
                                        </form>
                                @endif
                                @endif
                            </center>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>N° FACT</th>
                    <th>FECHA EMISIÓN</th>
                    <th>FECHA VENCIMIENTO</th>
                    <th>TOTAL</th>
                    <th>DOCUMENTADO</th>
                    <th>COBRADO</th>
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
                        id="favoritesModalLabel">Agregar Pago DTE Cliente </h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" name="form" action="{{ url('Clientes/EmitirPago') }}" role="form"
                          method="POST" enctype="multipart/form-data">

                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="form-control pull-right" id="id_fact" type="hidden" name="id_fact">
                            <div class="form-group">

                                <label for="exampleInputEmail1" class="col-sm-3 control-label">N° DOC</label>
                                <div class="col-sm-9">
                                    <input class="form-control pull-right" id="num_doc" type="text" name="num_doc"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Cliente</label>
                                <div class="col-sm-9">
                                    <input class="form-control pull-right" id="nom_cliente_s" type="text"
                                           name="nom_cliente"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Fecha Pago</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" type="date" name="fecha" required>
                                </div>
                                <label for="exampleInputEmail1" class="col-sm-1 control-label">N°Ref:</label>
                                <div class="col-sm-3">
                                    <input class="form-control pull-right" type="number" min="1" name="n_doc" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">$ Total</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" id="max_total" type="number" min="1"
                                           name="max_total" required>
                                </div>
                                <label for="exampleInputEmail1" class="col-sm-1 control-label">Tipo</label>
                                <div class="col-sm-4">
                                    <select class="form-control pull-right" name="tipo">
                                        <?php  foreach ($tipo_pg as $td) { ?>
                                        <option class="form-control pull-right"
                                                value="<?php echo $td->id_tipo_docs_p ?>"><?php echo $td->tipos_docs_pago ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Observaciones</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control pull-right" name="obs" id="" cols="10"
                                              rows="2"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Fecha Cobro Cheque</label>
                                <div class="col-sm-4">
                                    <input class="form-control pull-right" type="date" name="fecha_cobro" required>
                                </div>
                                <label for="exampleInputEmail1" class="col-sm-1 control-label">Plaza</label>
                                <div class="col-sm-4">
                                    <select class="form-control pull-right" name="banco">
                                        <?php  foreach ($bancos as $bc) { ?>
                                        <option class="form-control pull-right"
                                                value="<?php echo $bc->bancos ?>"><?php echo $bc->bancos ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove "></i> Cancelar
                            </button>


                            <button id="btn_sub_dte" type="submit" class="btn btn-success">
                                <i class="fa fa-check "></i> Agregar DTE a Cliente
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection