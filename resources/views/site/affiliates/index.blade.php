@extends('layouts.site.app')

@section('seo')
    <title>Afiliados | Maneja: Compra y venta de autos usados</title>
    <meta property="og:title" content="Afiliados | Maneja: Compra y venta de autos usados"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
    <meta name="keywords" content="¡Comprar y Vender tu Auto nunca fue tan fácil y seguro!  Somos una empresa mexicana especializada en la compra-venta de vehículos: Ahorra tiempo y dinero. ">
    <meta name="description" content="¡Comprar y Vender tu Auto nunca fue tan fácil y seguro!  Somos una empresa mexicana especializada en la compra-venta de vehículos: Ahorra tiempo y dinero. ">
    <meta property="og:description" content="¡Comprar y Vender tu Auto nunca fue tan fácil y seguro!  Somos una empresa mexicana especializada en la compra-venta de vehículos: Ahorra tiempo y dinero. "/>
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
    @include('layouts.site.nav')
@endsection

@section('content')

    <div class="about-us">

        <div class="header-banner">
            <h1>
                ¡Únete a nuestro programa de afiliados!
            </h1>
        </div>

        <div class="we-sell-cars">
            <div class="head">
                <div class="text-center mt-4">
                    <hr class="title mb-3">
                    <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-4">
                        Forma parte de nuestro nuevo programa de vendedores afiliados
                        y comienza a obtener grandes beneficios con Maneja
                    </h2>
                </div>
            </div>

            <div class="body my-5">
                <h2 class="text-center mb-5">
                    Comienza a ganar con Maneja en tan solo 4 sencillos pasos:
                </h2>
                <div class="row">
                    <div class="col-md-3  d-flex flex-column justify-content-around align-items-center">
                        <img alt="registrate" class="img-fluid img-afiliate" src="{{ asset('/images/afiliado1.png') }}">
                        <h4 class="text-center">Regístrate en nuestro portal.</h4>
                    </div>
                    <div class="col-md-3  d-flex flex-column justify-content-around align-items-center">
                        <img alt="registra_automovil" class="img-fluid img-afiliate" src="{{ asset('/images/afiliado2.png') }}">
                        <h4 class="text-center">Da de alta en nuestra base de datos el automóvil que desees vender.</h4>
                    </div>
                    <div class="col-md-3  d-flex flex-column justify-content-around align-items-center">
                        <img alt="evaluacion" class="img-fluid img-afiliate" src="{{ asset('/images/afiliado3.png') }}">
                        <h4 class="text-center">Espera la calificación de nuestros valuadores y verifica tu vehículo.</h4>
                    </div>
                    <div class="col-md-3  d-flex flex-column justify-content-around align-items-center">
                        <img alt="disponible" class="img-fluid img-afiliate" src="{{ asset('/images/afiliado4.png') }}">
                        <h4 class="text-center">¡Listo! Tu automóvil ya está disponible para venta en nuestro sitio.</h4>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="/afiliados/registro" class="btn btn-primary btn-lg">Afíliate</a>
                </div>
            </div>

            <div class="body my-5">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column justify-content-center ">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        ¿Cuáles son los beneficios de confiar en Maneja?
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <ol>
                                        <li>Al dar de alta tu automóvil, se incluirá en nuestro catálogo de venta por internet.</li>
                                        <li>Podrás certificar que tu automóvil es seguro y se encuentra en óptimas condiciones.</li>
                                        <li>Obtendrás grandes comisiones por cada venta cerrada de cualquiera de tus vehículos.</li>
                                        <li>Podrás ingresar a nuestro sistema los vehículos que desees.</li>
                                        <li>Olvídate de la promoción de tu vehículo. Nosotros lo hacemos por ti.</li>
                                        <li>¡Llega a cualquier parte de México con Maneja!</li>
                                        <li>Facilitamos las formas de pago para tus clientes.</li>
                                    </ol>
                                </div>
                                <div class="text-center">
                                    <a href="/afiliados/registro" class="btn btn-primary btn-lg">Afíliate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  d-flex flex-column justify-content-around align-items-center">
                        <img alt="" src="{{ asset('/images/Maneja_1080x1080_we_sell_cars.png') }}">
                    </div>
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
