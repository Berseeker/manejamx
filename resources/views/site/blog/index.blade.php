@extends('layouts.site.app')

@section('seo')
    <title>Blog Maneja.mx | Vehículos que se ajustan a tu presupuesto</title>
    <meta name="keywords" content="Entérate de todas las novedades de la industria automotriz. No te pierdas nuestro blog y descubre todo sobre comprar o vender un auto seminuevo en México.">
    <meta name="description" content="Entérate de todas las novedades de la industria automotriz. No te pierdas nuestro blog y descubre todo sobre comprar o vender un auto seminuevo en México.">
    <meta property="og:title" content="Blog Maneja.mx | Vehículos que se ajustan a tu presupuesto"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
    <meta property="og:description" content="Entérate de todas las novedades de la industria automotriz. No te pierdas nuestro blog y descubre todo sobre comprar o vender un auto seminuevo en México."/>
    <meta property="og:image:width" content="1290" />
    <meta property="og:image:height" content="980" />
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
  @include('layouts.site.nav')
@endsection

@section('content')
    <div class="blog">
        <div class="header-banner mb-5">
            <h1>
                BLOG
            </h1>
        </div>
        <site-blog category_id="{{ request()->get('category') }}"  ></site-blog>
    </div>
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection
