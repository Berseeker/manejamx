<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Colores</h3>
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
                            <a class="btn btn-icon-toggle float-right"
                                data-toggle="modal"
                                data-target="#colorCreate"
                            >
                                <button class="btn btn-primary" id="menu-toggle">Nuevo</button>
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
                                    <th>Hex</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="color in colors" :key="color.id">
                                    <td>{{ color.id }}</td>
                                    <td>{{ color.name }}</td>
                                    <td>{{ color.hex }}</td>
                                    <td class="text-right">
                                        <template v-if="!color.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#colorEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="edit = color"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#colorDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="edit = color"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </template>
                                        <a
                                            v-if="color.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#colorRestore"
                                            class="btn btn-success btn-sm"
                                            @click="edit = color"
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
        <modal id="colorCreate" title="Agregar Color" close="Cancelar" size="modal-lg">
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
                            <label>Hex</label>
                            <input type="text" class="form-control" v-model="create.hex" placeholder="Nombre">
                            <small v-if="errors.hex" class=" text-danger">{{ errors.hex[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>
        <modal id="colorEdit" title="Editar Color" close="Cancelar" size="modal-lg">
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
                            <label>Hex</label>
                            <input type="text" class="form-control" v-model="edit.hex" placeholder="Nombre">
                            <small v-if="errors.hex" class=" text-danger">{{ errors.hex[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>
        <modal id="colorDestroy" title="¿Estas seguro de Eliminar este Color?" close="No">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="colorRestore" title="¿Estas seguro de Restaurar este Color?" close="No">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Color from "../../../models/admin/Color";

    export default {
        components: {Paginator},

        data() {
            return {
                colors    : [],
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
                    page   : page,
                    search : this.filters.search,
                    with_trash:true
                };

                Color.get(params, data =>{
                    this.colors       = data.data;
                    this.pagination  = data.meta;
                });
            },

            store() {

                Color.store(this.create, data => {
                    this.create = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Color ha sido agregado correctamente.')
                    $('#colorCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                Color.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Color ha sido editado correctamente.')
                    $('#colorEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                Color.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Color ha sido eliminado correctamente.')
                    $('#colorDestroy').modal('hide');
                }, errors => this.errors = errors);
            },
            
            restore() {

                Color.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Color ha sido restaurado correctamente.')
                    $('#colorRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
