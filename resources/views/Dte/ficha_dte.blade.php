@extends('adminlte::layouts.app')

@section('htmlheader_title')
    FICHA DTE CLIENTE / PROVEEDOR
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - DETALLE DTE CLIENTE / PROVEEDOR -
@endsection

@section('main-content')

        <div class="">
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-exchange"></i> Ficha de Transacciones: {{ $cli_pro[0] -> rsocial }}
                        </h2>
                    </div>

                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Empresa
                        <address>
                            <strong>{{ $cli_pro[0] -> rsocial }}</strong><br>
                            {{ $cli_pro[0] -> rut }}<br>
                            {{ $cli_pro[0] -> giro }}<br>
                            {{ $cli_pro[0] -> direccion }}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">

                        <address>
                            {{ $cli_pro[0] -> telefono }}<br>
                            {{ $cli_pro[0] -> mail }}<br>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-file"></i> FACTURAS
                    </h2>
                </div>
                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nº</th>
                                <th>FECHA EMISIÓN</th>
                                <th>FOLIO FACT.</th>
                                <th>NETO</th>
                                <th>IVA</th>
                                <th>OTRO IMP.</th>
                                <th>TOTAL</th>
                                <th>COBRADO</th>
                                <th>ESTADO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $num_ges = 1; ?>
                            @foreach($cli_pro as $c_p)
                                <tr>
                                    <td><?php
                                        echo $num_ges;
                                        $num_ges= $num_ges + 1;
                                        ?></td>
                                    <td>{{ date('d M Y', strtotime($c_p -> fecha)) }}</td>
                                    <td>{{  $c_p -> num_dte}}</td>
                                    <td>$ {{  number_format($c_p -> neto_doc,0,',','.')}}</td>
                                    <td>$ {{  number_format($c_p -> iva,0,',','.')}}</td>
                                    <td>$ {{  number_format($c_p -> otro_imp,0,',','.')}}</td>
                                    <td>$ {{  number_format($c_p -> total,0,',','.')}}</td>
                                    <td>$ {{  number_format($c_p -> cobrado,0,',','.')}}</td>
                                    <td>
                                        @if ($c_p->total==$c_p->cobrado)
                                            <button type="button" class="btn btn-success btn-xs" title="Pagado">
                                                <i class="fa fa-dollar"></i> PAGADO
                                            </button>
                                            @elseif($c_p->cobrado == 0)
                                            <button type="button" class="btn btn-danger btn-xs" title="Pagado">
                                                <i class="fa fa-dollar"></i> NO PAGADO
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-warning btn-xs" title="Pagado">
                                                <i class="fa fa-dollar"></i> PARCIALMENTE PAGADO
                                            </button>
                                        @endif
                                    </td>
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
