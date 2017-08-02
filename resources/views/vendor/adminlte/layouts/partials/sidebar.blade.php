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
            @if(Auth::user()->level==1)
            <li class="header">PRINCIPAL</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#"><i class='fa fa-user'></i> <span>Menú Clientes</span> <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Clientes">Nuevo Cliente</a></li>
                    <li><a href="/Clientes/Listar">Modificar Clientes</a></li>
                </ul>
            </li>
            <li class="header">FACTURA / PAGOS</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-list-alt'></i> <span>Facturas</span> <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Clientes/DTE">Registrar Factura</a></li>
                </ul>
            </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-dollar'></i> <span>Pagos</span> <i class="fa fa-angle-right pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/Clientes/DTEs">Registar Pagos</a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->level==2)
                    <li class="header">FACTURA / PAGOS</li>
                    <li class="treeview">
                        <a href="#"><i class='fa fa-dollar'></i> <span>Aprobar Movimientos</span> <i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/Clientes/DTEs">Aprobar Pagos</a></li>
                        </ul>
                    </li>
            <li class="header">INFORMES</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-money'></i> <span>Informes</span> <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Cheques">Cheques por Cobrar</a></li>
                </ul>
            </li>
                    <li class="treeview">
                        <a href="#"><i class='fa fa-line-chart'></i> <span>Ventas</span> <i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/Clientes/DTE">Por Cliente</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class='fa fa-exchange'></i> <span>Movimientos</span> <i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/Bancos/Chile">Banco Chile</a></li>
                            <li><a href="/Bancos/Santander">Banco Santander</a></li>
                            <li><a href="/CajaChica">Caja Chica</a></li>
                        </ul>
                    </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
