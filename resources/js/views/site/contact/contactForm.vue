<template>
    <form class="theme-form" @submit.prevent="submit">
        <div v-if="successSubmitted" class="alert alert-success mb-5" role="alert">
           El formulario se ha enviado correctamente. Nos comunicaremos contigo a la brevedad!
        </div>
        <input type="hidden" name="_token" :value="csrf">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="group">
                    <input type="text" required v-model="form.name" name="name">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Nombre</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="group">
                    <vue-tel-input v-model="form.phone" mode="international" placeholder="Teléfono" required></vue-tel-input>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="group">
                    <input type="text" required v-model="form.email" name="email">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Email</label>
                    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                </div>
            </div>
            <div class="col-12">
                <div class="group">
                    <textarea name="message" v-model="form.message" required></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label :class="{'active': form.message}">Mensaje</label>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <small class="text-danger" v-if="errors.g_recaptcha_response">{{errors.g_recaptcha_response[0]}}</small>
            <button type="submit" class="btn btn-primary float-right" :disabled="formSubmitted">
                <template v-if="formSubmitted">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Enviando...
                </template>
                <template v-else>
                    Enviar
                </template>
            </button>
        </div>
    </form>
</template>

<script>
import Contact from '../../../models/site/Contact';

export default {
    props: ['csrf', 'recaptcha', 'calculator_inputs', 'from_calculator'],

    data() {
        return {
            form: {
                name: '',
                phone: '',
                email: '',
                message: '',
                calculator_inputs: null,
                from_calculator: false
            },
            formSubmitted: false,
            successSubmitted: false,
            errors: {}
        }
    },

    methods: {
        submit() {
            this.gtag_report_conversion();

            if (this.from_calculator) {
                this.form.calculator_inputs = this.calculator_inputs
                this.form.from_calculator = true
            }

            this.successSubmitted = false;
            this.formSubmitted    = true;
            this.errors           = {};

            grecaptcha.ready(function() {
                grecaptcha.execute(this.recaptcha, {action: 'submit'}).then(function(token) {

                    this.form.g_recaptcha_response = token;

                    Contact.store(this.form, data => {

                        this.successSubmitted = true
                        this.formSubmitted    = false

                        this.form = {
                            name   : '',
                            phone  : '',
                            email  : '',
                            message: ''
                        }

                    },error => {
                        this.errors        = error;
                        this.formSubmitted = false
                    });


                }.bind(this));
            }.bind(this));
        },

        gtag_report_conversion(url) {
            const callback = function () {
                if (typeof(url) != 'undefined') {
                    window.location = url;
                }
            };

            gtag('event', 'conversion', {
                'send_to': 'AW-400918395/aSPICOqrpKoDEPuOlr8B',
                'event_callback': callback
            });

            return false;

        },
    }
}
</script>

<style>
    label.active {
        color: #00aed9 !important;
    }

    .vue-tel-input {
        border-radius: 0px !important;
        border: 1px solid #CCCCCC !important;
        border-top-color: transparent !important;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
    }

    .vti__input {
        border: none !important;
    }
    .vti__input::placeholder  {
        color: #999999 !important;
        font-size: 16px !important;
        font-weight: normal !important;
    }

    .vti__input::placeholder  {
        color: #999999 !important;
        font-size: 16px !important;
        font-weight: normal !important;
    }
</style>
