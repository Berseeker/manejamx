<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="float-left mt-2">
                                Crear Vehículo
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
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 1, 'btn-secondary':step != 1 }">1</button>
                                        <p>Datos</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 2, 'btn-secondary':step != 2 }">2</button>
                                        <p>Detalles</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 3, 'btn-secondary':step != 3 }">3</button>
                                        <p>Accessorios</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 4, 'btn-secondary':step != 4 }">4</button>
                                        <p>Inspecciones</p>
                                    </div>

                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" :class="{'btn-primary':step === 5, 'btn-secondary':step != 5 }">5</button>
                                        <p>Fotografías</p>
                                    </div>
                                </div>
                            </div>
                            <form class="mt-4">
                                <template v-if="step == 1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Año</label>
                                                    <v-select
                                                        label="label"
                                                        :options="years"
                                                        v-model="create.year_value"
                                                        placeholder="Elija un año"
                                                        @input="fetchBrands()"
                                                    ></v-select>
                                                </div>
                                                <small v-if="errors.year" class=" text-danger">{{ errors.year[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="d-flex justify-content-between align-items-center align-content-center">
                                                        <label>Marca</label>
                                                        <span class="fa fa-plus-circle"
                                                              @click="createBrand"
                                                        ></span>
                                                    </div>
                                                    <v-select
                                                        :disabled="!create.year_value"
                                                        label="label"
                                                        :options="brands"
                                                        v-model="create.brand"
                                                        placeholder="Elija una Marca"
                                                        @input="fetchModels($event)"
                                                    ></v-select>
                                                </div>
                                                <small v-if="errors.brand_id" class=" text-danger">{{ errors.brand_id[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center align-content-center">
                                                    <label>Modelo</label>
                                                    <span class="fa fa-plus-circle"
                                                          @click="createModel"
                                                    ></span>
                                                </div>
                                                <v-select
                                                    :disabled="!create.brand"
                                                    label="label"
                                                    v-model="create.model"
                                                    :options="models"
                                                    placeholder="Elija un Modelo"
                                                    @input="fetchVersions($event)"
                                                ></v-select>
                                                <small v-if="errors.model_id" class=" text-danger">{{ errors.model_id[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center align-content-center">
                                                    <label>Versión</label>
                                                    <span class="fa fa-plus-circle"
                                                          @click="createVersion"
                                                    ></span>
                                                </div>
                                                <v-select
                                                    :disabled="!create.model"
                                                    label="label"
                                                    v-model="create.version"
                                                    :options="versions"
                                                    placeholder="Elija una Version"
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
                                                    v-model="create.body_type"
                                                    :options="body_types"
                                                    placeholder="Elija una tipo"
                                                ></v-select>
                                               <small v-if="errors.body_type_id" class=" text-danger">{{ errors.body_type_id[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de Serie</label>
                                                <input type="text" class="form-control" v-model="create.vin" placeholder="">
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
                                                    <input type="number" min="0" class="form-control" v-model="create.odometer" placeholder="">
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
                                                    <input type="number" min="0" class="form-control" v-model="create.fuel_consumption" placeholder="">
                                                </div>
                                                <small v-if="errors.fuel_consumption" class=" text-danger">{{ errors.fuel_consumption[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de puertas</label>
                                                <input type="number" min="1" class="form-control" v-model="create.doors" placeholder="">
                                                <small v-if="errors.doors" class=" text-danger">{{ errors.doors[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de llaves</label>
                                                <input type="number" min="0" class="form-control" v-model="create.keys" placeholder="">
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
                                                    <input type="text" min="0" class="form-control" v-model="create.buy_price" placeholder="">
                                                </div>
                                                <small v-if="errors.buy_price" class=" text-danger">{{ errors.buy_price[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Precio Venta</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" min="0" class="form-control" v-model="create.sell_price" placeholder="">
                                                </div>
                                                <small v-if="errors.sell_price" class=" text-danger">{{ errors.sell_price[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción</label>
                                                <textarea class="form-control" v-model="create.description"></textarea>
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
                                                        <checkbox v-for=" transmission in transmissions" :key="'transmission_'+transmission.id" :value="transmission.id" v-model="create.transmissions">
                                                            {{transmission.name}}
                                                        </checkbox>
                                                        <small v-if="errors.transmissions" class=" text-danger">{{ errors.transmissions[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Cilindraje</label>
                                                        <checkbox v-for=" cylinder in cylinders" :key="'cylinder_'+cylinder.id" :value="cylinder.id" v-model="create.cylinders">
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
                                                        <checkbox v-for=" fuel in fuels" :key="'fuel_'+fuel.id" :value="fuel.id" v-model="create.fuels">
                                                            {{fuel.name}}
                                                        </checkbox>
                                                        <small v-if="errors.fuels" class=" text-danger">{{ errors.fuels[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Tracción</label>
                                                        <checkbox v-for=" drive in drives" :key="'drive_'+drive.id" :value="drive.id" v-model="create.drives">
                                                            {{drive.name}}
                                                        </checkbox>
                                                        <small v-if="errors.drives" class=" text-danger">{{ errors.drives[0] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Color Exterior</label>
                                                <checkbox v-for=" color in colors" :key="'color_'+color.id" :value="color.id" v-model="create.colors">
                                                    {{color.name}}
                                                </checkbox>
                                                <small v-if="errors.colors" class=" text-danger">{{ errors.colors[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Color del Interior</label>
                                                <checkbox v-for="color in colors" :key="'interior_color_'+color.id" :value="color.id" v-model="create.interior_colors">
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
                                                <checkbox v-for=" accessory in type" :key="'accessory_'+accessory.id" :value="accessory.id" v-model="create.accessories">
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
                                                <checkbox  :key="'inspection_'+inspection.id" :value="inspection.id" v-model="create.inspections">
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
                                                            @click="create.type_id = 2"
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
                                                            @click="create.type_id = 3"
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
                            <small v-if="errors.description" class=" text-danger">{{ errors.description[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button :disabled="storing" slot="btnSave" type="button" class="btn btn-primary" @click="storeImage"><i v-if="storing" class="fas fa-spinner fa-spin"></i> {{storing ? 'Guardando...' : 'Guardar' }}</button>
        </modal>

        <modal id="deleteImage" title="¿Estas seguro de eliminar esta fotografía?" close="No" size="modal-lg">
            <button slot="btnSave" type="button" class="btn btn-danger" @click="destroyImage">Si</button>
        </modal>

        <modal id="createBrandModal" title="Agregar nueva Marca" close="Cancelar">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="new_brand_name" placeholder="Nombre">
                            <p class="mt-2">Verifique que la información ingresada sea correcta</p>
                            <small v-if="errors.new_brand_name" class=" text-danger">{{ errors.new_brand_name[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="storeBrand">Guardar</button>
        </modal>

        <modal id="createModelModal" title="Agregar nuevo Modelo" close="Cancelar">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="new_model_name" placeholder="Nombre">
                            <p class="mt-2">Verifique que la información ingresada sea correcta</p>
                            <small v-if="errors.new_model_name" class=" text-danger">{{ errors.new_model_name[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>

            <button slot="btnSave" type="button" class="btn btn-primary" @click="storeModel">Guardar</button>
        </modal>

        <modal id="createVersionModal" title="Agregar nuevo Versión" close="Cancelar">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="new_version_name" placeholder="Nombre">
                            <p class="mt-2">Verifique que la información ingresada sea correcta</p>
                            <small v-if="errors.new_version_name" class=" text-danger">{{ errors.new_version_name[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="storeVersion">Guardar</button>
        </modal>
    </div>
</template>

<script>
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
        components: {Paginator},

        data() {
            return {
                multiple     : false,
                drag         : false,
                storing      : false,
                step         : 1,
                vehicle      : {},
                file_types   : [],
                body_types   : [],
                brands       : [],
                models       : [],
                drives       : [],
                versions     : [],
                edit         : {},
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
                create:{
                    year_value     : null,
                    version        : {},
                    model          : null,
                    transmissions  : [],
                    cylinders      : [],
                    accessories    : [],
                    fuels          : [],
                    drives         : [],
                    colors         : [],
                    interior_colors: [],
                    inspections     :[],
                },
                errors:{},
                new_brand_name: null,
                new_model_name: null,
                new_version_name: null
            }
        },

        created() {
            this.loadData()
        },

        computed:{

            years(){
                let years = [];

                for (let i = 2000; i <= (new Date().getFullYear()+1); i++) {
                    years.push({
                        label:i,
                        value:i,
                    });
                }

                return _.orderBy(years, ['label'], ['desc']); years;
            }
        },

        methods: {
            loadData(){
                BodyType.pluck(data => this.body_types = data)
                FileType.pluck(data => this.file_types = data)
                Brand.pluck({},data => this.brands = data)
                Transmission.pluck(data => this.transmissions = data)
                Cylinder.pluck(data => this.cylinders = data)
                Fuel.pluck(data => this.fuels = data)
                Color.pluck(data => this.colors = data)
                Drive.pluck(data => this.drives = data)

                Accessory.pluck(data => {
                    this.accessories = _.groupBy(data, 'type' );
                })

                Inspection.pluck(data => this.inspections = data)
            },

            fetchBrands(){
                Brand.pluck({year :this.create.year_value.value}, data => this.brands = data)
            },

            fetchModels(brand){
                this.create.brand = brand;
                this.create.model = {};
                this.models       = [];

                let params = {
                    year     : this.create.year_value.value,
                    brand_id :brand.id
                }

                Model.pluck(params , data => this.models = data)

            },

            fetchVersions(model = null) {
                this.create.model   = model != null ? model: this.create.model;
                this.create.version = {};
                this.versions       = [];

                if(this.create.model){
                    let params = {
                        brand_id: this.create.brand.id,
                        model_id: this.create.model.id,
                        year    : this.create.year_value.value
                    };

                    Version.get(params, data =>{
                        this.versions = []
                        data.data.forEach(element => {
                            this.versions.push({
                                id: element.id,
                                label: element.name,
                                year: element.year
                            });
                        });
                    });
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
                    this.vehicle.id ? this.update() : this.store();
                }
            },

            back(){
                this.step--;
            },


            loadVehicle(){
                Vehicle.show(this.vehicle.id, data => this.vehicle = data.data);
            },

            store() {

                this.create.brand_id     = this.create.brand ? this.create.brand.id        : '';
                this.create.model_id     = this.create.model ? this.create.model.id        : '';
                this.create.version_id   = this.create.version ? this.create.version.id    : '';
                this.create.body_type_id = this.create.body_type ? this.create.body_type.id: '';
                this.create.year         = this.create.version ? this.create.version.year  : '';
                this.create.year         = this.create.year_value ? this.create.year_value.value:'';

                Vehicle.store(this.create, data => {
                    this.vehicle = data.data;
                    Vue.$toast.clear();
                    Vue.$toast.success('Datos del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            update() {

                this.create.brand_id     = this.create.brand ? this.create.brand.id:'';
                this.create.model_id     = this.create.model ? this.create.model.id:'';
                this.create.version_id   = this.create.version ? this.create.version.id:'';
                this.create.body_type_id = this.create.body_type ? this.create.body_type.id:'';
                this.create.year         = this.create.year_value ? this.create.year_value.value:'';

                Vehicle.update(this.vehicle.id, this.create, data => {
                    this.vehicle = data.data;
                    Vue.$toast.clear();
                    Vue.$toast.success('Datos del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            storeDetails() {

                Vehicle.details(this.vehicle.id, this.create, data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Detalles del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            storeAccessories() {
                Vehicle.accessories(this.vehicle.id, this.create, data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Detalles del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            storeImage() {
                this.storing = true;

                let fileId   = 'file';
                let formData = new FormData();
                let file = document.getElementById(fileId).files[0];

                formData.append('file', file ? file : '');
                formData.append('type_id', this.create.type_id);
                formData.append('description', this.create.description ? this.create.description : '');

                VehicleImage.store(this.vehicle.id, formData, data => {
                    this.vehicle = data.data;
                    Vue.$toast.clear();
                    file.value = '';
                    this.create.type_id = '';
                    this.create.description = '';
                    Vue.$toast.success('Fotografía cargada.')
                    $('#addImage').modal('hide');
                    this.storing = false;
                    this.multiple = false;

                }, errors => {
                    this.storing = false;
                    this.errors  = errors;

                });
            },

            storeInspections() {
                let parameters = {
                    inspections: this.create.inspections,
                }

                Vehicle.inspections(this.vehicle.id, parameters , data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('Inspecciones del vehículo guardados.')
                    this.step++;
                }, errors => this.errors = errors);
            },

            destroyImage() {

                VehicleImage.destroy(this.vehicle.id, this.edit.id, data => {
                    this.loadVehicle();
                    Vue.$toast.clear();
                    this.edit = {};
                    Vue.$toast.success('Fotografía Eliminada.')
                    $('#deleteImage').modal('hide');
                });
            },

            editVehicle(vehicle) {
                this.edit = _.clone(vehicle)
                this.edit.cylinders = this.edit.cylinders.map(cylinder => cylinder.id)
                this.edit.transmissions = this.edit.transmissions.map(transmission => transmission.id)
                this.edit.accessories = this.edit.accessories.map(accessory => accessory.id)
                this.edit.fuels = this.edit.fuels.map(fuel => fuel.id)
                this.edit.colors = this.edit.colors.map(color => color.id)
            },

            createBrand() {
                if (!this.create.year_value) {
                    Vue.$toast.error('Debe elegir un Año.')
                    return
                }
                $('#createBrandModal').modal('show');
            },

            storeBrand() {
                Brand.store({name: this.new_brand_name},
                response => {
                        let new_brand = {
                            id: response.data.id,
                            label: response.data.name
                        }
                        this.fetchModels(new_brand)
                        $('#createBrandModal').modal('hide');
                        Vue.$toast.clear();
                        Vue.$toast.success('Nueva Marca creada correctamente.')
                    },
                errors => {

                    }
                )
            },

            createModel() {
                if (!this.create.year_value || !this.create.brand) {
                    Vue.$toast.error('Debe elegir un Año y Marca.')
                    return
                }
                $('#createModelModal').modal('show');
            },

            storeModel() {
                Model.store({
                        name: this.new_model_name,
                        brand_id: this.create.brand.id
                    },
                    response => {
                        console.log(response.data)
                        let new_model = {
                            brand_id: response.data.brand_id,
                            id: response.data.id,
                            label: response.data.name
                        }
                        this.fetchVersions(new_model)
                        $('#createModelModal').modal('hide');
                        Vue.$toast.clear();
                        Vue.$toast.success('Nuevo Model creado correctamente.')
                    },
                    errors => {

                    }
                )
            },

            createVersion() {
                if (!this.create.year_value || !this.create.brand || !this.create.model) {
                    Vue.$toast.error('Debe elegir Año, Marca y Modelo.')
                    return
                }
                $('#createVersionModal').modal('show');
            },

            storeVersion() {
                Version.store({
                        name: this.new_version_name,
                        model_id: this.create.model.id,
                        year: this.create.year_value.value
                    },
                    response => {
                    console.log(response.data)
                        let new_version = {
                            id: response.data.id,
                            label: response.data.name,
                            year: response.data.year
                        }
                        this.versions.push(new_version)
                        this.create.version = new_version
                        $('#createVersionModal').modal('hide');
                        Vue.$toast.clear();
                        Vue.$toast.success('Nueva Versión creada correctamente.')
                    },
                    errors => {

                    }
                )
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
</style>
