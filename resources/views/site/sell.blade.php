@extends('layouts.site.app')

@section('seo')
    <title>Vende tu auto online: Obtén una oferta en 2 minutos | Maneja.mx</title>
    <meta property="og:title" content="Vende tu auto online: Obtén una oferta en 2 minutos | Maneja.mx"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
    <meta name="keywords" content="Compramos tu vehículo de manera rápida y segura a un precio justo. En tan solo 2 minutos: Cotiza, vende y recibe el pago u otro auto sin salir de casa.">
    <meta name="description" content="Compramos tu vehículo de manera rápida y segura a un precio justo. En tan solo 2 minutos: Cotiza, vende y recibe el pago u otro auto sin salir de casa.">
    <meta property="og:description" content="Compramos tu vehículo de manera rápida y segura a un precio justo. En tan solo 2 minutos: Cotiza, vende y recibe el pago u otro auto sin salir de casa."/>
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
    @include('layouts.site.nav')
@endsection

@section('header')
    <div class="sell-header">
        <article class="header-title">
            <hr class="title mb-3">
            <h1 class="text-white  mb-n text-uppercase">Obtén una <br> oferta real <br> en 2 minutos </h1>
            <p class="text-white h5">Vamos por tu coche. Te pagamos en el acto.</p>
        </article>
    </div>
@endsection

@section('content')
    <div class="bg-white pt-5 pb-5 ">
        <div class="container ">
            <div class="text-center mt-4">
                <hr class="title mb-3">
                <h2 class="title-1 text-primary font-weight-bold text-uppercase">¿cómo funciona?</h2>
                <p class="text-primary font-weight-light pt-4 h6">
                    Vende tu vehículo a Maneja en unos pocos y sencillos pasos.
                </p>
            </div>

            <div class="shopping-tools pt-4 bg-transparent">
                <div class="container text-center">
                    <div class="row">
                        <div class="col ">
                            <a href="#" class="">
                                <img class="img-fluid" src="/images/iconos/maneja_iconos_website_-05.png" width="50" alt="">
                                <div class="card-body">
                                <h4 class=" font-weight-bold mb-2 text-primary">CONSIGUE TU OFERTA</h4>
                                <p class="card-text"> Comparte algunos detalles de tu auto y te ofreceremos una oferta firme y real en 2 minutos.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col ">
                            <a href="#" class="">
                                <img class="img-fluid" src="/images/iconos/maneja_iconos_website_-08.png" width="50" alt="">
                                <div class="card-body">
                                <h4 class=" font-weight-bold mb-2 text-primary">VENDE </h4>
                                <p>Véndelo a Maneja, ¡nosotros lo recogemos! </p>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img class="img-fluid" src="/images/iconos/maneja_iconos_website_-09.png" width="50" alt="">
                                <div class="card-body">
                                <h4 class=" font-weight-bold mb-2 text-primary">RECIBE EL PAGO</h4>
                                <p class="card-text">¡Después de una revisión ágil en el lugar te damos una propuesta en firme!</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-theme-secondary">
        <site-sell-form :user="{{ Auth::check() ? auth()->user() : collect() }}"></site-sell-form>
    </div>


@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
