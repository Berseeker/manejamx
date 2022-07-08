@extends('layouts.site.app')

@section('seo')
    <title>Calcula la mensualidad para comprar tu auto | Maneja.mx</title>
    <meta property="og:title" content="Vehículos que se ajustan a tu presupuesto - MANEJA"/>
<meta property="og:image" content="https://maneja.mx/images/maneja_logo.png.png" />
<meta name="keywords" content="Nuestra calculadora online te permite medir el presupuesto para comprar el vehículo de tus sueños ¡Cuida tu inversión con un auto seminuevo con garantía!">
<meta name="description" content="Nuestra calculadora online te permite medir el presupuesto para comprar el vehículo de tus sueños ¡Cuida tu inversión con un auto seminuevo con garantía!">
<meta property="og:description" content="Nuestra calculadora online te permite medir el presupuesto para comprar el vehículo de tus sueños ¡Cuida tu inversión con un auto seminuevo con garantía!"/>
@endsection

@section('head')
@include('layouts.site.head')
@endsection

@section('nav')
@include('layouts.site.nav')
@endsection

@section('content')
<div class="loan-calculator">
    <div class="loan-calculator-container">
        <div class="loan-calculator-row">
            <div class="loan-calculator-mobile mobile-header">
                <div itemprop="instrument">
                    <p>
                        Calculadora de préstamos automáticos
                    </p>
                </div>
            </div>
            <div class="loan-calculator-wrapper">
                <div class="loan-calculator-display-wrapper">
                    <div class="loan-calculator-display-toggle loan-calculator-row" role="tablist">
                        <div class="loan-calculator-toggle col-xs-12 active" role="tab" aria-selected="true" tabindex="0">
                            Calculadora de Préstamos
                        </div>
                    </div>
                    <div class="loan-calculator-display is-monthly-display">
                        <div class="loan-calculator-display-value" id="loan-calculator-display-value">
                            $11,604.5
                        </div>
                    </div>
                    <div class="loan-calculator-body" role="tabpanel">
                        <div>
                            <div>
                                <div class="floating-text-box form-group form-field-blank">
                                    <label class="floating-text-box-label floating-text-box-label-show-hide floating-text-box-label-error">
                                        <div>
                                            <span class="loan-calculator-field-label">Año de la unidad</span>
                                            <select name="vehicle-year" id="vehicle-year" type="number" class="form-control" required="">

                                            </select>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="floating-text-box form-group form-field-blank">
                                    <label class="floating-text-box-label floating-text-box-label-show-hide floating-text-box-label-error">
                                        <div>
                                            <span class="loan-calculator-field-label">Valor de la unidad</span>
                                            <div class="loan-calculator-input-group">
                                                <span class="loan-calculator-dollar">$</span>
                                                <input name="vehicle-price" id="vehicle-price" value="500000" class="form-control" decimals="0" required="">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="floating-text-box form-group form-field-blank">
                                    <label class="floating-text-box-label floating-text-box-label-show-hide floating-text-box-label-error">
                                        <div>
                                            <span class="loan-calculator-field-label">Depósito o Enganche</span>
                                            <div class="loan-calculator-input-group">
                                                <span class="loan-calculator-dollar">$</span>
                                                <input name="loan-deposit" id="loan-deposit" value="70000" class="form-control" decimals="0" required="">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="floating-text-box form-group form-field-blank">
                                    <label class="floating-text-box-label floating-text-box-label-show-hide floating-text-box-label-error">
                                        <div>
                                            <span class="loan-calculator-field-label">Plazo</span>
                                            <select name="loan-installments" id="loan-installments" type="number" class="form-control" required="">
                                                <option value="72" selected="selected">72 Meses</option>
                                                <option value="60">60 Meses</option>
                                                <option value="48">48 Meses</option>
                                                <option value="36">36 Meses</option>
                                                <option value="24">24 Meses</option>
                                            </select>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="maneja-loan-calc" id="contact-button" href="/contacto" target="_self">OBTENGA FINANCIAMIENTO PERSONALIZADO</a>
                    <p class="loan-calculator-disclaimer">*Los impuestos y cargos no están incluidos en el monto estimado. Esta cantidad puede ser diferente a los términos y condiciones de financiamiento de maneja.mx</p>
                </div>
            </div>
            <div class="loan-calculator-content">
                <div class="loan-calculator-desktop">
                    <p class="loan-calculator-title" role="heading" aria-level="1">Calcula Tu Mensualidad</p>
                </div>
                <div>
                    <h2 role="presentation" class="">
                        Utiliza la calculadora de préstamos automáticos de Maneja y averigua el presupuesto necesario para comprar el auto de tus sueños.
                        <br>
                        <br>
                        ¡Adquirir un auto en Maneja es la forma más segura de comprar un seminuevo, ya que nuestros autos están verificados mecánica y legalmente!
                    </h2>
                    <ul class="cta-bullet-points ">
                        <li><h3 role="presentation" class="">¡Compra tu auto en minutos!</h3></li>
                        <li><h4 role="presentation" class="">Maneja puede llevar tu auto hasta tu hogar (aplicando restricciones y/o tarifas adicionales).</h4></li>
                        <li><h5 role="presentation" class="">¡Adquiere tu auto sin salir de casa!</h5></li>
                    </ul>
                    <img class="loan-calculator-arrow loan-calculator-desktop" src="{{ asset('images/loan-calculator-arrow.png') }}" alt="auto loan calculator, car loan calculator, car loan calc">
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
<script>

    let formatter = new Intl.NumberFormat('en-US', {

        currency: 'USD',

        // These options are needed to round to whole numbers if that's what you want.
        //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
        //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    });


    let tna = 11.99;

    let tnm = tna / 12;

    // Valor de la unidad.
    let vehiclePrice = $('#vehicle-price')

    // Enganche
    let loanDeposit = $('#loan-deposit')

    // Cuotas/Plazo
    let loanInstallments = $('#loan-installments')

    // Año del vehiculo
    let vehicle_year = $('#vehicle-year')


    function calculate() {

        let tna = 11.99;

        let tnm = tna / 12;

        let vehiclePrice = reverseFormatNumber($('#vehicle-price').val())

        $('#vehicle-price').val(formatter.format(vehiclePrice))

        let loanDeposit = reverseFormatNumber($('#loan-deposit').val())

        $('#loan-deposit').val(formatter.format(loanDeposit))

        let loanInstallments = parseInt($('#loan-installments').val())

        let financing = vehiclePrice - loanDeposit

        let others = (financing * 2.5) / 100

        let financing_plus_others = financing + others

        let $I = tnm / 100;

        let $I2 = $I + 1 ;

        $I2 = Math.pow($I2,-loanInstallments) ;

        $CuotaMensual = ($I * financing_plus_others) / (1 - $I2) ;

        $('#loan-calculator-display-value').html(formatter.format($CuotaMensual.toFixed(1)))

    }

    function reverseFormatNumber(val){
        var group = new Intl.NumberFormat('en').format(1111).replace(/1/g, '');
        var decimal = new Intl.NumberFormat('en').format(1.1).replace(/1/g, '');
        var reversedVal = val.replace(new RegExp('\\' + group, 'g'), '');
        reversedVal = reversedVal.replace(new RegExp('\\' + decimal, 'g'), '.');
        return Number.isNaN(reversedVal)?0:reversedVal;
    }

    loanInstallments.change(function() {
        calculate()
    })

    loanDeposit.change(function() {
        calculate()
    })

    vehiclePrice.change(function() {
        calculate()
    })

    vehiclePrice.click(function() {
        $('#vehicle-price').val(reverseFormatNumber($('#vehicle-price').val()))
    })

    vehiclePrice.focusout(function(){
        calculate()
    })

    loanDeposit.click(function() {
        $('#loan-deposit').val(reverseFormatNumber($('#loan-deposit').val()))
    })

    loanDeposit.focusout(function(){
        calculate()
    })

    $( document ).ready(function() {
        calculate()
    });

    let current_year = new Date().getFullYear()

    for (i = 0; i < 9; i++) {
        let value = current_year - i
        $('#vehicle-year').append(`<option value="${value}">${value}</option>`);
    }

    vehicle_year.change(function() {
        if (this.value == current_year) {
            $("#loan-installments option[value=72]").show();
            $("#loan-installments option[value=60]").show();
            $("#loan-installments option[value=48]").show();
            $("#loan-installments option[value=36]").show();
            $("#loan-installments option[value=24]").show();
            $("#loan-installments").val(72)
        }

        if (this.value == current_year - 1) {
            $("#loan-installments option[value=72]").hide();
            $("#loan-installments option[value=60]").show();
            $("#loan-installments option[value=48]").show();
            $("#loan-installments option[value=36]").show();
            $("#loan-installments option[value=24]").show();
            $("#loan-installments").val(60)
        }

        if (this.value < current_year - 1 && this.value > current_year - 5) {
            $("#loan-installments option[value=72]").hide();
            $("#loan-installments option[value=60]").hide();
            $("#loan-installments option[value=48]").show();
            $("#loan-installments option[value=36]").show();
            $("#loan-installments option[value=24]").show();
            $("#loan-installments").val(48)
        }

        if (this.value < current_year - 4 && this.value > current_year - 7) {
            $("#loan-installments option[value=72]").hide();
            $("#loan-installments option[value=60]").hide();
            $("#loan-installments option[value=48]").hide();
            $("#loan-installments option[value=36]").show();
            $("#loan-installments option[value=24]").show();
            $("#loan-installments").val(36)
        }

        if (this.value < current_year - 6 && this.value > current_year - 9) {
            $("#loan-installments option[value=72]").hide();
            $("#loan-installments option[value=60]").hide();
            $("#loan-installments option[value=48]").hide();
            $("#loan-installments option[value=36]").hide();
            $("#loan-installments option[value=24]").show();
            $("#loan-installments").val(24)
        }
        calculate()
    })

    $('#contact-button').click(function(e){
        
        e.preventDefault()

        window.location.href = `/contacto?year=${vehicle_year.val()}&vehicle_price=${vehiclePrice.val()}&load_deposit=${loanDeposit.val()}&loan_installments=${loanInstallments.val()}&from_calculator=true`;
    })

</script>
@endsection
