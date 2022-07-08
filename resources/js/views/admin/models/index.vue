<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="float-left mt-2">Modelos</h3>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <v-select
                                    multiple
                                    label="label"
                                    :reduce="brand => brand.id"
                                    v-model="filters.brand_id"
                                    :options="brands"
                                    placeholder="Marca"
                                ></v-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="filters.search" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-1">
                            <button  type="button" class="btn btn-primary" @click="index">Filtrar</button>
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
                                    <th>Nombre</th>
                                    <th class="text-center">Cant. de Versiones</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="model in models" :key="model.id">
                                    <td>{{ model.id }}</td>
                                    <td>{{ model.brand.name }}</td>
                                    <td>{{ model.name }}</td>
                                    <td class="text-center">{{ model.versions_count }}</td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#modelEdit"
                                            class="btn btn-primary btn-sm"
                                            @click="editModel(model)"
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
        <modal id="modelEdit" title="Editar Modelo" close="Cancelar" size="modal-lg">
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
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Model from "../../../models/admin/Model";
    import Brand from "../../../models/admin/Brand";

    export default {
        components: {Paginator},

        data() {
            return {
                brands:     [],
                models:     [],
                filters:    {
                    brand_id: []
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
            },

            index(page = 1) {
                let params = {
                    page    : page,
                    brand_id: this.filters.brand_id,
                    search  : this.filters.search
                };

                Model.get(params, data =>{
                    this.models     = data.data;
                    this.pagination = data.meta;
                });
            },

            editModel(model) {
                this.edit = _.clone(model)
            },

            update() {
                Model.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Modelo ha sido editada correctamente.')
                    $('#modelEdit').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
