<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Tipo de Combustibles</h3>
                        </div>
                        <div class="col">
                            <div class="input-group mt-2 pr-3">
                                <input type="text" v-model="filters.search" class="form-control" placeholder="Buscar" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button @click="index" class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <a class="btn btn-icon-toggle float-right btn btn-primary mt-2"
                                data-toggle="modal"
                                data-target="#fuelCreate"
                            >
                                Nuevo
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="fuel in fuels" :key="fuel.id">
                                    <td>{{ fuel.id }}</td>
                                    <td>{{ fuel.name }}</td>
                                    <td class="text-right">
                                        <template v-if="!fuel.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#fuelEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="edit = fuel"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#fuelDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="edit = fuel"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </template>
                                        <a
                                            v-if="fuel.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#fuelRestore"
                                            class="btn btn-success btn-sm"
                                            @click="edit = fuel"
                                        >
                                            <i class="fa fa-trash-restore"></i>
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
        <modal id="fuelCreate" title="Agregar Tipo de Combustible" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="create.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>
        <modal id="fuelEdit" title="Editar Tipo de Combustible" close="Cancelar" size="modal-lg">
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
        <modal id="fuelDestroy" title="¿Estas seguro de Eliminar Tipo de Combustible?" close="No">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="fuelRestore" title="¿Estas seguro de Restaurar Tipo de Combustible?" close="No">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Fuel from "../../../models/admin/Fuel";

    export default {
        components: {Paginator},

        data() {
            return {
                fuels: [],
                edit         : {},
                create       : {},
                pagination   : {},
                errors       : {},
                filters      : {},
            }
        },

        created() {
            this.index();
        },

        methods: {
            index(page = 1) {
                let params = {
                    page  : page,
                    search: this.filters.search,
                    with_trash:true
                };

                Fuel.get(params, data =>{
                    this.fuels = data.data;
                    this.pagination    = data.meta;
                });
            },

            store() {

                Fuel.store(this.create, data => {
                    this.create = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Tipo de combustible ha sido agregado correctamente.')
                    $('#fuelCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                Fuel.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Tipo de combustible ha sido editado correctamente.')
                    $('#fuelEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                Fuel.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Tipo de combustible ha sido eliminado correctamente.')
                    $('#fuelDestroy').modal('hide');
                }, errors => this.errors = errors);
            },
            
            restore() {

                Fuel.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Tipo de combustible ha sido restaurado correctamente.')
                    $('#fuelRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
