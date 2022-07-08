<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="float-left mt-2">Vehículos</h3>
                            <a type="button" class="btn btn-primary pull-right" href="vehicles/create">
                                Nuevo
                            </a>
                            <a   class="btn btn-primary pull-right mr-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <span class="fa fa-filter"></span>
                            </a>
                        </div>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <v-select
                                                @input="fetchModels"
                                                label="label"
                                                v-model="filters.brand"
                                                :options="brands"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Modelo</label>
                                            <v-select
                                                label="label"
                                                v-model="filters.model"
                                                :options="models"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Transmisión</label>
                                            <v-select
                                                label="name"
                                                v-model="filters.transmission"
                                                :options="transmissions"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cilindraje</label>
                                            <v-select
                                                label="name"
                                                v-model="filters.cylinder"
                                                :options="cylinders"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Combustible</label>
                                            <v-select
                                                label="name"
                                                v-model="filters.fuel"
                                                :options="fuels"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <v-select
                                                label="name"
                                                v-model="filters.color"
                                                :options="colors"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Estatus</label>
                                            <v-select
                                                label="name"
                                                v-model="filters.status"
                                                :options="statuses"
                                            ></v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label></label>
                                            <button slot="btnSave" type="button" class="btn btn-primary" @click="index">Filtrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Versión</th>
                                    <th>VIN</th>
                                    <th>P. Compra</th>
                                    <th>P. Venta</th>
                                    <th>Afiliado</th>
                                    <th class="text-center">Activo</th>
                                    <th class="text-center">Estatus</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="vehicle in vehicles" :key="vehicle.id">
                                    <td>{{ vehicle.id }}</td>
                                    <td>{{ vehicle.brand.name }}</td>
                                    <td>{{ vehicle.model.name }}</td>
                                    <td>{{ vehicle.version.name }}</td>
                                    <td>{{ vehicle.vin}}</td>
                                    <td>{{ vehicle.buy_price | currency }}</td>
                                    <td>{{ vehicle.sell_price | currency }}</td>
                                    <td>{{ vehicle.affiliate ? vehicle.affiliate.commercial_name : '-' }}</td>
                                    <td class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" :checked="vehicle.active" :id="'active_'+vehicle.id" @click="changeActive(vehicle.id)">
                                            <label class="custom-control-label" :for="'active_'+vehicle.id"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a
                                            href="#vehicleStatus"
                                            data-toggle="modal"
                                            data-target="#vehicleStatus"
                                            v-if="vehicle.status"
                                            @click.prevent="editVehicle(vehicle)">
                                            <span class="badge" :class="{'badge-success' :  vehicle.status.id == 1, 'badge-danger' :  vehicle.status.id == 2, 'badge-primary' :  vehicle.status.id == 3}">
                                                {{vehicle.status ? vehicle.status.name : ''}}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        <a
                                            :href="'/admin/vehicles/'+vehicle.id"
                                            v-tooltip="'Editar'"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a
                                            data-toggle="modal"
                                            data-target="#vehicleDelete"
                                            @click="editVehicle(vehicle)"
                                            class="btn btn-danger btn-sm"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <paginator :pagination="pagination" @changePage="index"></paginator>
                </div>
            </div>
        </div>

        <modal-delete id="vehicleDelete" title="¿Estás seguro de eliminar este Vehículo?">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal-delete>

        <modal id="vehicleStatus" title="Cambiar Estatus" close="Cancelar">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <v-select label="name" :options="statuses" v-model="edit.status" ></v-select>
                            <small v-if="errors.status_id" class=" text-danger">{{ errors.status_id[0] }}</small>
                        </div>
                    </div>

                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="changeStatus">Guardar</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Model from "../../../models/admin/Model";
    import Brand from "../../../models/admin/Brand";
    import Vehicle from "../../../models/admin/Vehicle";
    import VehicleStatus from "../../../models/admin/VehicleStatus";
    import Transmission from "../../../models/admin/Transmission";
    import Cylinder from "../../../models/admin/Cylinder";
    import Fuel from "../../../models/admin/Fuel";
    import Color from "../../../models/admin/Color";

    export default {
        components: {Paginator},

        data() {
            return {
                statuses:   [],
                brands:     [],
                models:     [],
                versions:   [],
                filters:    {
                    brand_id: [],
                    model_id: []
                },
                edit:       {
                    brand: {},
                    model: {},
                    version: {},
                    transmissions: [],
                    cylinders: [],
                    accessories: [],
                    fuels: [],
                    colors: []
                },
                create:       {
                    brand: {},
                    model: {},
                    version: {},
                    transmissions: [],
                    cylinders: [],
                    accessories: [],
                    fuels: [],
                    colors: []
                },
                pagination: {},
                errors:     {},

                vehicles: [],
                transmissions: [],
                cylinders: [],
                accessories: [],
                fuels: [],
                colors: []
            }
        },

        created() {
            this.index();
            this.loadData()
        },

        methods: {
            loadData(){
                VehicleStatus.get({},data => this.statuses = data.data);
                Brand.pluck({},data => this.brands = data)
                Transmission.pluck(data => this.transmissions = data)
                Cylinder.pluck(data => this.cylinders = data)
                Fuel.pluck(data => this.fuels = data)
                Color.pluck(data => this.colors = data)
            },

            fetchModels(brand){
                this.filters.brand = brand;
                this.filters.model = {};
                this.models        = [];

                Model.pluck({brand_id :brand.id}, data => this.models = data)

            },

            index(page = 1) {
                let params = {
                    page: page,
                    status_id: this.filters.status ? this.filters.status.id : '',
                    brand_id: this.filters.brand ? this.filters.brand.id : '',
                    model_id: this.filters.model ? this.filters.model.id : '',
                    color_id: this.filters.color ? this.filters.color.id : '',
                    fuel_id: this.filters.fuel ? this.filters.fuel.id : '',
                    transmission_id: this.filters.transmission ? this.filters.transmission.id : '',
                    cylinder_id: this.filters.cylinder ? this.filters.cylinder.id : '',
                };

                Vehicle.get(params, data => {
                    this.vehicles   = data.data;
                    this.pagination = data.meta;
                })


            },

            editVehicle(vehicle) {
                this.edit = _.clone(vehicle)
                this.edit.cylinders = this.edit.cylinders.map(cylinder => cylinder.id)
                this.edit.transmissions = this.edit.transmissions.map(transmission => transmission.id)
                this.edit.accessories = this.edit.accessories.map(accessory => accessory.id)
                this.edit.fuels = this.edit.fuels.map(fuel => fuel.id)
                this.edit.colors = this.edit.colors.map(color => color.id)
            },

            update() {

                Vehicle.update(this.edit.id, this.edit, data => {
                    this.edit = {
                        brand: {},
                        model: {},
                        version: {},
                        transmissions: [],
                        cylinders: [],
                    };
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Versión ha sido editada correctamente.')
                    $('#vehicleEdit').modal('hide');
                }, errors => this.errors = errors);
            },

            destroy() {
                Vehicle.destroy(this.edit.id, data => {
                    this.edit = {
                        brand: {},
                        model: {},
                        version: {},
                        transmissions: [],
                        cylinders: [],
                    };
                    this.index();
                    $('#vehicleDelete').modal('hide');
                });
            },

            changeActive(vehicle_id){
                Vehicle.changeActive(vehicle_id, data => {
                    this.index();
                });
            },

            changeStatus(){
                this.edit.status_id = this.edit.status ? this.edit.status.id :'';
                Vehicle.changeStatus(this.edit.id, this.edit, data => {
                    this.index();
                    $('#vehicleStatus').modal('hide');
                    Vue.$toast.success('Estatus del vehículo actualizado.')
                });
            }
        },

        computed: {
            filteredModels() {
                if (this.filters.brand_id.length > 0) {
                    return this.models.filter(model => this.filters.brand_id.includes(model.brand_id))
                }
                return this.models
            }
        }
    }
</script>
