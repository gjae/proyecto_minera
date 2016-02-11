<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('titulo')</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/theme-green.css') }}" rel="stylesheet" />

    @section('css')
    @show
</head>

<body class="theme-red">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando ...</p>
        </div>
    </div>
    <!-- Page Loader -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar " style="color: white;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" style="color: white;" href="{{ url('dashboard') }}">Conectado como {{ Auth::user()->email }}</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usted se encuentra conectado como</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ url('logout') }}"><i class="material-icons">input</i>Desconectar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Menu</li>
                    <li>
                        <a href="{{ url('dashboard') }}">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <!--<li>
                        <a href="pages/typography.html">
                            <i class="material-icons">text_fields</i>
                            <span>Typography</span>
                        </a>
                    </li> -->
                     @if(Auth::user()->tipo_usuario == 'ADMIN')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Usuarios</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#">Usuarios del sistema</a>
                            </li>
                        </ul>
                    </li>
                   @endif
                    @if(Auth::user()->tipo_usuario == 'ADMIN')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings_applications</i>
                            <span>Configuracion</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('dashboard/configuracion/proveedores') }}">
                                    Proveedores
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/cargos') }}">
                                    Cargos
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/unidades') }}">Unidades de medida</a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/centros') }}">Centros de costos</a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/etapas') }}">Etapas de produccion</a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/diciplinas') }}">Diciplinas</a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/tipos') }}">Tipos de materiales</a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/configuracion/vehiculos') }}">Vehiculos</a>
                            </li>
                        </ul>
                    </li>
                   @endif
                    @if(Auth::user()->tipo_usuario == 'ADMIN' || Auth::user()->tipo_usuario == 'NOMINA')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment_ind</i>
                            <span>Nomina</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('dashboard/nomina/personal') }}">
                                    Personal
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/nomina/ajustes') }}">
                                    Ajustes
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/nomina') }}">Nominas</a>
                            </li>
                        </ul>
                    </li>
                   @endif
                    @if(Auth::user()->tipo_usuario == 'ADMIN' || Auth::user()->tipo_usuario == 'TRANSPORTE')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment_ind</i>
                            <span>Transporte y carga</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('dashboard/viajes/registrar') }}">
                                    Registrar viaje/flete
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/viajes/registrar/registro') }}">
                                    Registro
                                </a>
                            </li>
                        </ul>
                    </li>
                   @endif
                   @if(Auth::user()->tipo_usuario == 'ADMIN' || Auth::user()->tipo_usuario == 'REQUSICION')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_shopping_cart</i>
                            <span>Requisiciones</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('dashboard/requisicion/requisicion/emitir') }}">
                                    Emitir requisicion
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/requisicion/requisicion') }}">
                                    Ver requisiciones
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                   @if(Auth::user()->tipo_usuario == 'ADMIN' || Auth::user()->tipo_usuario == 'INVENTARIO')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_paste</i>
                            <span>Inventario</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('dashboard/inventario/inventario') }}">
                                    Ver inventario
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                   @if(Auth::user()->tipo_usuario == 'ADMIN' || Auth::user()->tipo_usuario == 'PROCURA')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_cart</i>
                            <span>Compras</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ url('dashboard/compras/invitaciones') }}">
                                    Generar invitaciones a cotizar
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/compras/cotizaciones/registrar') }}">
                                    Rigistrar cotizaciones
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/compras/Analisis/analisis') }}">
                                    Analisis
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/compras/Ordenes/emitir') }}">
                                    Emitir
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('dashboard/compras/Ordenes/ordenes') }}">
                                    Listado de ordenes de compras / servicios
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!--<div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>@yield('dash_titulo','DASHBOARD')</h2>
            </div>

            <div class="row clearfix">
                @section('contenedor')
                @show
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>

    @section('jquery')
    @show
</body>

</html>
