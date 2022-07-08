<template>
    <div>
        <div class="page-title">
            <div class="page-title-caption">Regístre su Vehículo</div>
        </div>
        <div class="container">
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
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="group">
                            <input type="file" id="file" name="file" data-vv-scope="step-3" data-vv-as="fotografía del vehículo"  v-validate="'required'">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Fotografía del Vehículo</label>
                            <small class="text-danger" v-if="errors.file">{{ errors.file[0]}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6" v-if="create.sell_price > 0">
                        <div class="bg-primary text-white text-right pr-2 pt-2">
                            <h2 class="mb-0">{{ create.sell_price | currency }}</h2>
                            <small class="text-theme-secondary">valor sugerido</small>
                        </div>
                    </div>
                </div>

                <label class="mt-1 ml-3 text-theme-secondary">Color Exterior</label>
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

                <label class="mt-1 ml-3 text-theme-secondary">Color Interior</label>
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

                <button :disabled="storing" type="button" class="btn btn-primary btn-lg float-right mb-5" @click="store">
                    <i v-if="storing" class="fas fa-spinner fa-spin"></i> Finalizar
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    import Color from "../../../models/Color";
    import Brand from "../../../models/Brand";
    import Model from "../../../models/Model";
    import Version from "../../../models/Version";
    import BlueBook from "../../../models/BlueBook";
    import Vehicle from "../../../models/site/affiliates/Vehicle";

    export default {
        data() {
            return {
                years: [],
                brands: [],
                models: [],
                versions: [],
                colors: [],
                interior_colors: [],
                create: {
                    sell_price: 0
                },
                errors: {},
                storing: false,
                finished: false,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            async loadData() {
                for (let i = 2022; i > 2000; i--) {
                    this.years.push({id: i, label: i});
                }

                await Color.get({},data => {
                    this.colors = data.data;
                    this.interior_colors = _.cloneDeep(this.colors);
                });
                await Brand.pluck(data => this.brands = data);
            },

            async fetchModels(brand){
                this.create.brand   = brand;
                this.create.model   = null;
                this.models         = [];
                this.create.version = null;
                this.versions       = [];

                await Model.pluck({brand_id :brand.id}, data => this.models = data)
            },

            async fetchVersions(model = null) {
                this.create.model   = model != null ? model : null;
                this.create.version = null;
                this.versions       = [];

                if(model){
                    const params = {
                        brand_id: this.create.brand.id,
                        model_id: this.create.model.id,
                        year    : this.create.year.id
                    };

                    await Version.get(params, data =>{
                        this.versions = data.data
                    });
                }
            },

            async getPrice(item){
                this.create.version   = item;

                await BlueBook.getPrice(this.create.version.id, data => {
                    this.price = data.data;
                    this.create.sell_price = this.price.buy;
                }, error =>  this.errors = error);
            },

            async store() {
                this.storing = true;
                this.errors = {};
                Vue.$toast.info('Guardando.');

                const form = new FormData();

                const file = document.getElementById('file').files[0];

                form.append('brand_id', this.create.brand ? this.create.brand.id : '');
                form.append('model_id',  this.create.model ? this.create.model.id : '');
                form.append('version_id', this.create.version ? this.create.version.id : '');
                form.append('year', this.create.year ? this.create.year.id : '');
                form.append('odometer', this.create.odometer ? this.create.odometer : '');
                form.append('sell_price', this.create.sell_price ? this.create.sell_price : '');
                form.append('file', file);

                if(this.create.colors && this.create.colors.length > 0) {
                    this.create.colors.forEach(element => {
                        form.append("colors[]", element);
                    });
                }

                if(this.create.interior_colors && this.create.interior_colors.length > 0) {
                    this.create.interior_colors.forEach(element => {
                        form.append("interior_colors[]", element);
                    });
                }

                await Vehicle.store(form, data => {
                    this.storing = false;
                    this.create = {};
                    Vue.$toast.clear();
                    Vue.$toast.success('El Vehículo ha sido agregado correctamente.')
                }, errors => {
                    this.storing = false;
                    this.errors = errors
                });
            },

            setColor(index){
                this.colors[index].active = !this.colors[index].active;
                this.create.colors = _.xor([this.colors[index].id], this.create.colors)
            },

            setInteriorColor(index){
                this.interior_colors[index].active = !this.interior_colors[index].active;
                this.create.interior_colors = _.xor([this.interior_colors[index].id], this.create.interior_colors)
            },
        }
    }
</script>
