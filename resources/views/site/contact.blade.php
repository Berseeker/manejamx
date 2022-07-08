@extends('layouts.site.app')

@section('seo')
    <title>Contáctanos para resolver tus dudas | Maneja.mx</title>
    <meta property="og:title" content="Contáctanos para resolver tus dudas | Maneja.mx"/>
    <meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
    <meta name="keywords" content="¡En Maneja valoramos tu inversión! Nuestro equipo te apoyará y orientará en todo el proceso. Mándanos un mensaje para resolver tus dudas. ">
    <meta name="description" content="¡En Maneja valoramos tu inversión! Nuestro equipo te apoyará y orientará en todo el proceso. Mándanos un mensaje para resolver tus dudas. ">
    <meta property="og:description" content="¡En Maneja valoramos tu inversión! Nuestro equipo te apoyará y orientará en todo el proceso. Mándanos un mensaje para resolver tus dudas. "/>
@endsection

@section('head')
    @include('layouts.site.head')
    <script src="https://www.google.com/recaptcha/api.js?render={{env('RECAPTCHA_V3_SITE_KEY')}}"></script>
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
    {{--@if(session('errors'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('errors') }}
        </div>
    @endif--}}

    <section class="bg-transparent">
        <div class="contact-form-wrapper">
            <div class="text-center">
                <hr class="title mb-3">
                <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-5">Formulario de contacto</h2>
                @if(request()->year && request()->vehicle_price && request()->load_deposit && request()->loan_installments)
                    <div class="container d-flex justify-content-center mb-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <span>
                                        <i class="far fa-circle text-theme-secondary"></i>
                                        Año de la unidad {{ request()->year }}
                                    </span>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <span class="ml-2">
                                        <i class="far fa-circle text-theme-secondary"></i>
                                        Valor de la unidad ${{ request()->vehicle_price }}
                                    </span>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <span class="ml-2">
                                        <i class="far fa-circle text-theme-secondary"></i>
                                        Depósito ${{ request()->load_deposit }}
                                    </span>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <span class="ml-2">
                                        <i class="far fa-circle text-theme-secondary"></i>
                                        Plazo {{ request()->loan_installments }} Meses
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class=" pt-4 bg-transparent">
                <div class="container d-flex justify-content-center">
                    <contact-form from_calculator="{{request()->from_calculator}}"
                                  calculator_inputs="{{json_encode(request()->only(['year', 'vehicle_price', 'load_deposit', 'loan_installments']))}}"
                                  recaptcha="{{env('RECAPTCHA_V3_SITE_KEY')}}"
                                  csrf="{{@csrf_token()}}"
                    ></contact-form>
                </div>
            </div>
        </div>
    </section>

    <section id="soporte" class="bg-white">
        <div class="contact-wrapper bg-white">
            <div class="is-responsive main">
                <div class="yellow-bar"></div>
                <p class="title-1 text-primary font-weight-bold text-uppercase mb-5">Contáctanos</p>
                <div class="main-content-responsive main-content-padding">
                    <div class="main-box">
                        <div class="contact-cards">
                            <div class="card-content">
                                <div class="full-svg">
                                    <i class="fab fa-whatsapp-square text-success fa-7x"></i>
                                </div>
                                <div class="responsive-svg">
                                    <i class="fab fa-whatsapp-square text-success fa-4x"></i>
                                </div>
                                <div>
                                    <p class="card-text">¿En qué te podemos ayudar hoy?</p>
                                    <a href="tel:+528442182830" class="chat-with-us">Chatea con nosotros</a>
                                </div>
                            </div>
                        </div>
                        <div display="block" class="contact-cards">
                            <div class="card-content">
                                <div class="full-svg">
                                    <img width="105" height="104" src="{{ asset('images/iconos/maneja_iconos_website_-11.png') }}" alt="">
                                </div>
                                <div class="responsive-svg">
                                    <img width="50" height="50" src="{{ asset('images/iconos/maneja_iconos_website_-11.png') }}" alt="">
                                </div>
                                <div>
                                    {{-- <div class="wait-time-container">
                                        <div class="wait-time-svg">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none">
                                                <circle cx="8.50054" cy="8.82574" r="5.67437" stroke="white"></circle>
                                                <path d="M10.7612 10.7973C10.4305 11.1765 10.0098 11.4664 9.53768 11.6404C9.06557 11.8144 8.55727 11.8669 8.05958 11.793C7.56188 11.7191 7.09077 11.5212 6.68959 11.2175C6.28841 10.9139 5.97005 10.5142 5.76381 10.0552C5.55758 9.59626 5.47008 9.09282 5.50939 8.5912C5.54869 8.08959 5.71353 7.60591 5.98873 7.18469C6.26393 6.76347 6.64065 6.41823 7.08423 6.18074C7.52781 5.94325 8.024 5.82115 8.52713 5.82566L8.50022 8.82554L10.7612 10.7973Z" fill="white"></path>
                                                <path d="M8.5 1V2.76411" stroke="white"></path>
                                                <path d="M7.03125 1L9.97143 1" stroke="white" stroke-linecap="round"></path>
                                                <path d="M3.5293 3.95361L4.3609 4.78522" stroke="white"></path>
                                                <path d="M2.70117 4.37256L3.94858 3.12515" stroke="white" stroke-linecap="round"></path>
                                            </svg>
                                        </div>
                                        <p>Tiempo de espera:&nbsp;
                                            <strong>4 Minutos</strong>
                                        </p> --}}
                                    </div>
                                    <p class="card-text">lunes a viernes: 9 a.m. a 8 p.m., sábados: 9 a.m. a 6 p.m., domingos: 11a.m. a 6p.m.</p>
                                    <a href="#" class="phne">+52 (844)438-8031</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
