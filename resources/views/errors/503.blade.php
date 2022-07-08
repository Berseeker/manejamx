
@extends('layouts.site.app')

@section('seo')
    <title>Próximamente - MANEJA</title>
@endsection

@section('style')
    body{
        
    }

    .header{
        background: url(/images/fotos_website/1800x600_maneja_.png);
        background-position: top;
        background-size: cover;
        background-repeat:no-repeat;
        height:auto;
    }

    main{
        height:100vh;
    }

    input{
        color: white !important;
    }

@endsection
@section('head')
    @include('layouts.site.head')
    <script src="https://www.google.com/recaptcha/api.js?render={{env('RECAPTCHA_V3_SITE_KEY')}}"></script>
@endsection

@section('content')
    <div class="header text-center pb-4">
        <article class="header-title m-0 text-center w-100 ">
            <img src="/images/maneja_logo_dark.png" class="img-fluid" alt="maneja logo" style="max-height: 200px" >
            <h1 class="mb-n text-white" style="color: white !important">Próximamente  <span class=" title-1 d-block  mt-4">¡Compra o Vende tu auto en unos cuantos clics!</span></h1>
            <div class="row no-gutters mt-5 ">
                <div class="col-12 col-md-8 offset-md-2 p-4" style="background: rgba(0, 0, 0, .6);">
                    <contact-form from_calculator="{{request()->from_calculator}}"
                        calculator_inputs="{{json_encode(request()->only(['year', 'vehicle_price', 'load_deposit', 'loan_installments']))}}"
                        recaptcha="{{env('RECAPTCHA_V3_SITE_KEY')}}"
                        csrf="{{@csrf_token()}}"
                    ></contact-form>
                </div>
            </div>
        </article>
        <div id="qlwapp" class="qlwapp-free qlwapp-bubble qlwapp-bottom-right qlwapp-all qlwapp-rounded qlwapp-js-ready desktop">
            <div class="qlwapp-container">
                <a class="qlwapp-toggle" data-action="open" data-phone="+528442182830" data-message="" href="https://wa.me/528442182830?" target="_blank">
                    <i class="qlwapp-icon qlwapp-whatsapp-icon"></i>
                    <i class="qlwapp-close" data-action="close">×</i>
                    <!-- <span class="qlwapp-text">How can I help you?</span> -->
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection


