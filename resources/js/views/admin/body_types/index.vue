<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Tipos de Carroceria</h3>
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
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="type in types" :key="type.id">
                                    <td>{{ type.id }}</td>
                                    <td><img v-if="type.file" height="30" :src="type.file ? type.file.show_url :''" :alt="type.name"></td>
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
                                                v-tooltip="'Elimianr'"
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

        <modal id="typeCreate" title="Agregar Tipo de Carroceria" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="create.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" class="form-control-file" id="file" placeholder="Imagen">
                            <small v-if="errors.file" class=" text-danger">{{ errors.file[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>
        
        <modal id="typeEdit" title="Editar Tipo de Carroceria" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="edit.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" class="form-control-file" id="file_update" placeholder="Imagen">
                            <small v-if="errors.file" class=" text-danger">{{ errors.file[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>

        <modal id="typeDestroy" title="¿Estas Seguro de Eliminar este Tipo de Carroceria?" close="No" >
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="typeRestore" title="¿Estas Seguro de Restaurar este Tipo de Carroceria?" close="No" >
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import BodyType from "../../../models/admin/BodyType";

    export default {
        components: {Paginator},

        data() {
            return {
                types     : [],
                edit      : {},
                create    : {},
                pagination: {},
                errors    : {},
                filters   : {},
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

                BodyType.get(params, data =>{
                    this.types      = data.data;
                    this.pagination = data.meta;
                });
            },

            store() {

                let formData = new FormData();
                let file = document.getElementById('file').files[0];

                formData.append('name', this.create.name);
                formData.append('file', file ? file : '');

                BodyType.store(formData, data => {
                    this.create = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El tipo de carroceria ha sido agregado correctamente.')
                    $('#typeCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                let formData = new FormData();
                let file = document.getElementById('file_update').files[0];

                formData.append('name', this.edit.name);
                formData.append('file', file ? file : '');
                formData.append('_method', 'PUT');

                BodyType.update(this.edit.id, formData, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El tipo de carroceria ha sido editado correctamente.')
                    $('#typeEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                BodyType.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El tipo de carroceria ha sido eliminado.')
                    $('#typeDestroy').modal('hide');
                });
            },
            
            restore() {

                BodyType.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El tipo de carroceria ha sido restaurado.')
                    $('#typeRestore').modal('hide');
                });
            },
        }
    }
</script>
