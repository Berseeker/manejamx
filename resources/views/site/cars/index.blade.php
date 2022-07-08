@extends('layouts.site.app')

@section('seo')
    <title>Encuentra los mejores autos usados en Saltillo | MANEJA</title>
    <meta name="keywords" content="venta autos usados saltillo, compra autos seminuevos saltillo, buscar autos saltillo, compra venta autos saltillo">
    <meta name="description" content="Encuentra los mejores autos seminuevos en Saltillo. Obtén precios justos y haz que tu inversión valga la pena.">
    <meta property="og:description" content="Encuentra los mejores autos seminuevos en Saltillo. Obtén precios justos y haz que tu inversión valga la pena."/>

    <meta name="author" content="Macasoft">
    <meta name="language" content="Spanish">
    <meta name="revisit" content="1 days">
    <meta name="distribution" content="Global">
    <meta name=robots content="index, follow">

    <meta property="og:type" content="website"/>
    <meta property="og:locale" content=es_MX>
    <meta property="og:url" content="https://maneja.mx"/>
    <meta property="og:site_name" content="Compra y venta de autos usados en Saltillo - MANEJA"/>
    <meta property="og:title" content="Compra y venta de autos usados en Saltillo - MANEJA"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="https://maneja.mx/autos">
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
  @include('layouts.site.nav')
@endsection

@section('content')
    <site-search-cars affiliate="{{ request('affiliate') }}"></site-search-cars>
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection
