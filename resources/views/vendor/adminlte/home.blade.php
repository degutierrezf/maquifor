@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-industry"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">N° Proveedores</span>
					<span class="info-box-number">{{ $num_pro }}</span>
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
					<span class="info-box-text">Pagos Pendientes</span>
					<span class="info-box-number">{{ $pend_pro }}</span>
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
					<span class="info-box-text">$ Pagos Pendientes</span>
					<span class="info-box-number">$ {{ number_format($pend_pro_peso,0,',','.') }}</span>
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
					<span class="info-box-text">Total Pagado</span>
					<span class="info-box-number">$ {{ number_format($pagado_pro,0,',','.') }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">N° Clientes</span>
					<span class="info-box-number">{{ $num_cli }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">Pagos Pendientes</span>
					<span class="info-box-number">{{ number_format($pend_cli,0,',','.') }}</span>
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
				<span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">$ Pagos Pendientes</span>
					<span class="info-box-number">$ {{ number_format($pend_cli_peso,0,',','.') }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">Total Pagado</span>
					<span class="info-box-number">$ {{ number_format($pagado_cli,0,',','.') }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
	</div>
@endsection
