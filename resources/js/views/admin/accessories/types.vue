<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Tipos de accesorios</h3>
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
                                data-target="#typeCreate"
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
                                <tr v-for="type in types" :key="type.id">
                                    <td>{{ type.id }}</td>
                                    <td>{{ type.name }}</td>
                                    <td class="text-right">
                                        <template v-if="!type.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#typeEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="edit = type"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#typeDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="edit = type"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </template>
                                        <a
                                            v-if="type.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#typeRestore"
                                            class="btn btn-success btn-sm"
                                            @click="edit = type"
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
        <modal id="typeCreate" title="Agregar Tipo de Accesorio" close="Cancelar" size="modal-lg">
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
        <modal id="typeEdit" title="Editar Tipo de Accesorio" close="Cancelar" size="modal-lg">
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
        <modal id="typeDestroy" title="¿Estas Seguro de Eliminar Tipo de Accesorio?" close="No">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="typeRestore" title="¿Estas Seguro de Restaurar Tipo de Accesorio?" close="No">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import AccessoryType from "../../../models/admin/AccessoryType";

    export default {
        components: {Paginator},

        data() {
            return {
                types        : [],
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

                AccessoryType.get(params, data =>{
                    this.types      = data.data;
                    this.pagination = data.meta;
                });
            },

            store() {

                AccessoryType.store(this.create, data => {
                    this.create = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Tipo de Accesorio ha sido agregada correctamente.')
                    $('#typeCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                AccessoryType.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Tipo de Accesorio ha sido editada correctamente.')
                    $('#typeEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                AccessoryType.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Tipo de Accesorio ha sido eliminada correctamente.')
                    $('#typeDestroy').modal('hide');
                }, errors => this.errors = errors);
            },
            
            restore() {

                AccessoryType.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Tipo de Accesorio ha sido restaurado correctamente.')
                    $('#typeRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
