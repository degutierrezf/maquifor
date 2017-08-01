<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">PRINCIPAL</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#"><i class='fa fa-user'></i> <span>MENÚ CLIENTES</span> <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Clientes">Nuevo Cliente</a></li>
                    <li><a href="/Clientes/Listar">Listar Clientes</a></li>
                </ul>
            </li>
            <li class="header">FACTURA / PAGOS</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-dollar'></i> <span>FACTURAS Y PAGOS</span> <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Clientes/DTE">Registrar Factura</a></li>
                    <li><a href="/Clientes/DTEs">Registar Pagos</a></li>
                </ul>
            </li>
            @if(Auth::user()->level==2)
            <li class="header">INFORMES</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-money'></i> <span>CHEQUES</span> <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="">Cheques por Cobrar</a></li>
                </ul>
            </li>
            @endif
            <li class="header">SISTEMA</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-gear'></i> <span>CONFIGURACIÓN</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/password/reset">Cambio de Clave</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
