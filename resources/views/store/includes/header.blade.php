<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Calabouço do Android</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../lime/assets/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lime/assets/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="../lime/assets/assets/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="../select/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../select/bootstrap-select.min.css" rel="stylesheet"/>


    <!-- Theme Styles -->
    <link href="../lime/assets/assets/css/lime.min.css" rel="stylesheet">
    <link href="../lime/assets/assets/css/custom.css" rel="stylesheet">
{{--    <link href="../lime/assets/assets/css/themes/admin2.css" rel="stylesheet">--}}


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class='loader'>
    <div class='spinner-grow text-primary' role='status'>
        <span class='sr-only'>Loading...</span>
    </div>
</div>

<div class="lime-sidebar">
    <div class="lime-sidebar-inner slimscroll">
        <ul class="accordion-menu">

            <li class="sidebar-title">
                Menu
            </li>
            <li>
                <a href="/" class="{{(Route::current()->uri === 'admin' ? 'active' : '')}}"><i class="material-icons">dashboard</i>Início</a>
            </li>
            @if(Auth::check() && Auth::user()->user_type === 'A')

            <li class="sidebar-title">
                Telas
            </li>

            <li>
                <a href="/admin"><i class="material-icons">dashboard</i>Painel Administrativo</a>
            </li>
            @endif
        </ul>
    </div>
</div>


<div class="lime-header">
    <nav class="navbar navbar-expand-lg">
        <section class="material-design-hamburger navigation-toggle">
            <a href="javascript:void(0)" class="button-collapse material-design-hamburger__icon">
                <span class="material-design-hamburger__layer"></span>
            </a>
        </section>

        @if(Route::current()->getName() !== 'home' && Route::current()->getName() !== 'login' && Route::current()->getName() !== 'register' && explode(".", Route::current()->getName())[0] !== 'password')
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 search" id="search" method="GET" action="/card/search">
                    <input class="form-control mr-sm-2" type="search" placeholder="Procure por nome de cartas" name="search" aria-label="Search">
                </form>
            </div>
        @endif

        <ul class="navbar-nav ml-auto">
            @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle theme-settings-link" href="/cart">
                    <i class="fas fa-shopping-cart"></i>
                    @if(isset($cart_quantity) && $cart_quantity !== 0)
                        <span class="badge badge-light">{{ $cart_quantity }}</span>
                    @endif
                </a>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                </a>

                @if(Auth::check())
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="/profile">Conta</a></li>
                    <li><a class="dropdown-item" href="#">Configurações</a></li>
                    <li class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
                @endif
                @if(!Auth::check())
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="/login">Login</a></li>
                        <li><a class="dropdown-item" href="/register">Cadastro</a></li>
                    </ul>
                @endif
            </li>
        </ul>
    </nav>

</div>


@yield('limeheader')
