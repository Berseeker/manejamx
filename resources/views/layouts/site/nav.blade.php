<div class="navbar-secondary">
    <div class="container-fluid">
        <ul class="nav justify-content-end">
            <li class="nav-item d-none d-md-inline">
                <a class="nav-link" href="{{route('site.how-it-works')}}">CÓMO FUNCIONA</a>
            </li>
            <li class="nav-item d-none d-md-inline">
                <a class="nav-link" href="{{ route('site.about-us') }}">SOBRE NOSOTROS</a>
            </li>

            {{-- <li class="nav-item dropdown d-md-inline">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    SOBRE NOSOTROS
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/about-us">SOBRE NOSOTROS</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">PROTECCIÓN DEL VEHÍCULO</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">REVIEWS DE CLIENTES</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">CARRERAS</a>
                </div>
            </li> --}}
            <li class="nav-item divider">
              <a class="nav-link" href="{{ route('site.contact') }}">SOPORTE Y CONTACTO</a>
            </li>
        </ul>
    </div>
</div>
<nav class="site navbar navbar-expand-lg navbar-light bg-white" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/maneja_logo_dark.png" height="50" alt="maneja logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse theme-nav" id="navbarColor03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link {{ !request()->is('autos') ?: 'active'}}" href="{{ route('site.cars.index') }}">BUSCAR VEHÍCULO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->is('vender-mi-auto') ?: 'active'}}" href="{{ route('site.sell-my-car') }}">VENDER MI VEHÍCULO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->is('calculadora') ?: 'active'}}" href="{{ route('site.loan-calculator') }}">CALCULADORA DE PRÉSTAMOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->is('blog*') ?: 'active'}}" href="{{ route('site.blog') }}">BLOG</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        FINANCIAMIENTO
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">POR QUÉ FINANCIAR CON NOSOTROS</a>
                        <div class="dropdown-divider d-none d-lg-block"></div>
                        <a class="dropdown-item" href="#">OBTENER PRE-CALIFICADO</a>
                        <div class="dropdown-divider d-none d-lg-block"></div>
                        <a class="dropdown-item" href="{{ route('site.loan-calculator') }}">CALCULADORA DE PRÉSTAMOS AUTOMÁTICOS</a>
                    </div>
                </li> --}}
            </ul>
            <div>
                @guest
                    <button type="button" class="btn btn-link my-2 my-sm-0" data-toggle="modal" data-target="#authModal">
                        INGRESAR
                    </button>
                @else
                    <ul class="navbar-nav mr-auto">

                        <favorites></favorites>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if(Auth::user()->hasRole(['admin', 'employee']))
                                    <a class="dropdown-item" href="/admin">Admin</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('site.users.profile') }}">Mi Cuenta</a>
                                <div class="dropdown-divider d-none d-lg-block"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-formlala').submit();"
                                >Salir</a>
                                <div>
                                    <form id="logout-formlala" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </div>
</nav>
<auth-modal></auth-modal>

