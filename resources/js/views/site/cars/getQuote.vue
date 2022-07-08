<template>
    <div class="bg-theme-secondary">
        <section class="bg-white border-bottom border-light pl-5 pr-5 pt-4 pb-3">
            <div class="row ">
                <div class="col-3 d-none d-md-inline-block">
                    <p class="text-primary font-weight-bold align-middle h6 mt-4">Pasos</p>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="d-inline-block mr-2">
                            <img v-if="vehicle.three_sixty_images && vehicle.three_sixty_images[0]" :src="vehicle.three_sixty_images[0].show_url" width="60" height="60" class="rounded-circle" alt="">
                            <img v-else src="/images/silluete.png" width="60" height="60" class="rounded-circle" alt="">
                        </div>
                        <div class="d-inline-block mt-1">
                            <p class="text-primary font-weight-bold h6 m-0">{{ vehicle.year}} {{vehicle.brand ? vehicle.brand.name : ''}} {{vehicle.model ? vehicle.model.name :''}}</p>
                            <p class="text-primary font-weight-light h6 m-0">{{ vehicle.version ? vehicle.version.name : '' }}</p>
                            <p class="text-primary font-weight-light h6">{{ vehicle.odometer}} kilometros</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-2 text-right text-md-center pt-md-3">
                    <p class="text-primary-2 align-middle h6 m-0">{{ vehicle.sell_price | currency}}</p>
                    <p class="text-primary font-weight-light align-middle h6">Precio Total</p>
                </div>
            </div>
        </section>
        <section class="mb-3">
            <div class="row no-gutters">
                <div class="col-3 d-none d-md-inline-block">
                    <div class="border-bottom border-light pl-5 pr-5 pt-2 pb-2">
                        <div class="d-inline-block">
                            <!-- agregar radio -->
                        </div>
                        <div class="d-inline-block">
                            <p class="text-primary font-weight-bold mt-3  h6 mb-0">Agendar Cita</p>
                            <p class="text-primary font-weight-light">Alrededor de 3 minutos</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 offset-md-1">
                    <div class="pl-4 pl-md-0 pr-md-0 pr-4">

                        <template v-if="stored">
                            <div  class="alert alert-success mt-5 mb-4" role="alert">
                                <h4 class="alert-heading">Gracias por agendar una visita</h4>
                                <p>
                                    En breve uno de nuestros asesores se pondrá en contacto contigo para confirmar la fecha y hora seleccionada.
                                </p>
                            </div>
                            <a href="/autos" class="btn btn-primary btn-lg btn-block">Regresar al buscador</a>
                        </template>


                        <template v-if="!stored">
                            <div class="text-center pt-5">
                                <h2 class=" text-primary font-weight-bold text-uppercase">Información Personal</h2>
                                <p class="text-theme-light">Por favor completa los siguientes datos</p>
                            </div>
                            <div class="pt-3">
                                <form class="theme-form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <input class="control" type="text"  v-model="create.name" required>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Nombre</label>
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <input class="control" type="text" v-model="create.last_name" required>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Apellido</label>
                                                <small v-if="errors.last_name" class=" text-danger">{{ errors.last_name[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <input class="control" type="email" v-model="create.email" required>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Email</label>
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <vue-tel-input v-model="create.phone" mode="international" placeholder="Teléfono" required></vue-tel-input>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group">
                                                <input class="control" type="text" v-model="create.description">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Mensaje</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="font-weight-bold">Fecha Y hora</h4>
                                            <p class="text-theme-light">Indicanos cuando puedes visitarnos</p>
                                        </div>
                                        <div class="col-12 col-md-6 pt-2">
                                            <div class="group">
                                                <input class="control" type="date" v-model="create.date">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label class="active">Fecha</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pt-2">
                                            <div class="group">
                                                <input class="control" type="time" v-model="create.time">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label class="active">Hora</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" @click="store">Guardar y Enviar</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </template>

                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Vehicle from '../../../models/Vehicle';

    export default {

        props:['vehicle_id'],

        data(){
            return {
                stored : false,
                vehicle: {},
                create : {},
                errors : {}
            }
        },

        created(){
            this.show();
        },

        methods:{

            show(){
                Vehicle.show(this.vehicle_id, data => {
                    this.vehicle = data.data;
                    this.accessory_types = _.groupBy(this.vehicle.accessories, 'type.name')
                });
            },

            store(){
                this.gtag_report_conversion();

                Vehicle.storeQuoteRequest(this.vehicle_id, this.create, data => {
                    this.create = {};
                    this.errors = {};
                    this.stored = true;
                }, error => this.errors = error);
            },

            gtag_report_conversion(url) {
                const callback = function () {
                    if (typeof(url) != 'undefined') {
                        window.location = url;
                    }
                };

                gtag('event', 'conversion', {
                    'send_to': 'AW-400918395/ypSmCMGLpKoDEPuOlr8B',
                    'event_callback': callback
                });

                return false;
            }
        },

    }
</script>

<style>
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
