@extends('layouts.site.app')

@section('seo')
    <title>Descubre cómo Comprar o vender tu auto hoy | Maneja.mx</title>
    <meta property="og:title" content="Descubre cómo Comprar o vender tu auto hoy | Maneja.mx"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
    <meta name="keywords" content="Compra, vende o cambia tu Auto, rápido y al mejor precio con Maneja. Evita intermediarios y descubre la nueva experiencia de compra-venta de vehículos. ">
    <meta name="description" content="Compra, vende o cambia tu Auto, rápido y al mejor precio con Maneja. Evita intermediarios y descubre la nueva experiencia de compra-venta de vehículos. ">
    <meta property="og:description" content="Compra, vende o cambia tu Auto, rápido y al mejor precio con Maneja. Evita intermediarios y descubre la nueva experiencia de compra-venta de vehículos. "/>
@endsection

@section('head')
@include('layouts.site.head')
<style>
    section {
        padding: 80px 0;
    }
</style>
@endsection

@section('nav')
@include('layouts.site.nav')
@endsection

@section('content')

<section>
    <div class="container">
        <div class="row justify-content-around flex-row-reverse">
            <div class="col-md-12 text-center mb-4">
                <div class="text-center">
                    <hr class="title">
                    <h2 class="title-1 text-dark">¡Adquiere tu auto!</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/audia3_.png') }}" class="img-fluid" alt="#">
            </div>
            <div class="col-lg-6 mt-4">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-search text-theme"></i></span><p>Busca tu auto por: marca, año, tipo (Sedan, HB, SUV, etc), rango de precio.</p></li>
                    <li><span class="fa-li"><i class="far fa-check-square text-theme"></i></span><p>Selecciona tu auto.</p></li>
                    <li><span class="fa-li"><i class="fas fa-calculator text-theme"></i></span><p>Calcula tu financiamiento.</p> </li>
                    <li><span class="fa-li"><i class="far fa-handshake text-theme"></i></span><p>Apártalo.</p></li>
                    <li><span class="fa-li"><i class="far fa-calendar-alt text-theme"></i></span><p>Agenda una cita para tu atención personalizada.</p></li>
                </ul>
                <a href="/autos" class="btn btn-lg btn-secondary mt-3">BUSCAR VEHÍCULO</a>
            </div>
        </div>

    </div>
</section>

<section class="bg-light">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-12 text-center mb-4">
                <div class="text-center">
                    <hr class="title">
                    <h2 class="title-1 text-dark">Descubre el proceso de Maneja</h2>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12 d-flex flex-column align-content-center justify-content-center">
                <img src="{{ asset('images/MANEJA_DIAGRAMA_CAMBIOOVENTA-01.png') }}" class="img-fluid" alt="#">
            </div>
            <div class="col-lg-12 mt-5 d-flex align-content-center justify-content-center">
                <img src="{{ asset('images/how-it-works-sell.jpg') }}" class="img-fluid rounded-lg" alt="#">
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/vender-mi-auto" class="btn btn-primary btn-lg">OBTÉN UNA OFERTA</a>
        </div>
    </div>
</section>



@endsection

@section('footer')
@include('layouts.site.footer')
@endsection

@section('scripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endsection
