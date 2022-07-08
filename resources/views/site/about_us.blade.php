@extends('layouts.site.app')

@section('seo')
    <title>Sobre Nosotros | Maneja: Compra y venta de autos usados</title>
    <meta property="og:title" content="Sobre Nosotros | Maneja: Compra y venta de autos usados"/>
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
                ¿POR QUÉ MANEJA?
            </h1>
        </div>

        <div class="we-sell-cars">
            <div class="head">
                <div class="text-center mt-4">
                    <hr class="title mb-3">
                    <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-4">
                        VENDEMOS COCHES, PERO NO SOMOS VENDEDORES DE COCHES
                    </h2>
                    <p class="text-primary font-weight-light pt-4 h6">
                        Tu experiencia no termina una vez que recibes las llaves. Nuestro objetivo es asegurarnos
                        de que tenga tranquilidad cuando se trata de su nuevo viaje.
                    </p>
                </div>
            </div>

            <div class="body my-5">
                <div class="row">
                    <div class="col-md-6  d-flex flex-column justify-content-around align-items-center">
                        <img alt="" src="{{ asset('/images/Maneja_1080x1080_we_sell_cars.png') }}">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center ">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        Online significa ahorrar
                                    </h1>
                                    <p>
                                        Online significa ahorrar: Nuestro proceso 100% en línea, elimina a los intermediarios, por lo que obtendrás un precio más bajo desde el principio. Sin comisiones y sin tarifas ocultas.
                                    </p>
                                    {{-- <a href="#!">
                                        Conozca más
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        Recoge tu auto o recíbelo:
                                    </h1>
                                    <p>
                                        Con Maneja, tú decides cómo y cuándo recibirás tu automóvil. Te lo podemos entregar directamente en la puerta de tu casa, o lo puedes recoger en alguno de nuestros puntos de venta. ¡Tú eliges!

                                    </p>
                                    {{-- <a href="#!">
                                        Conozca más
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="my-5">
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-around align-items-center">
                        <a href="#!" class="btn btn-primary btn-lg rounded">Conozca más</a>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- <div class="we-are-looking"> --}}
            {{-- <div class="head">
                <div class="text-center mt-4">
                    <hr class="title mb-3">
                    <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-4">
                        ESTAMOS CUIDANDO POR USTED
                    </h2>
                    <p class="text-primary font-weight-light pt-4 h6">
                        Todos los vehículos Maneja vienen de serie con una garantía limitada de 100
                        días / 4,189 millas. En caso de que ocurra algo, nos ocuparemos de ello para que pueda estar tranquilo.
                    </p>
                </div>
            </div> --}}

           {{--  <div class="body my-5">
                <div class="row d-flex">
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center order-2 order-md-1">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        Inspeccionado y perfeccionado
                                    </h1>
                                    <p>
                                        Cada uno de nuestros autos pasa por una estricta inspección de 150 puntos para asegurarse de
                                        que cumple con nuestros altos estándares. Incluso incluimos un informe gratuito de Carfax,
                                        porque si no es lo suficientemente bueno para nosotros, tampoco lo es para usted.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        7 días para amarlo o devolverlo
                                    </h1>
                                    <p>
                                        Cada automóvil de Maneja viene con una política de devolución de 7 días. Pruébelo y vea si
                                        realmente se adapta a su vida. Si no le gusta después de 7 días, simplemente devuélvalo. Es fácil.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-around align-items-center order-1 order-md-2">
                        <img alt="" src="{{ asset('/images/Maneja_2252×2256_inspection.png') }}">
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}

       {{--  <div class="giving-back">
            <div class="body mb-5">
                <div class="row">
                    <div class="col-md-6  d-flex flex-column justify-content-around align-items-start">

                        <div class="text">
                            <div class="text-center text-md-left mt-4">
                                <hr class="title mb-3">
                                <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-4">
                                    Devolviendo
                                </h2>
                                <p class="text-primary font-weight-light pt-4 h6">
                                    En Maneja, ponemos a las personas en primer lugar y en segundo lugar la venta
                                    de automóviles. Es por eso que retribuir a las comunidades locales es una parte importante de la misión de nuestra empresa.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        Programa de viaje compartido
                                    </h1>
                                    <p>
                                        El programa de viaje compartido es una iniciativa liderada por la comunidad de Maneja en la que ayudamos a difundir la buena voluntad mediante
                                        la donación de vehículos a las personas nominadas por sus amigos, familiares y vecinos para que tengan un impacto en su comunidad.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="text">
                                    <h1>
                                        Donación de automóvil a un héroe local
                                    </h1>
                                    <p>
                                        Siempre buscamos ayudar a quienes ayudan a otros. Entonces, cuando supimos que la residente de Phoenix, Shannon Vivar, usó su automóvil
                                        para proteger a una familia de un presunto conductor ebrio, no perdimos el tiempo en ayudarla.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div id="faqs" class="faq">
            <div class="head">
                <div class="text-center mt-4">
                    <hr class="title mb-3">
                    <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-4">
                        Preguntas frecuentes<span class="text-lowercase"></span>
                    </h2>
                </div>
            </div>

            <div class="body my-5">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <h5 class="mb-0 title">
                                ¿Cómo funciona tu proceso?
                                <svg class="float-right" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 11.5L8 5L2 11.5" stroke="#00AED9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    ¡Gran pregunta! En nuestra página de búsqueda, mostramos una vista de 360 grados de nuestros autos sin accidentes en línea y ofrecemos
                                    Entrega sin contacto directamente en su entrada. Para obtener más información sobre nuestras medidas de seguridad, haga clic aquí.
                                </p>
                                <p>
                                    Una vez que haya seleccionado el automóvil que le interesa, le pediremos que elija su método de pago, incluso si desea utilizar
                                    un intercambio como pago inicial, y cargar documentos exclusivos de su compra.
                                </p>
                                <p>
                                    A continuación, puede optar por agregar cobertura o protección adicional a su nuevo automóvil.
                                </p>
                                <p>
                                    Por último, elegirás si quieres que te entreguen tu coche nuevo o si prefieres recogerlo. Una vez que reciba su vehículo, obtendrá una prueba de 7 días. Si cambia de opinión dentro de esos 7 días, lo retiraremos o lo cambiaremos por otro hasta 3 veces.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0 title">
                                Pregunta 2
                                <svg class="float-right" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 11.5L8 5L2 11.5" stroke="#00AED9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos doloribus ea fugiat illum libero officia pariatur repellat sapiente
                                    tempora? Corporis cupiditate ea, ex magni minus optio quae quis reprehenderit veritatis.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h5 class="mb-0 title">
                                Pregunta 3
                                <svg class="float-right" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 11.5L8 5L2 11.5" stroke="#00AED9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi cupiditate delectus doloribus, eligendi eos in iure labore mollitia
                                    nihil nobis perspiciatis porro quis quo reiciendis sunt temporibus voluptatem voluptatibus?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

@endsection

@section('footer')
@include('layouts.site.footer')
@endsection

@section('scripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endsection
