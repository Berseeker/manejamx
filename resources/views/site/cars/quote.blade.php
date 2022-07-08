@extends('layouts.site.app')

@section('seo')
    <title>Agendar| Maneja</title>
    <meta property="og:title" content="Vehículos que se ajustan a tu presupuesto - MANEJA"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
    <meta name="keywords" content="venta de autos online, comprar auto en linea, compra-venta de autos en linea">
    <meta name="description" content="¿Quieres vender tu auto o comprar uno? :auto: Con nuestro sistema 100% en línea, olvídate de las ventas tradicionales, aburridas y tediosas. ¡No lo dudes, #Maneja es tu mejor opción!:mano_con_signo_de_aprobación:">
    <meta property="og:description" content="¿Quieres vender tu auto o comprar uno? :auto: Con nuestro sistema 100% en línea, olvídate de las ventas tradicionales, aburridas y tediosas. ¡No lo dudes, #Maneja es tu mejor opción!:mano_con_signo_de_aprobación:"/>
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
  @include('layouts.site.nav')
@endsection

@section('content')
    <site-car-get-quote vehicle_id="{{ request()->route()->vehicle}}"></site-car-get-quote>
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
