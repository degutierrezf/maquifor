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
                    <th>ID PAGO</th>
                    <th>Nº REF.</th>
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
                        <td>{{ $dte -> id_pago_r }}</td>
                        <td>{{  $dte -> num_doc }}</td>
                        <td>$ {{  number_format($dte -> valor_doc,0,',','.') }}</td>
                        <td>$ {{  number_format($dte -> total,0,',','.') }}</td>
                        <td>{{ $dte -> fecha_cobro }}</td>
                        <td>{{ $dte -> tipos_docs_pago }}</td>
                        <td>{{ $dte -> plaza }}</td>
                        <td>
                            <center>
                                    @if( $dte -> estado_p_r == 0)
                                        <button type="button" class="btn col-sm-12 btn-warning btn-xs" data-toggle="tooltip"
                                                title="DOCUMENTADO">
                                            <i class="fa fa-info"></i> DOCUMENTADO EN <br> OFICINA
                                        </button>
                                    @elseif($dte->estado_p_r == 1)
                                        <button type="button" class="btn col-sm-12 btn-primary btn-xs" data-toggle="tooltip"
                                                title="DEPOSITADO">
                                            <i class="fa fa-dollar"></i> DEPOSITADO Y <br>ESPERANDO APROBACIÓN
                                        </button>
                                    @else
                                        <button type="button" class="btn col-sm-12 btn-success btn-xs" data-toggle="tooltip"
                                                title="APROBADO CE">
                                            <i class="fa fa-check"></i> APROBADO POR CE
                                        </button>
                                @endif
                            </center>
                        </td>
                        <td>
                            @if( $dte -> estado_p_r == 0 && Auth::user()->level!=2)

                                <button id="btn_add_dte" type="button" class="btn col-sm-12 btn-primary btn-xs btn_add_dte"
                                        data-toggle="tooltip"
                                        title="Depositar">
                                    <i class="fa fa-dollar"></i> DEPOSITAR
                                </button>

                                @else

                                <button id="btn_add_deposito" type="button" class="btn col-sm-12 btn-danger btn-xs btn_add_dte"
                                        data-toggle="tooltip"
                                        title="Depositar" disabled>
                                    <i class="fa fa-dollar"></i> DEPOSITAR
                                </button>

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
                                        <button type="submit" class="btn col-sm-12 btn-danger btn-xs" data-toggle="tooltip"
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
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade" id="add_dte"
         tabindex="-1" role="dialog"
         aria-labelledby="favbtn_add_dteoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="favoritesModalLabel">ASIGNAR DEPOSITO</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" name="form" action="{{ url('Depositar') }}" role="form"
                          method="POST" enctype="multipart/form-data">

                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="form-control pull-right" id="id_fact" type="hidden" name="id_pago">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">MONTO</label>
                                <div class="col-sm-7">
                                    <input class="form-control pull-right" id="num_doc" type="text" name="monto"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">CUENTA DEPÓSITO</label>
                                <div class="col-sm-7">
                                    <select class="form-control pull-right" name="id_cuenta">
                                        <?php  foreach ($cuentas as $bc) { ?>
                                        <option class="form-control pull-right"
                                                value="<?php echo $bc->id_cuentas ?>"><?php echo $bc->cuenta_banco ?></option>
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


                            <button id="btn_sub_dte" type="submit" class="btn btn-primary">
                                <i class="fa fa-check "></i> Depositar
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
