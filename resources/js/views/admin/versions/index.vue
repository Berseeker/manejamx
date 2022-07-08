<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="float-left mt-2">Versiones</h3>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <v-select
                                    label="label"
                                    :reduce="year => year.value"
                                    v-model="filters.year"
                                    :options="years"
                                    placeholder="Elija un año"
                                    @input="fetchModels()"
                                ></v-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <v-select
                                    label="label"
                                    :reduce="brand => brand.id"
                                    v-model="filters.brand_id"
                                    :options="brands"
                                    placeholder="Elija una Marca"
                                    @input="fetchModels($event)"
                                ></v-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <v-select
                                    label="label"
                                    :reduce="model => model.id"
                                    v-model="filters.model_id"
                                    :options="models"
                                    placeholder="Elija un Modelo"
                                ></v-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="filters.search" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-primary" @click="index">Filtrar</button>
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
                                    <th>Nombre</th>
                                    <th>Año</th>
                                    <th>P. Venta</th>
                                    <th>P. Compra</th>
                                    <th>Moneda</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="version in versions" :key="version.id">
                                    <td>{{ version.id }}</td>
                                    <td>{{ version.model.brand.name }}</td>
                                    <td>{{ version.model.name }}</td>
                                    <td>{{ version.name }}</td>
                                    <td>{{ version.year }}</td>
                                    <td>{{ version.sell }}</td>
                                    <td>{{ version.buy }}</td>
                                    <td>{{ version.currency }}</td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#versionEdit"
                                            class="btn btn-primary btn-sm"
                                            @click="editVersion(version)"
                                        >
                                            <i class="fa fa-edit"></i>
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
        <modal id="versionEdit" title="Editar Versión" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="edit.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Año</label>
                            <input type="text" class="form-control" v-model="edit.year" placeholder="Nombre">
                            <small v-if="errors.year" class=" text-danger">{{ errors.year[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>P. Venta</label>
                            <input type="text" class="form-control" v-model="edit.sell" placeholder="Nombre">
                            <small v-if="errors.sell" class=" text-danger">{{ errors.sell[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>P. Compra</label>
                            <input type="text" class="form-control" v-model="edit.buy" placeholder="Nombre">
                            <small v-if="errors.buy" class=" text-danger">{{ errors.buy[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Moneda</label>
                            <input type="text" class="form-control" v-model="edit.currency" placeholder="Nombre">
                            <small v-if="errors.currency" class=" text-danger">{{ errors.currency[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Model from "../../../models/admin/Model";
    import Brand from "../../../models/admin/Brand";
    import Version from "../../../models/admin/Version";

    export default {
        components: {Paginator},

        data() {
            return {
                brands:     [],
                models:     [],
                versions:   [],
                filters:    {
                    brand_id: [],
                    model_id: []
                },
                edit:       {},
                pagination: {},
                errors:     {},
            }
        },

        created() {
            this.index();
            this.loadData()
        },

        methods: {
            loadData(){
                Brand.pluck({},data => this.brands = data)
                this.fetchModels();
            },

            fetchModels(brand_id = null){
                this.filters.brand_id = brand_id;
                this.filters.model_id = null;

                if(brand_id){
                    Model.pluck({ brand_id : brand_id}, data => this.models = data)
                }

            },

            index(page = 1) {
                let params = {
                    page    : page,
                    year    : this.filters.year,
                    brand_id: this.filters.brand_id,
                    model_id: this.filters.model_id,
                    search  : this.filters.search
                };

                Version.get(params, data =>{
                    this.versions   = data.data;
                    this.pagination = data.meta;
                });
            },

            editVersion(version) {
                this.edit = _.clone(version)
            },

            update() {
                Version.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Versión ha sido editada correctamente.')
                    $('#versionEdit').modal('hide');
                }, errors => this.errors = errors);
            },
        },

        computed:{

            years(){
                let years = [];

                for (let i = 2000; i < 2022; i++) {
                    years.push({
                        label:i,
                        value:i,
                    });
                }

                return _.orderBy(years, ['label'], ['desc']); years;
            }
        },
    }
</script>
