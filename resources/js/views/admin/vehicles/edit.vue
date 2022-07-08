<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="float-left mt-2">
                                Editar Vehículo
                            </h3>
                            <a href="/admin/vehicles" class="btn btn-link float-right" >Regresar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="stepwizard">
                                <div class="stepwizard-row">
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 1, 'btn-secondary':step != 1 }" @click="step=1">1</button>
                                        <p>Datos</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 2, 'btn-secondary':step != 2 }" @click="step=2">2</button>
                                        <p>Detalles</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 3, 'btn-secondary':step != 3 }" @click="step=3">3</button>
                                        <p>Accessorios</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 4, 'btn-secondary':step != 4 }" @click="step=4">4</button>
                                        <p>Inspecciones</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 5, 'btn-secondary':step != 5 }" @click="step=5">5</button>
                                        <p>Fotografías</p>
                                    </div>
                                </div>
                            </div>
                            <form class="mt-4">
                                <template v-if="step == 1">
                                    <div v-if="vehicle.id" class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Año</label>
                                                    <v-select
                                                        label="label"
                                                        :options="years"
                                                        v-model="vehicle.year_value"
                                                        placeholder="Elija un año"
                                                        @input="fetchVersions()"
                                                    ></v-select>
                                                </div>
                                                <small v-if="errors.year" class=" text-danger">{{ errors.year[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Marca</label>
                                                    <v-select
                                                        label="label"
                                                        :options="brands"
                                                        v-model="vehicle.brand_value"
                                                        placeholder="Elija una Marca"
                                                        @input="fetchModels($event)"
                                                    ></v-select>
                                                </div>
                                                <small v-if="errors.brand_id" class=" text-danger">{{ errors.brand_id[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Modelo</label>
                                                <v-select
                                                    :disabled="!vehicle.brand_value"
                                                    label="label"
                                                    v-model="vehicle.model_value"
                                                    :options="models"
                                                    placeholder="Elija un Modelo"
                                                    @input="fetchVersions($event)"
                                                ></v-select>
                                                <small v-if="errors.model_id" class=" text-danger">{{ errors.model_id[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Versión</label>
                                                <v-select
                                                    :disabled="!vehicle.model_value"
                                                    label="label"
                                                    v-model="vehicle.version_value"
                                                    :options="versions"
                                                ></v-select>
                                               <small v-if="errors.version_id" class=" text-danger">{{ errors.version_id[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tipo de carroceria</label>
                                                <v-select
                                                    label="label"
                                                    v-model="vehicle.body_type_value"
                                                    :options="body_types"
                                                    placeholder="Elija una tipo"
                                                ></v-select>
                                               <small v-if="errors.body_type_id" class=" text-danger">{{ errors.body_type_id[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de Serie</label>
                                                <input type="text" class="form-control" v-model="vehicle.vin" placeholder="">
                                                <small v-if="errors.vin" class=" text-danger">{{ errors.vin[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kilometraje</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">km</span>
                                                    </div>
                                                    <input type="number" min="0" class="form-control" v-model="vehicle.odometer" placeholder="">
                                                </div>
                                                <small v-if="errors.odometer" class=" text-danger">{{ errors.odometer[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kilometros por litro</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">km / L</span>
                                                    </div>
                                                    <input type="number" min="0" class="form-control" v-model="vehicle.fuel_consumption" placeholder="">
                                                </div>
                                                <small v-if="errors.fuel_consumption" class=" text-danger">{{ errors.fuel_consumption[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de puertas</label>
                                                <input type="number" min="1" class="form-control" v-model="vehicle.doors" placeholder="">
                                                <small v-if="errors.doors" class=" text-danger">{{ errors.doors[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de llaves</label>
                                                <input type="number" min="0" class="form-control" v-model="vehicle.keys" placeholder="">
                                                <small v-if="errors.keys" class=" text-danger">{{ errors.keys[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Precio Compra</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" v-model="vehicle.buy_price" placeholder="">
                                                </div>
                                                <small v-if="errors.buy_price" class=" text-danger">{{ errors.buy_price[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Precio Venta</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" v-model="vehicle.sell_price" placeholder="">
                                                </div>
                                                <small v-if="errors.sell_price" class=" text-danger">{{ errors.sell_price[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción</label>
                                                <textarea class="form-control" v-model="vehicle.description"></textarea>
                                                <small v-if="errors.description" class=" text-danger">
                                                    {{ errors.description[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-if="step == 2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Transmisión</label>
                                                        <checkbox v-for=" transmission in transmissions" :key="'transmission_'+transmission.id" :value="transmission.id" v-model="edit.transmissions_value">
                                                            {{transmission.name}}
                                                        </checkbox>
                                                        <small v-if="errors.transmissions" class=" text-danger">{{ errors.transmissions[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Cilindraje</label>
                                                        <checkbox v-for="cylinder in cylinders" :key="'cylinder_'+cylinder.id" :value="cylinder.id" v-model="edit.cylinders_value">
                                                            {{cylinder.name}}
                                                        </checkbox>
                                                        <small v-if="errors.cylinders" class=" text-danger">{{ errors.cylinders[0] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Combustible</label>
                                                        <checkbox v-for=" fuel in fuels" :key="'fuel_'+fuel.id" :value="fuel.id" v-model="edit.fuels_value">
                                                            {{fuel.name}}
                                                        </checkbox>
                                                        <small v-if="errors.fuels" class=" text-danger">{{ errors.fuels[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Tracción</label>
                                                        <checkbox v-for="drive in drives" :key="'drive_'+drive.id" :value="drive.id" v-model="edit.drives_value">
                                                            {{drive.name}}
                                                        </checkbox>
                                                        <small v-if="errors.drives" class=" text-danger">{{ errors.drives[0] }}</small>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div  class="form-group">
                                                <label>Color Exterior</label>
                                                <template v-for=" color in colors">
                                                    <checkbox  :key="'color_'+color.id" :value="color.id" v-model="edit.colors_value">
                                                        {{color.name}}
                                                    </checkbox>
                                                </template>
                                                <small v-if="errors.colors" class=" text-danger">{{ errors.colors[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Color del Interior</label>
                                                <checkbox v-for="color in colors" :key="'interior_color_'+color.id" :value="color.id" v-model="edit.interior_colors_value">
                                                    {{color.name}}
                                                </checkbox>
                                                <small v-if="errors.interior_colors" class=" text-danger">{{ errors.interior_colors[0] }}</small>
                                            </div>
                                        </div>
                                    </div>

                                </template>
                                <template v-if="step == 3">
                                    <div class="row">
                                        <div class="col-md-4" v-for="(type,index) in accessories" :key="'type_'+index">
                                            <div class="form-group">
                                                <label>{{index}}</label>
                                                <checkbox v-for=" accessory in type" :key="'accessory_'+accessory.id" :value="accessory.id" v-model="edit.accessories_value">
                                                    {{accessory.name}}
                                                </checkbox>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-if="step == 4">
                                    <div class="row">
                                        <div class="col-md-6" v-for=" inspection in inspections" :key="'inspection_'+inspection.id">
                                            <div class="form-group">
                                                <checkbox  :value="inspection.id" v-model="edit.inspections_value">
                                                    {{inspection.name}}
                                                </checkbox>
                                            </div>
                                        </div>
                                        <small v-if="errors.inspections" class=" text-danger">{{ errors.inspections[0] }}</small>
                                    </div>
                                </template>
                                <template v-if="step == 5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        Fotografía Principal
                                                        <a
                                                            v-if="vehicle.principal_images.length == 0"
                                                            v-tooltip="'Agregar'"
                                                            data-toggle="modal"
                                                            data-target="#addImage"
                                                            class="btn btn-primary btn-sm float-right"
                                                            @click="create.type_id = 4"
                                                        >
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </h5>

                                                    <draggable v-model="vehicle.principal_images" :disabled="true" @start="drag = true" @end="drag = false" @input="reorderImages('principal_images')">
                                                        <transition-group tag="div" class="row" name="">
                                                            <div class="col-2 mb-3" v-for="image in vehicle.principal_images" :key="image.id">
                                                                <div class="position-relative">
                                                                    <img :src="image.show_url" class="img-fluid img-thumbnail" >
                                                                    <a
                                                                        v-tooltip="'Eliminar'"
                                                                        href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteImage"
                                                                        class="btn btn-outline-dark btn-sm rounded-circle position-absolute"
                                                                        style="top: -9px;right: -13px;"
                                                                        @click="edit = image"
                                                                    >
                                                                        <span class="fa fa-times"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </transition-group>
                                                    </draggable>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        Fotografías 360
                                                        <a
                                                            v-tooltip="'Agregar'"
                                                            data-toggle="modal"
                                                            data-target="#addImage"
                                                            class="btn btn-primary btn-sm float-right"
                                                            @click="create.type_id = 1"
                                                        >
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </h5>

                                                    <draggable v-model="vehicle.three_sixty_images" :disabled="true" @start="drag = true" @end="drag = false" @input="reorderImages('three_sixty_images')">
                                                        <transition-group tag="div" class="row mt-2" name="">
                                                            <div class="col-2 mb-3" v-for="image in vehicle.three_sixty_images" :key="image.id">
                                                                <div class="position-relative">
                                                                    <img :src="image.show_url" class="img-fluid img-thumbnail" >
                                                                    <a
                                                                        v-tooltip="'Eliminar'"
                                                                        href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteImage"
                                                                        class="btn btn-outline-dark btn-sm rounded-circle position-absolute"
                                                                        style="top: -9px;right: -13px;"
                                                                        @click="edit = image"
                                                                    >
                                                                        <span class="fa fa-times"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </transition-group>
                                                    </draggable>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        Fotografías Exterior
                                                        <a
                                                            v-tooltip="'Agregar'"
                                                            data-toggle="modal"
                                                            data-target="#addImage"
                                                            class="btn btn-primary btn-sm float-right"
                                                            @click="create.type_id = 2, multiple=true"
                                                        >
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </h5>

                                                    <draggable v-model="vehicle.exterior_images"  @start="drag = true" @end="drag = false" @input="reorderImages('exterior_images')">
                                                        <transition-group tag="div" class="row" name="">
                                                            <div class="col-2 mb-3" v-for="image in vehicle.exterior_images" :key="image.id">
                                                                <div class="position-relative">
                                                                    <img :src="image.show_url" class="img-fluid img-thumbnail" >
                                                                    <a
                                                                        v-tooltip="'Eliminar'"
                                                                        href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteImage"
                                                                        class="btn btn-outline-dark btn-sm rounded-circle position-absolute"
                                                                        style="top: -9px;right: -13px;"
                                                                        @click="edit = image"
                                                                    >
                                                                        <span class="fa fa-times"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </transition-group>
                                                    </draggable>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        Fotografías Interior
                                                        <a
                                                            v-tooltip="'Agregar'"
                                                            data-toggle="modal"
                                                            data-target="#addImage"
                                                            class="btn btn-primary btn-sm float-right"
                                                            @click="create.type_id = 3, multiple=true"
                                                        >
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </h5>

                                                    <draggable v-model="vehicle.interior_images"  @start="drag = true" @end="drag = false" @input="reorderImages('interior_images')">
                                                        <transition-group tag="div" class="row" name="">
                                                            <div class="col-2 mb-3" v-for="image in vehicle.interior_images" :key="image.id">
                                                                <div class="position-relative">
                                                                    <img :src="image.show_url" class="img-fluid img-thumbnail" >
                                                                    <a
                                                                        v-tooltip="'Eliminar'"
                                                                        href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteImage"
                                                                        class="btn btn-outline-dark btn-sm rounded-circle position-absolute"
                                                                        style="top: -9px;right: -13px;"
                                                                        @click="edit = image"
                                                                    >
                                                                        <span class="fa fa-times"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </transition-group>
                                                    </draggable>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button  v-if="step > 1" type="button" class="btn btn-primary float-left" @click="back">Regresar</button>
                                        <button  v-if="step < 5" type="button" class="btn btn-primary float-right" @click="next">Siguiente</button>
                                        <button v-if="step == 5" type="button" class="btn btn-primary float-right" @click="next">Finalizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal id="addImage" title="Agregar Fotografía" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Fotografía</label>
                            <input type="file" :multiple="multiple" class="form-control-file" id="file" placeholder="fotografía">
                            <small v-if="errors.file" class=" text-danger">{{ errors.file[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>descripción</label>
                            <input type="text" class="form-control" v-model="create.description" placeholder="Nombre">
                            <template v-for="item  in errors">
                                <small v-for="error in item" class=" text-danger">
                                    {{ error }}
                                </small>
                            </template>
                        </div>
                    </div>
                </div>
            </form>
            <button :disabled="storing" slot="btnSave" type="button" class="btn btn-primary" @click="storeImage"><i v-if="storing" class="fas fa-spinner fa-spin"></i> {{storing ? 'Guardando...' : 'Guardar' }}</button>
        </modal>

        <modal id="deleteImage" title="¿Estas seguro de eliminar esta fotografía?" close="No" size="modal-lg">
            <button slot="btnSave" type="button" class="btn btn-danger" @click="destroyImage">Si</button>
        </modal>
    </div>
</template>

<script>
    import draggable from "vuedraggable";
    import Paginator from "../../../components/Paginator";
    import Model from "../../../models/admin/Model";
    import Brand from "../../../models/admin/Brand";
    import Version from "../../../models/admin/Version";
    import Vehicle from "../../../models/admin/Vehicle";
    import VehicleImage from "../../../models/admin/VehicleImage";
    import Transmission from "../../../models/admin/Transmission";
    import FileType from "../../../models/admin/FileType";
    import Cylinder from "../../../models/admin/Cylinder";
    import Accessory from "../../../models/admin/Accessory";
    import BodyType from "../../../models/admin/BodyType";
    import Fuel from "../../../models/admin/Fuel";
    import Color from "../../../models/admin/Color";
    import Drive from "../../../models/admin/Drive";
    import Inspection from "../../../models/admin/Inspection";

    export default {
        components: {Paginator, draggable},

        props:['vehicle_id'],

        data() {
            return {
                multiple     : false,
                drag         : false,
                storing      : false,
                step         : 1,
                create       : {},
                vehicle      : {},
                edit         : {
                    transmissions_value  : [],
                    cylinders_value      : [],
                    accessories_value    : [],
                    fuels_value          : [],
                    drives_value         : [],
                    colors_value         : [],
                    interior_colors_value: [],
                    inspections_value    : []
                },
                file_types   : [],
                body_types   : [],
                brands       : [],
                models       : [],
                drives       : [],
                versions     : [],
                transmissions: [],
                cylinders    : [],
                accessories  : [],
                fuels        : [],
                colors       : [],
                inspections  : [],
                filters:{
                    brand_id:   null,
                    model_id:   null,
                },
                errors:{},
                years:[],
            }
        },

        created() {
            this.loadData()
            this.show();

        },

        methods: {
            async loadData(){
                await BodyType.pluck(data => this.body_types = data)
                await FileType.pluck(data => this.file_types = data)
                await Brand.pluck({},data => this.brands = data)
                await Transmission.pluck(data => this.transmissions = data)
                await Cylinder.pluck(data => this.cylinders = data)
                await Fuel.pluck(data => this.fuels = data)
                await Color.pluck(data => this.colors = data)
                await Drive.pluck(data => this.drives = data)

                await Accessory.pluck(data => {
                    this.accessories = _.groupBy(data, 'type' );
                })

                await Inspection.pluck(data => this.inspections = data);

                let years = [];

                for (let i = 2000; i <= (new Date().getFullYear()+1); i++) {
                    years.push({
                        id:i,
                        label:i,
                    });
                }

                this.years = _.orderBy(years, ['label'], ['desc']); years;


            },

            async fetchModels(brand){
                this.vehicle.brand_value = brand;
                this.vehicle.model_value = null;

                await Model.pluck({brand_id :brand.id}, data => this.models = data)

            },

            fetchVersions(model = null) {

                this.vehicle.model_value   = model != null ? model: this.vehicle.model_value;
                this.vehicle.version_value = null;

                if(this.vehicle.model_value){
                    let params = {
                        brand_id: this.vehicle.brand_value.id,
                        model_id: this.vehicle.model_value.id,
                        year    : this.vehicle.year_value.id
                    };
                    Version.pluck(params, data => this.versions = data)
                }

            },

            next(){

                if(this.step == 5){
                    location.href = '/admin/vehicles';
                }

                if(this.step == 4){
                    this.storeInspections();
                }

                if(this.step == 3){
                    this.storeAccessories();
                }

                if(this.step == 2){
                    this.storeDetails();
                }

                if(this.step == 1){
                    this.update();
                }
            },

            back(){
                this.step--;
            },

            async show(){
                await Vehicle.show(this.vehicle_id, data => {

                    let vehicle = data.data;

                    if(vehicle.year){
                        vehicle.year_value ={
                            id:vehicle.year,
                            label:vehicle.year,
                        }
                    }

                    if(vehicle.brand){
                        vehicle.brand_value ={
                            id:vehicle.brand.id,
                            label:vehicle.brand.name,
                        }
                    }

                    if(vehicle.model){
                        vehicle.model_value ={
                            id:vehicle.model.id,
                            label:vehicle.model.name,
                        }
                    }
                    if(vehicle.version){
                        vehicle.version_value ={
                            id:vehicle.version.id,
                            label:vehicle.version.name,
                        }
                    }

                    if(vehicle.body_type){
                        vehicle.body_type_value ={
                            id:vehicle.body_type.id,
                            label:vehicle.body_type.name,
                        }
                    }

                    vehicle.cylinders.forEach(element => {
                        this.edit.cylinders_value.push(element.id)
                    });


                    vehicle.drives.forEach(element => {
                        this.edit.drives_value.push(element.id)
                    });

                    vehicle.transmissions.forEach(element => {
                        this.edit.transmissions_value.push(element.id)
                    });

                    vehicle.accessories.forEach(element => {
                        this.edit.accessories_value.push(element.id)
                    });

                    vehicle.colors.forEach(element => {
                        this.edit.colors_value.push(element.id)
                    });

                    vehicle.interior_colors.forEach(element => {
                        this.edit.interior_colors_value.push(element.id)
                    });

                    vehicle.fuels.forEach(element => {
                        this.edit.fuels_value.push(element.id)
                    });

                    vehicle.inspections.forEach(element => {
                        this.edit.inspections_value.push(element.id)
                    });

                    this.vehicle = vehicle;

                });
            },

            async update() {

                this.vehicle.brand_id     = this.vehicle.brand_value ? this.vehicle.brand_value.id:'';
                this.vehicle.model_id     = this.vehicle.model_value ? this.vehicle.model_value.id:'';
                this.vehicle.version_id   = this.vehicle.version_value ? this.vehicle.version_value.id:'';
                this.vehicle.body_type_id = this.vehicle.body_type_value ? this.vehicle.body_type_value.id:'';
                this.vehicle.year         = this.vehicle.year_value ? this.vehicle.year_value.id:'';

                await Vehicle.update(this.vehicle.id, this.vehicle, data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Datos del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            async storeDetails() {

                let parameters = {
                    fuels          : this.edit.fuels_value,
                    cylinders      : this.edit.cylinders_value,
                    colors         : this.edit.colors_value,
                    transmissions  : this.edit.transmissions_value,
                    interior_colors: this.edit.interior_colors_value,
                    drives         : this.edit.drives_value,
                }

                await Vehicle.details(this.vehicle_id, parameters, data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Detalles del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            async storeAccessories() {

                let parameters = {
                    accessories: this.edit.accessories_value,
                }

                await Vehicle.accessories(this.vehicle_id, parameters , data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Accesorios del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            async storeImage() {
                this.storing = true;
                let fileId   = 'file';
                let formData = new FormData();


                //let file = document.getElementById(fileId).files[0];

                for( var i = 0; i < document.getElementById(fileId).files.length; i++ ){
                    let file = document.getElementById(fileId).files[i];
                    formData.append('files[' + i + ']', file);
                }

                //formData.append('file', file ? file : '');
                formData.append('type_id', this.create.type_id);
                formData.append('description', this.create.description ? this.create.description: '' );

                await VehicleImage.store(this.vehicle.id, formData, data => {
                    this.vehicle = data.data;
                    Vue.$toast.clear();
                    file.value = '';
                    this.create = {}
                    Vue.$toast.success('Fotografía cargada.')
                    $('#addImage').modal('hide');
                    this.storing = false;
                    this.multiple = false;

                }, errors => {
                    this.errors = errors;
                    this.storing = false;
                });
            },

            async storeInspections() {
                let parameters = {
                    inspections    : this.edit.inspections_value,
                }

                await Vehicle.inspections(this.vehicle_id, parameters , data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Inspecciones del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            destroyImage() {

                VehicleImage.destroy(this.vehicle.id, this.edit.id, data => {
                    this.vehicle = data.data;
                    Vue.$toast.clear();
                    this.edit = {};
                    Vue.$toast.success('Fotografía Eliminada.')
                    $('#deleteImage').modal('hide');
                });
            },

            reorderImages(collection_name){

                let order = {};

                this.vehicle[collection_name].forEach((image, index) =>{
                    image.order = index+1;

                    order[image.id] = index+1;
                });

                let parameters ={
                    order : order
                };

                VehicleImage.order(this.vehicle.id, parameters, data => {});


            }


        },

    }
</script>

<style >
.item {
    position:relative;
    padding-top:20px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    right:-20px;
    top:10px;
    border: 1px solid black;
    background:white;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    color:white;
    padding:5px 5px;
    font-size:16px;
}

.grid {
  display: grid;
  grid-template-columns: repeat(3, 100px);
  grid-template-rows: repeat(3, 100px);
  grid-gap: 0.2em;
}

.grid-move {
  transition: all 0.3s;
}

.cell {
  background-color: white;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
