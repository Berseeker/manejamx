@extends('layouts.site.app')

@section('seo')
    <title>{{ $vehicle->getFullName() }} | MANEJA</title>
    <meta name="keywords" content="venta autos seminuevos saltillo, compra autos seminuevos saltillo, buscar autos
    saltillo, compra venta autos saltillo, {{ $vehicle->getFullName() }}">
    <meta name="description" content="{{ $vehicle->description }}">
    <meta property="og:description" content="{{ $vehicle->description }}"/>

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
    <site-car vehicle_id="{{ $vehicle->id}}"></site-car>
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection
