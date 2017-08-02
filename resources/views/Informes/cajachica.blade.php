@extends('adminlte::layouts.app')

@section('htmlheader_title')
    FICHA CONTROL CAJA CHICA
@endsection

@section('contentheader_title')
    ERP - SISTEMA DE CONTROL - FICHA CONTROL CAJA CHICA
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
                    <i class="fa fa-dollar"></i> Caja Chica
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
                            <th>MONTO INGRESO</th>
                            <th>NUM. FACTURA</th>
                            <th>TIPO MOVIMIENTO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $num_ges = 1; ?>
                        @foreach($movi as $mov)
                            <tr>
                                <td><?php
                                    echo $num_ges;
                                    $num_ges= $num_ges + 1;
                                    ?></td>
                                <td>{{ date('d/m/Y  - H:i:s', strtotime($mov -> fecha_dep)) }}</td>
                                <td>$ {{  number_format($mov -> monto,0,',','.')}}</td>
                                <td>{{ $mov -> num_dte }}</td>
                                <td>Ingreso con {{ $mov -> tipos_docs_pago }}</td>
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
