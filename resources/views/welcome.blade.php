@extends('layouts.site.app')


@section('seo')
    <title>Compra y venta de autos usados en Saltillo | MANEJA</title>
    <meta name="keywords" content="venta autos usados en saltillo, compra autos seminuevos saltillo, buscar autos saltillo, compra venta autos saltillo">
    <meta name="description" content="En MANEJA puedes comprar y vender tu auto de manera rápida y segura en Saltillo: Obtén precios justos y haz que tu inversión valga la pena.">
    <meta property="og:description" content="En MANEJA puedes comprar y vender tu auto de manera rápida y segura en Saltillo: Obtén precios justos y haz que tu inversión valga la pena."/>

    <meta name="author" content="Macasoft">
    <meta name="language" content="Spanish">
    <meta name="revisit" content="1 days">
    <meta name="distribution" content="Global">
    <meta name=robots content="index, follow">
    <meta property="og:locale" content=es_MX>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://maneja.mx"/>
    <meta property="og:site_name" content="Compra y venta de autos usados en Saltillo - MANEJA"/>
    <meta property="og:title" content="Compra y venta de autos usados en Saltillo - MANEJA"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="https://maneja.mx">
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
  @include('layouts.site.nav')
@endsection

@section('header')
    <div class="header">
        <div class="row no-gutters">
            <div class="col-10 col-md-6  offset-1 ">
                <div class="header-title mt-0 mt-lg-5">
                    <h1 class="mb-n text-uppercase">Vehículos <span class="text-uppercase">que se  ajustan a tu </span>presupuesto</h1>
                    <p class="mt-3">Obtén una precalificación para ver términos de financiamiento personalizados, en más de 200 vehículos.</p>
                </div>
                <div class="row text-center  ">
                    <div class="col-12 col-md-12 text-center">
                        <a href="/autos" class="btn btn-lg btn-primary mt-2 text-uppercase">BUSCAR VEHÍCULO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="p-2 calls bg-theme-secondary">
        <div class="row no-gutters ">
            <div class="col-12 col-md-6 pr-md-1  ">
                <div class="card border-0 bg-dark text-white banner1" >
                    <div class="card-body op-dark-3">
                        <h2 class="card-title">LA NUEVA FORMA <br> DE COMPRAR AUTOS {{-- <sub>TM</sub> --}}</h2>
                        <p class="card-text mt-2">Busca en nuestro inventario <br>más de 200 opciones para ti.</p>
                        <div class="content">
                            <form  class="" method="GET" action="/autos">
                                <div class="form-row align-items-center">
                                    <div class="col-8">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" id="search" name="search" placeholder="Marca, Modelo">
                                        </div>
                                    </div>
                                    <div class="col-auto ">
                                        <button type="submit" class="btn btn-primary btn-lg mb-2">IR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-2 mt-md-0 pl-md-1">
                <div class="card border-0 bg-dark text-white banner2">
                    <div class="card-body op-dark-3">
                        <div class="content">
                            <h2 class="card-title">¿QUIERES VENDER <br> TU AUTO?</h2>
                            <p class="card-text mt-2">Nuestros expertos te ofrecerán un precio justo por la venta de tu auto. <br>Contáctanos</p>
                            <a href="/vender-mi-auto" class="btn btn-primary btn-lg mt-2">OBTÉN UNA OFERTA</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info">
        <div class="container">
            <div class="col-12 col-sm-6 col-lg-4 offset-sm-6 offset-lg-8 text-center">
                <div class="item">
                    <img src="/images/iconos/sherlock.png" alt="Sherlock">
                    <p class="">Investigación de calidad para una compra segura.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping-tools pt-4">
        <div class="container text-center">
            <div class="title">
                <h2 class="title-3 mt-4">HERRAMIENTAS <span>¡Instrumentos para que te pongas en marcha!</span></h2>
            </div>
            <div class="row mt-4">
                <div class="col col-md-4 offset-md-2 border-right">
                    <a href="/autos" class="">
                        <img class="img-fluid" src="/images/iconos/maneja_iconos_website_-04.png" width="50" alt="">
                        <div class="card-body">
                        <h5 class="card-title">BUSCADOR</h5>
                        <p class="card-text">Encuentra el auto adecuado. </p>
                        </div>
                    </a>
                </div>
                <div class="col col-md-4">
                    <a href="/calculadora" class="">
                        <img class="img-fluid" src="/images/iconos/maneja_iconos_website_-05.png" width="50" alt="">
                        <div class="card-body">
                          <h5 class="card-title">CALCULADORA DE PRÉSTAMOS</h5>
                          <p>Utiliza nuestra calculadora de préstamos y obtén el presupuesto de tu nuevo auto.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection
