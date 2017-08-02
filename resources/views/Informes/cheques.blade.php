@extends('adminlte::layouts.app')

@section('htmlheader_title')
    FICHA CONTROL CHEQUES POR COBRAR
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - FICHA CONTROL CHEQUES POR COBRAR
@endsection

@section('main-content')

    <div class="">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-exchange"></i> Ficha de Transacciones:
                    </h2>
                </div>

            </div>
            <!-- info row -->
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-dollar"></i> Cheques por cobrar
                </h2>
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nº</th>
                            <th>FECHA INGRESO</th>
                            <th>FECHA COBRO</th>
                            <th>MONTO A COBRAR</th>
                            <th>NUM. FACTURA</th>
                            <th>CLIENTE</th>
                            <th>ESTADO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $num_ges = 1; ?>
                        @foreach($cheques as $c_q)
                            <tr>
                                <td><?php
                                    echo $num_ges;
                                    $num_ges= $num_ges + 1;
                                    ?></td>
                                <td>{{ date('d/m/Y', strtotime($c_q -> fecha)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($c_q -> fecha_cobro)) }}</td>
                                <td>$ {{  number_format($c_q -> valor_doc,0,',','.')}}</td>
                                <td>{{ $c_q -> num_dte }}</td>
                                <td>{{ $c_q -> rsocial }}</td>
                                <td><center>
                                        @if( $c_q -> estado_p_r == 0)
                                            <button type="button" class="btn col-sm-12 btn-warning btn-xs" data-toggle="tooltip"
                                                    title="DOCUMENTADO">
                                                <i class="fa fa-info"></i> DOCUMENTADO EN <br> OFICINA
                                            </button>
                                        @elseif($c_q->estado_p_r == 1)
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
                                    </center></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>


@endsection
