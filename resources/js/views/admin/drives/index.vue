<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Tracciones</h3>
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
                                data-target="#driveCreate"
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="drive in drives" :key="drive.id">
                                    <td>{{ drive.id }}</td>
                                    <td>{{ drive.name }}</td>
                                    <td class="text-right">
                                        <template v-if="!drive.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#driveEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="edit = drive"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#driveDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="edit = drive"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </template>
                                        <a
                                            v-if="drive.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#driveRestore"
                                            class="btn btn-success btn-sm"
                                            @click="edit = drive"
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
        <modal id="driveCreate" title="Agregar Tracción" close="Cancelar" size="modal-lg">
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
        <modal id="driveEdit" title="Editar Tracción" close="Cancelar" size="modal-lg">
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
        <modal id="driveDestroy" title="¿Estas seguro de Eliminar esta Tracción?" close="No" >
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="driveRestore" title="¿Estas seguro de Eliminar esta Tracción?" close="No" >
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Drive from "../../../models/admin/Drive";

    export default {
        components: {Paginator},

        data() {
            return {
                drives    : [],
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
                };

                Drive.get(params, data =>{
                    this.drives      = data.data;
                    this.pagination  = data.meta;
                });
            },

            store() {

                Drive.store(this.create, data => {
                    this.create = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('La Tracción ha sido agregada correctamente.')
                    $('#driveCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                Drive.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('La Tracción ha sido editada correctamente.')
                    $('#driveEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                Drive.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('La Tracción ha sido eliminada correctamente.')
                    $('#driveDestroy').modal('hide');
                }, errors => this.errors = errors);
            },

            restore() {

                Drive.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('La Tracción ha sido restaurada correctamente.')
                    $('#driveRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
