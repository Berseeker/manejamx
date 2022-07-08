<template>
    <div class="container-fluid bg-white">
        <header class="container-fluid pt-3 pb-3">
            <div class="row mb-3">
                <div class="col-6">
                    <a href="/autos" class="light-link"><i class="fas fa-chevron-left mr-1"></i> Regresar</a>
                </div>
                <div class="col-6 text-right">
                    <a href="#" v-clipboard="clipboard"
                            v-clipboard:success="clipboardSuccessHandler"
                            class="light-link "
                    >
                    <i class="fas fa-share-square h5"></i>
                    Compartir
                    </a>
                    <a href="#!" @click="toggleLike" class="bg-white mt-1 ml-3 mr-2 d-md-none "><span class="fas fa-lg fa-heart" :class="liked"></span></a>
                </div>
            </div>
            <div class="row d-none d-md-flex">
                <div class="col-12 col-md-6">
                    <h1 class="mb-0 font-weight-bold text-primary" style="font-size:22px;">
                        {{vehicle.year}} {{vehicle.brand ? vehicle.brand.name : ''}} {{vehicle.model ? vehicle.model.name : ''}}
                    </h1>
                    <p class="text-light-2 font-weight-light h6">{{vehicle.version ? vehicle.version.name:''}} | {{  vehicle.odometer}} {{vehicle.odometer?'Kilometros':''}}</p>
                </div>
                <div class="col-12 col-md-6 text-right">
                    <h3 class="d-inline font-weight-bold mt-2 text-primary"  style="font-size:22px;">{{ vehicle.sell_price | currency}}</h3>
                    <a href="#!" @click="toggleLike" class="bg-white mt-1 ml-2 mr-2 "><span class="fas fa-lg fa-heart" :class="liked"></span></a>
                    <a v-if="vehicle.status && vehicle.status.id == 1" :href="'/autos/'+vehicle_id+'/cotizar'" class="btn btn-primary btn-lg">Cotizar</a>
                    <button v-if="vehicle.status && vehicle.status.id == 2" disabled class="btn btn-danger btn-lg">{{vehicle.status.name}}</button>
                </div>
            </div>
            <div class="row d-md-none">
                <div class="col-12 col-md-6">
                    <h1 class="mb-0 font-weight-bold text-primary" style="font-size:22px;">
                        {{vehicle.year}} {{vehicle.brand ? vehicle.brand.name : ''}} <br> {{vehicle.model ? vehicle.model.name : ''}}
                    </h1>
                    <p class="text-light-2 font-weight-light h6">{{vehicle.version ? vehicle.version.name:''}}</p>
                </div>
                <div class="col-12 col-md-6 mt-2">
                    <h3 class="d-inline font-weight-bold mt-1 d-inline text-primary"  style="font-size:22px;">{{ vehicle.sell_price | currency}} </h3>
                    <p class="text-light-2 font-weight-light h6 d-inline">| {{ vehicle.odometer}} Kilometros</p>
                </div>
            </div>
        </header>

        <div class="row position-relative">
            <div v-if="vehicle.id && vehicle.three_sixty_images.length == 0 && vehicle.principal_images && vehicle.principal_images.length > 0">
                <img :src="vehicle.principal_images[0].show_url" class="img-fluid pointer" :alt="vehicle.model.name" @click.prevent="open = true">
            </div>
            <vue-three-sixty
                v-if="vehicle.id && vehicle.three_sixty_images && vehicle.three_sixty_images.length > 0"
                :amount=vehicle.three_sixty_images.length
                :imagePath="'/storage/vehicles/'+vehicle.id+'/images/360'"
                fileName="{index}"
                :disableZoom="false"
                :scrollImage="true"
            />
        </div>

        <div class="row d-none d-lg-block">
            <div class="container py-4">
                <div class="text-center">
                    <a href="#details" class="btn btn-link text-uppercase">Detalles del Vehículo</a>
                    <a href="#inspection" class="btn btn-link text-uppercase">Inspección</a>
                    <a href="#makeIt" class="btn btn-link text-uppercase">Cotizador</a>
                </div>
            </div>
        </div>
        <div class="row bg-theme-light">
            <div class="container py-4  d-none d-lg-block">
                <div class="text-center">
                    <a href=""><i class="fas fa-heart fa-lg text-muted"></i> <strong>{{ likes }}</strong> <span class="text-muted">Marcaron como Favorito</span> </a>
                    <a  class="ml-2"><i class="fas fa-eye  fa-lg text-muted"></i> <strong>{{ views }}</strong> <span class="text-muted">Vistas recientemente</span> </a>
                </div>
            </div>

            <div v-show="vehicle.id" class="w-100 pt-5 pt-lg-4">
                <carousel v-if="vehicle.images" :open="open" :media="vehicle.images"></carousel>
            </div>
        </div>

        <div id="details" class="container-fluid container-lg pt-4">

            <hr>

            <div class="text-center mt-4">
                <hr class="title">
                <h2 class="title-1 text-primary font-weight-bold">Detalles del Vehículo</h2>
            </div>

            <div class="details py-4 ">
                <div class="row">
                    <div class="col-12 col-lg-12 main">
                        <div class="card bg-theme-light border-0 rounded-0">
                            <div class="card-body">
                                <label class="text-primary font-weight-normal h6">Descripción</label>
                                <p class="h6" v-html="vehicle.description"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 d-none d-lg-inline-block">
                        <button class="btn btn-dark btn-block text-uppercase bg-theme-dark">Caracteristicas</button>
                    </div>
                    <div class="col-12 col-lg-10 main">
                        <div class="row">
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Cilindraje</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    <template v-for="(cylinder, index) in vehicle.cylinders">
                                                        {{cylinder.name}} {{ (vehicle.cylinders.length == index+1) ? '':', '  }}
                                                    </template>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Consumo</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">{{ vehicle.fuel_consumption ? vehicle.fuel_consumption : 'N/A'}} Km / L</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-lg-2">
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Color Exterior</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    <template v-for="(color, index) in vehicle.colors">
                                                        {{color.name}} {{ (vehicle.colors.length == index+1) ? '':', '  }}
                                                    </template>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Color Interior</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    <template v-for="(interior_color, index) in vehicle.interior_colors">
                                                        {{interior_color.name}} {{ (vehicle.interior_colors.length == index+1) ? '':', '  }}
                                                    </template>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-lg-2">
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Transmisión</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    <template v-for="(transmission, index) in vehicle.transmissions">
                                                        {{transmission.name}} {{ (vehicle.transmissions.length == index+1) ? '':', '  }}
                                                    </template>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Tracción</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    <template v-for="(drive, index) in vehicle.drives">
                                                        {{drive.name}} {{ (vehicle.drives.length == index+1) ? '':', '  }}
                                                    </template>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-lg-2">
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Combustible</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    <template v-for="(fuel, index) in vehicle.fuels">
                                                        {{fuel.name}} {{ (vehicle.fuels.length == index+1) ? '':', '  }}
                                                    </template>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Kilometraje</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">
                                                    {{vehicle.odometer ? vehicle.odometer: 'N/A'}} Km
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-lg-2 ">
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Puertas</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">{{vehicle.doors}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Número de llaves</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">{{vehicle.keys}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-lg-2">
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">Número de Serie</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="text-uppercase h6">{{vehicle.vin}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 pt-1">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6">ID</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="h6">{{vehicle.id}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-2 " v-for="(type,key) in  accessory_types" :key="key">
                            <div class="col-sm-12 border-bottom" >
                                <div class="card  border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-3 col-lg-4 align-middle mb-4">
                                                <p class="text-primary font-weight-normal h6 text-uppercase">{{key}}</p>
                                            </div>
                                            <div class="col-12 col-md-9 col-lg-8">
                                                <div class="row">
                                                    <div class="col-6" v-for="accessory in type" :key="'a_'+accessory.id">
                                                        <p class="dot position-relative h6"><span></span>{{accessory.name}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="makeIt" class="row py-4 bg-theme-light">
            <div class="container-fluid container-lg">
                <div class="text-center mt-4 mb-4">
                    <hr class="title">
                    <h2 class="title-1 text-primary font-weight-bold">Cotizador</h2>
                </div>
                <div class="row bg-primary pt-4 pb-2 mb-3 d-lg-none">
                    <div class="col-12 text-md-center">
                        <h4 class="d-inline d-md-block text-white">{{ vehicle.sell_price |currency }}</h4><p class="d-inline d-md-block text-theme-secondary font-weight-light"> Precio Total</p>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12 col-lg-8">
                        <ul class="nav nav-tabs">
                            <li class="pay nav-item">
                                <a class="nav-link active text-uppercase text-primary font-weight-bold" href="#"><i class="fas fa-money-bill d-none d-lg-inline"></i> Pago de Contado</a>
                            </li>
                        </ul>
                        <div class="card mt-4 mb-4">
                            <div class="card-body font-weight-light">
                                ¿Pagando en efectivo? Aplique cualquier plan de protección para ver su precio total.
                            </div>
                        </div>
                        <div class="row d-lg-none">
                            <div class="col col-md-6 offset-md-3 col-lg-6 offset-lg-0">
                                <div class="row">
                                    <div class="col-2 col-md-3">
                                        <svg viewBox="0 0 56.16 36.43" class="TradeIn-bp1lnm-0 cpyNFW tradeInsstyles__TradeInIcon-q2gb43-5 ghlRhx" data-qa="trade-in"><g><path d="M20.94,18.24H16.86a5,5,0,0,0-9.79,0H2v-4.6a2,2,0,0,1,2.05-2.18H8a1,1,0,0,0,.61-.21l6.51-5.07L13.34,5,7.65,9.46H4.06a4.43,4.43,0,0,0-2.93,1.17,4.07,4.07,0,0,0-1.13,3v5.6a1,1,0,0,0,1,1H7.07a5,5,0,0,0,9.79,0h4.08v2.49l6-3.49-6-3.49Zm-9,4a3,3,0,1,1,3-3A3,3,0,0,1,12,22.24Z"></path><path d="M45.85,13.77c-.09-.17-2.26-4.16-8.47-4.34L30.73,2.78a1,1,0,0,0-.7-.29H21V0L15,3.49,21,7V4.49h8.61l6.65,6.65a1,1,0,0,0,.7.29c4.14,0,6.12,1.93,6.81,2.83a12,12,0,0,1,2.17-.21A.92.92,0,0,0,45.85,13.77Z"></path><path d="M34.13,22.24a3,3,0,1,1,2.78-4.13,12,12,0,0,1,1.51-1.43A5,5,0,1,0,34,24.22a12.21,12.21,0,0,1,.52-2C34.37,22.21,34.25,22.24,34.13,22.24Z"></path><path d="M46,16.05A10.19,10.19,0,1,0,56.16,26.24,10.2,10.2,0,0,0,46,16.05Zm0,18.57a8.39,8.39,0,1,1,8.39-8.38A8.39,8.39,0,0,1,46,34.62Zm2.88-8.57A3.81,3.81,0,0,0,47,25.31l-.31,0V22.67a3.32,3.32,0,0,1,.79.21,3.52,3.52,0,0,1,.71.46l.11.1,1.18-1.16-.14-.12a4.92,4.92,0,0,0-1.23-.82,5.24,5.24,0,0,0-1.31-.29V20.3H45.33v.77a5.6,5.6,0,0,0-1.09.3,2.88,2.88,0,0,0-1,.68,2.91,2.91,0,0,0-.72,2,2.6,2.6,0,0,0,.72,1.89,3.12,3.12,0,0,0,2,.88l.2,0v2.68a3.74,3.74,0,0,1-1.08-.25,3.46,3.46,0,0,1-.87-.63l-.12-.11-1.22,1.22.13.12a4.92,4.92,0,0,0,1.44,1,5.8,5.8,0,0,0,1.6.34v1h1.44V31.11a4.72,4.72,0,0,0,1.36-.38,2.73,2.73,0,0,0,1.58-2.57A2.67,2.67,0,0,0,48.85,26.05Zm-3.4-.94a1.73,1.73,0,0,1-.83-.37,1,1,0,0,1-.29-.78,1.2,1.2,0,0,1,1.12-1.27Zm2.12,4a2.19,2.19,0,0,1-.91.38V27a2.39,2.39,0,0,1,.92.34,1,1,0,0,1,.34.88A1.08,1.08,0,0,1,47.57,29.1Z"></path></g></svg>
                                    </div>
                                    <div class="col-10 col-md-9 font-weight-light">
                                        Answer a few questions about your car and get an instant value. This only takes 2 minutes.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4 d-lg-none">
                            <div class="col col-md-6 offset-md-3 offset-lg-0">
                                <a :href="'/autos/'+vehicle_id+'/cotizar'"  class="btn btn-block btn-lg btn-outline-primary">Pedir Cotización</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 d-none d-lg-inline-block">
                        <div class="card rounded-0 price">
                            <div class="card-header text-center">
                                <h2>{{ vehicle.sell_price |currency }}</h2>
                                <p>Precio</p>
                            </div>
                            <div class="card-body">
                                <a v-if="vehicle.status && vehicle.status.id == 1" :href="'/autos/'+vehicle_id+'/cotizar'"  class="btn btn-block btn-lg btn-primary">Pedir Cotización</a>
                                <button v-if="vehicle.status && vehicle.status.id == 2"  disabled  class="btn btn-block btn-lg btn-danger">{{vehicle.status.name}} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="inspection" class="container-fluid container-lg pt-4">

            <div class="text-center mt-2">
                <hr class="title">
                <h2 class="title-1 text-primary font-weight-bold">{{ vehicle.inspections && vehicle.inspections.length > 0 ? vehicle.inspections.length : ''  }} Puntos <br> de Inspección</h2>
                <p class="text-primary font-weight-light pt-4 h6">
                    Pasamos cada vehículo por una inspección de {{ vehicle.inspections && vehicle.inspections.length > 0 ? vehicle.inspections.length : ''  }} puntos para que pueda ser
                    Confianza 100% en la calidad y seguridad de su vehículo.
                </p>
            </div>

            <div class="details pt-4 py-lg-4 ">
                <div class="row" v-if="vehicle.inspections && vehicle.inspections.length">

                    <div class="col-12 main">
                        <div class="row pb-3">
                            <div class="col-6">
                                <p class="text-primary font-weight-light h6"><strong>Modelo</strong> {{vehicle.year}} {{vehicle.brand ? vehicle.brand.name :''}} {{vehicle.model ? vehicle.model.name :''}}</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-primary font-weight-light h6"><strong>N. de Serie </strong> <span class="text-uppercase"> {{vehicle.vin}}</span></p>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12 col-md-6 col-lg-6 pt-2" v-for="inspection in vehicle.inspections" :key="inspection.id">
                                <div class="card bg-theme-light border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 align-middle">
                                                <p class="text-primary font-weight-normal h6 ">{{ inspection.name }}</p>
                                            </div>
                                            <div class="col-7 text-right">
                                                <i class="fas fa-check-circle fa-lg text-success"></i>
                                                <span class="text-light-2 font-weight-light h6">Aprobado</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded" v-else>
                    <div class="col-12 text-center">
                        <p class="text-light-2 te">Sin detalles sobre la Inspección Vehicular</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import Vehicle from '../../../models/Vehicle';
    import Like from "../../../models/Like";

    import Carousel from '../../../components/carousel';
    import View from "../../../models/View";

    export default {

        components:{Carousel},

        props:['vehicle_id'],

        data(){
            return {
                clipboard: window.location.href,
                vehicle  : {},
                accessory_types:[],
                open:false,
            }
        },

        created(){
            this.show();

            this.storeView()
        },

        methods:{

            clipboardSuccessHandler ({ value, event }) {
                this.$toast.clear();
                this.$toast.success('URL copiada al clipboard')
            },

            show(){
                Vehicle.show(this.vehicle_id, data => {
                    this.vehicle = data.data;
                    this.accessory_types = _.groupBy(this.vehicle.accessories, 'type.name')
                });
            },

            toggleLike() {
                Like.update(this.vehicle.id, data => {
                    this.vehicle.liked = data.data.liked
                }, errors => {
                    this.errors = errors.data.errors
                    if (errors.status === 401) {
                        $('#authModal').modal('show')
                    }
                });
            },
            storeView() {
                View.store(this.vehicle_id, errors => {});
            }

        },

        computed: {
            liked() {
                return this.vehicle.liked ? 'liked' : 'favorite'
            },

            likes() {
                return this.vehicle.likes_count ? this.vehicle.likes_count : 0
            },

            views() {
                return this.vehicle.views_count ? this.vehicle.views_count : 0
            }
        }

    }
</script>

<style>


    .price .card-header{
        background: #183558;
        padding: 30px 18px;
        position: relative;
        color: white;
    }

    .price .card-header:after{
        content: '';
        display: block;
        position: absolute;
        right: 0;
        left: 0;
        margin: 0 auto;
        bottom: -9px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-top: 9px solid #183558;;
    }

    .price .card-header p{
        font-size: 14px;
        font-weight: 300;
        line-height: 1.2;
    }

    .price .card-header h2{
        font-size: 30px;
        font-weight: 300;
        line-height: 1.2;
    }

    .bg-theme-light{
        background-color:rgb(244, 248, 250);
    }

    .bg-theme-dark{
        background-color:#183558;
    }


    .details .main h4{

        color: #183558;
        /* font-size: 16px; */
        font-weight: 700;
        line-height: 1;
        margin: 0;
        padding: 0;
    }

    .details .main p{
        color: #757989;
        /* font-size: 16px; */
        font-weight: 300;
        line-height: 1;
        text-transform: capitalize;
        margin: 0;
        padding: 0;
    }

    .details .main p.dot{
        padding-left: 8px;
    }

    .details .main p.dot:before{
        content: '';
        width: 3px;
        height: 3px;
        border-radius: 50%;
        position:absolute;
        top: 6px;
        left: 0px;
        background: #00aed9;
    }

    .pay .nav-link {
        padding: 1rem;
    }
</style>
