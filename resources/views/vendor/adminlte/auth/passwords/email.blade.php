@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Recuperar Clave
@endsection

@section('content')

<body class="login-page">
    <div id="app">

        <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>ACESUR </b>E.I.R.L.</a>
        </div><!-- /.login-logo -->

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong><br><br>
                <ul>
                    Reintente nuevamente, o escriba al administrador del sistema.
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">Cambiar Contraseña</p>
            <form action="{{ url('/password/email') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar al Correo</button>
                    </div><!-- /.col -->
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                </div>
            </form>
            <br>

            <a href="{{ url('/login') }}">Iniciar Sesión</a><br>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
