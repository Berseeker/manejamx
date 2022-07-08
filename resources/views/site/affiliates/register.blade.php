@extends('layouts.site.app')

@section('seo')
    <title>Regístrate como Afiliado | Maneja.mx</title>
    <meta property="og:title" content="Regístrate como Afiliado | Maneja.mx"/>
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
    <affiliate-register></affiliate-register>
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
