<template>
    <div>

        <div class="row pb-3 no-gutters">
            <div class="col-md-3 col-12 d-md-inline-block pt-5">
                <div class="border-bottom  border-light pl-5 pr-5 pt-3 pb-3" :class="{'bg-white':step != 1}">
                    <div class="d-inline-block">
                        <i class="far fa-circle" :class="{'text-muted':step != 1, 'text-theme-secondary':step == 1}"></i>
                    </div>
                    <div class="d-inline-block">
                        <p class="font-weight-bold h6 mb-0" :class="{'text-muted':step != 1, 'text-primary':step == 1 }">Datos de contacto</p>
                    </div>
                    <div>
                        <small v-if="step1Fail" class="text-danger">Corregir errores</small>
                    </div>
                </div>
                <div class="border-bottom  border-light pl-5 pr-5 pt-3 pb-3" :class="{'bg-white':step != 2}">
                    <div class="d-inline-block">
                        <i class="far fa-circle" :class="{'text-muted':step != 2, 'text-theme-secondary':step == 2}"></i>
                    </div>
                    <div class="d-inline-block">
                        <p class="font-weight-bold h6 mb-0" :class="{'text-muted':step != 2, 'text-primary':step == 2 }">Datos de vehículo</p>
                    </div>
                    <div>
                        <small v-if="step2Fail" class="text-danger">Corregir errores</small>
                    </div>
                </div>
                <div class=" border-light pl-5 pr-5 pt-3 pb-3" :class="{'bg-white border-bottom':step != 3}">
                    <div class="d-inline-block">
                        <i class="far fa-circle" :class="{'text-muted':step != 3, 'text-theme-secondary':step == 3}"></i>
                    </div>
                    <div class="d-inline-block">
                        <p class="font-weight-bold h6 mb-0" :class="{'text-muted':step != 3, 'text-primary':step == 3 }">Detalles del vehículo</p>
                    </div>
                    <div>
                        <small v-if="step3Fail" class="text-danger">Corregir errores</small>
                    </div>
                </div>
            </div>
            <div class="col-md-7 offset-md-1">
                <div class="pl-4 pl-md-0 pr-md-0 pr-4">

                    <template v-if="stored">
                        <div  class="alert alert-success mt-5 mb-4" role="alert">
                            <h4 class="alert-heading">Gracias por registrar tu vehículo con nosotros</h4>
                            <p>
                                En breve uno de nuestros asesores se pondrá en contacto contigo.
                            </p>
                        </div>
                        <a href="/autos" class="btn btn-primary btn-lg btn-block">Ir a Inicio</a>
                    </template>


                    <template v-if="!stored">

                        <div v-if="step == 1 ">
                            <div class="text-center pt-5">
                                <h2 class=" text-primary font-weight-bold text-uppercase">Información Personal</h2>
                                <p class="text-theme-light">Por favor completa los siguientes datos</p>
                            </div>
                            <div class="pt-3">
                                <form class="theme-form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <input type="text"  v-model="create.name" id="name" name="name" data-vv-scope="step-1" data-vv-as="nombre"  v-validate="'required'">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Nombre</label>
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-1.name')">{{ vErrors.first('step-1.name')}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <input type="text" v-model="create.last_name" id="last_name" name="last_name" data-vv-scope="step-1" data-vv-as="apellido"  v-validate="'required'">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Apellido</label>
                                                <small v-if="errors.last_name" class=" text-danger">{{ errors.last_name[0] }}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-1.last_name')">{{ vErrors.first('step-1.last_name')}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <input type="email" v-model="create.email" id="email" name="email" data-vv-scope="step-1" data-vv-as="email"  v-validate="'required|email'">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Email</label>
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-1.email')">{{ vErrors.first('step-1.email')}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                                <vue-tel-input v-model="create.phone" mode="international"  id="phone" name="phone" data-vv-scope="step-1" data-vv-as="teléfono" placeholder="Teléfono" v-validate="'required'"></vue-tel-input>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-1.phone')">{{ vErrors.first('step-1.phone')}}</small>
                                            </div>
                                        </div>
                                        <div v-if="!user.id" class="col-12 mb-3">
                                            <checkbox  v-model="create.register" >
                                                <i class="text-theme-secondary">
                                                    Utilizar estos datos para registrarme.
                                                </i>
                                            </checkbox>
                                        </div>
                                        <template v-if="create.register">
                                            <div class="col-12 col-md-6">
                                                <div class="group">
                                                    <input type="password" v-model="create.password" id="password" name="password" data-vv-scope="step-1" data-vv-as="contraseña"  v-validate="'required'">
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Contraseña</label>
                                                    <small class="text-danger" v-if="errors.password">{{ errors.password[0]}}</small>
                                                    <small class="text-danger" v-if="vErrors.has('step-1.password')">{{ vErrors.first('step-1.password')}}</small>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="group">
                                                    <input type="password" v-model="create.password_confirmation" id="password_confirmation" name="password_confirmation" data-vv-scope="step-1" data-vv-as="confirmar contraseña"  v-validate="'required'">
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Confirmar Contraseña</label>
                                                    <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0]}}</small>
                                                    <small class="text-danger" v-if="vErrors.has('step-1.password_confirmation')">{{ vErrors.first('step-1.password_confirmation')}}</small>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div v-if="step == 2">
                            <div class="text-center pt-5">
                                <h2 class=" text-primary font-weight-bold text-uppercase">Datos del Vehículo</h2>
                                <p class="text-theme-light">Por favor completa la siguiente información</p>
                                <p class="text-theme-light small">*Si su vehículo no aparece en el formulario, póngase en contacto con nosotros para obtener una cotización personalizada</p>
                            </div>
                            <div class="pt-3">
                                <form class="theme-form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">

                                             <div class="">
                                                <v-select
                                                        label="label"
                                                        :options="years"
                                                        v-model="create.year"
                                                        placeholder="Año"
                                                        @input="fetchVersions()"
                                                        id="year" name="year" data-vv-scope="step-2" data-vv-as="año"  v-validate="'required'"
                                                >
                                                </v-select>
                                                <small class="text-danger" v-if="errors.year">{{ errors.year[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-2.year')">{{ vErrors.first('step-2.year')}}</small>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="">
                                                <v-select
                                                    label="label"
                                                    :options="brands"
                                                    v-model="create.brand"
                                                    placeholder="Marca"
                                                    @input="fetchModels($event)"
                                                    id="brand" name="brand" data-vv-scope="step-2" data-vv-as="marca"  v-validate="'required'"
                                                >
                                                </v-select>
                                                <small class="text-danger" v-if="errors.brand_id">{{ errors.brand_id[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-2.brand')">{{ vErrors.first('step-2.brand')}}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="">
                                                <v-select
                                                        label="label"
                                                        :options="models"
                                                        v-model="create.model"
                                                        placeholder="Modelo"
                                                        @input="fetchVersions($event)"
                                                        id="model" name="model" data-vv-scope="step-2" data-vv-as="modelo"  v-validate="'required'"
                                                >
                                                </v-select>
                                                <small class="text-danger" v-if="errors.model_id">{{ errors.model_id[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-2.model')">{{ vErrors.first('step-2.model')}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="">
                                                <v-select
                                                        label="name"
                                                        :options="versions"
                                                        v-model="create.version"
                                                        placeholder="Versión"
                                                        @input="getPrice($event)"
                                                        id="version" name="version" data-vv-scope="step-2" data-vv-as="versión"  v-validate="'required'"
                                                >
                                                </v-select>
                                                <small class="text-danger" v-if="errors.version_id">{{ errors.version_id[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-2.version')">{{ vErrors.first('step-2.version')}}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="group">
                                            <input type="text" v-model="create.odometer" id="odometer" name="odometer" data-vv-scope="step-2" data-vv-as="kilometraje"  v-validate="'required'">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Kilometraje</label>
                                                <small class="text-danger" v-if="errors.odometer">{{ errors.odometer[0]}}</small>
                                                <small class="text-danger" v-if="vErrors.has('step-2.odometer')">{{ vErrors.first('step-2.odometer')}}</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6" v-if="create.sell_price > 0">
                                            <div class="bg-primary text-white text-right pr-2 pt-2">
                                                <h2 class="mb-0">{{ create.sell_price | currency }}</h2>
                                                <small class="text-theme-secondary">valor sugerido</small>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div v-if="step == 3">
                            <div class="text-center pt-5">
                                <h2 class=" text-primary font-weight-bold text-uppercase">Detalles del vehículo</h2>
                            </div>
                            <div class="pt-5">
                                <div class="col-12 col-md-6">
                                    <form class="theme-form">
                                        <div class="group">
                                            <input type="file" id="file" name="file" data-vv-scope="step-3" data-vv-as="fotografía del vehículo"  v-validate="'required'">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Fotografía del Vehículo</label>
                                            <small class="text-danger" v-if="errors.file">{{ errors.file[0]}}</small>
                                            <small class="text-danger" v-if="vErrors.has('step-2.file')">{{ vErrors.first('step-2.file')}}</small>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <label for="" class="mt-1 ml-3 text-theme-secondary">Color Exterior</label>
                                <div class="row">
                                    <div class="col-2" v-for="(color, index) in colors" :key="'color'+index">
                                        <a href="#" class="color-check" :class="{'active':color.active}" @click.prevent="setColor(index, false)">
                                            <span class="color-circle" :class="'circle-'+color.hex" ></span>
                                            <p class="mt-2">
                                                {{color.name}} <span v-if="color.active" class="text-theme fa fa-check"></span>
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-danger" v-if="errors.colors">{{ errors.colors[0]}}</small>
                                    </div>
                                </div>
                                <hr>
                                <label for="" class="mt-1 ml-3 text-theme-secondary">Color Interior</label>
                                <div class="row">
                                    <div class="col-2" v-for="(color, index) in interior_colors" :key="'interior_color'+index">
                                        <a href="#" class="color-check" :class="{'active':color.active}" @click.prevent="setInteriorColor(index, false)">
                                            <span class="color-circle" :class="'circle-'+color.hex" ></span>
                                            <p class="mt-2">
                                                {{color.name}} <span v-if="color.active" class="text-theme fa fa-check"></span>
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-danger" v-if="errors.interior_colors">{{ errors.interior_colors[0]}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <hr>
                            <button  v-if="step > 1" :disabled="storing" type="button" class="btn btn-primary float-left" @click="back">Regresar</button>
                            <button  v-if="step < 3" type="button" class="btn btn-primary float-right" @click="next">Siguiente</button>
                            <button  v-if="step == 3" :disabled="storing" type="button" class="btn btn-primary float-right" @click="store"><i v-if="storing" class="fas fa-spinner fa-spin"></i> Finalizar</button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import VehicleSellRequest from '../../../models/VehicleSellRequest';
    import Brand from '../../../models/Brand';
    import Color from '../../../models/Color';
    import Model from '../../../models/Model';
    import Version from "../../../models/Version";
    import BlueBook from "../../../models/BlueBook";
    import VeeValidate from 'vee-validate';

    const VueValidationEs = require('vee-validate/dist/locale/es');

    Vue.use(VeeValidate, {
        //validity: true,
        errorBagName: 'vErrors',
        locale: 'es',
        dictionary: {
            es: VueValidationEs
        }
    });

    export default {

        components:{VeeValidate},

        props:['user'],

        data(){
            return {
                step               : 1,
                storing            : false,
                stored             : false,
                price              : {},
                errors             : {},
                brands             : [],
                years              : [],
                models             : [],
                versions           : [],
                colors             : [],
                interior_colors    : [],
                create             : {
                    colors         : [],
                    interior_colors: [],
                    sell_price: '',
                },
            }
        },

        created(){

            this.create.name      = this.user.name;
            this.create.last_name = this.user.last_name;
            this.create.email     = this.user.email;
            this.create.phone     = this.user.phone;

            this.loadData();
        },

        computed:{
            step1Fail(){

                if(this.errors.name || this.errors.last_name || this.errors.email || this.errors.phone){
                    return true;
                }

                return false;
            },

            step2Fail(){

                if(this.errors.brand_id || this.errors.model_id || this.errors.version_id || this.errors.sell_price || this.errors.year || this.errors.odometer){
                    return true;
                }

                return false;
            },

            step3Fail(){

                if(this.errors.file || this.errors.colors || this.errors.interior_colors){
                    return true;
                }

                return false;
            }
        },

        methods:{

            loadData(){

                let years = [];

                for (let i = 2000; i < 2022; i++) {
                    years.push({
                        id:i,
                        label:i,
                    });
                }

                this.years = _.orderBy(years, ['label'], ['desc']); years;

                Color.get({}, data => {
                    this.colors          = data.data;
                    this.interior_colors = _.cloneDeep(this.colors);
                })

                Brand.pluck(data => this.brands = data)
            },

            fetchModels(brand){
                this.create.brand   = brand;
                this.create.model   = null;
                this.models         = [];
                this.create.version = null;
                this.versions       = [];

                Model.pluck({brand_id :brand.id}, data => this.models = data)

            },

            fetchVersions(model = null) {

                this.create.model   = model != null ? model : null;
                this.create.version = null;
                this.versions       = [];

                if(model){
                    let params = {
                        brand_id: this.create.brand.id,
                        model_id: this.create.model.id,
                        year    : this.create.year.id
                    };

                    Version.get(params, data =>{
                        this.versions = data.data
                    });
                }

            },

            getPrice(item){

                this.create.version   = item;

                BlueBook.getPrice(this.create.version.id, data => {
                    this.price = data.data;
                    this.create.sell_price = this.price.buy;
                },error =>  this.errors = error);

            },

            next(){
                if (this.step == 3) {
                    this.$validator.validateAll('step-3').then((result) => {
                        if (result) {
                            this.store();
                        }
                    });
                }
                if (this.step == 2) {
                    this.$validator.validateAll('step-2').then((result) => {
                        if (result) {
                            this.step++;
                        }
                    });
                }
                if (this.step == 1) {
                    this.$validator.validateAll('step-1').then((result) => {
                        if (result) {
                            this.step++;
                        }
                    });
                }
            },

            back(){
                this.step--;
            },

            setColor(index){
                this.colors[index].active = !this.colors[index].active;
                this.create.colors = _.xor([this.colors[index].id], this.create.colors)
            },

            setInteriorColor(index){
                this.interior_colors[index].active = !this.interior_colors[index].active;
                this.create.interior_colors = _.xor([this.interior_colors[index].id], this.create.interior_colors)
            },

            store(){
                this.gtag_report_conversion();

                this.storing = true;

                let formData = new FormData();
                let file = document.getElementById('file').files[0];

                formData.append('file', file ? file : '');
                formData.append('name', this.create.name ? this.create.name :'' );
                formData.append('last_name', this.create.last_name ? this.create.last_name : '');
                formData.append('email', this.create.email ? this.create.email : '');
                formData.append('phone', this.create.phone ? this.create.phone: '');
                formData.append('year', this.create.year ? this.create.year.id : '');
                formData.append('colors', this.create.colors);
                formData.append('interior_colors', this.create.interior_colors);
                formData.append('odometer', this.create.odometer ? this.create.odometer : '');
                formData.append('sell_price', this.create.sell_price);
                formData.append('brand_id', this.create.brand ? this.create.brand.id :'');
                formData.append('model_id', this.create.model ? this.create.model.id :'');
                formData.append('version_id', this.create.version ? this.create.version.id :'');

                if(this.create.register){
                    formData.append('register', this.create.register);
                    formData.append('password', this.create.password ? this.create.password :'');
                    formData.append('password_confirmation', this.create.password_confirmation ? this.create.password_confirmation: '');
                }

                VehicleSellRequest.store(formData, data => {
                    this.create = {
                        colors         : [],
                        interior_colors: [],
                        sell_price: '',
                    }
                    this.stored = true;
                    Vue.$toast.clear();
                    Vue.$toast.success('Información ingresada con exito.');
                    this.errors = {};
                    this.storing = false;

                }, error => {
                    this.storing = false;
                    this.errors = error;
                    Vue.$toast.clear();
                    Vue.$toast.error('Por favor completa la información solicitada.')
                });
            },

            gtag_report_conversion(url) {
                const callback = function () {
                    if (typeof(url) != 'undefined') {
                        window.location = url;
                    }
                };

                gtag('event', 'conversion', {
                    'send_to': 'AW-400918395/m-xpCLWgpKoDEPuOlr8B',
                    'event_callback': callback
                });

                return false;
            },
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
</style>
