<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Cilindrajes</h3>
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
                                data-target="#cylinderCreate"
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
                                <tr v-for="cylinder in cylinders" :key="cylinder.id">
                                    <td>{{ cylinder.id }}</td>
                                    <td>{{ cylinder.name }}</td>
                                    <td class="text-right">
                                        <template v-if="!cylinder.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#cylinderEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="edit = cylinder"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#cylinderDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="edit = cylinder"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </template>
                                        <a
                                            v-if="cylinder.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#cylinderRestore"
                                            class="btn btn-success btn-sm"
                                            @click="edit = cylinder"
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
        <modal id="cylinderCreate" title="Agregar Cilindraje" close="Cancelar" size="modal-lg">
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
        <modal id="cylinderEdit" title="Editar Cilindraje" close="Cancelar" size="modal-lg">
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
        <modal-delete id="cylinderDestroy" title="¿Estas seguro de Eliminar este Cilindraje?" close="No" size="modal">
            <button slot="btnDelete" type="button" class="btn btn-danger" @click="destroy">Si</button>
        </modal-delete>
        <modal-delete id="cylinderRestore" title="¿Estas seguro de Restaurar este Cilindraje?" close="No" size="modal">
            <button slot="btnDelete" type="button" class="btn btn-success" @click="restore">Si</button>
        </modal-delete>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Cylinder from "../../../models/admin/Cylinder";

    export default {
        components: {Paginator},

        data() {

            return {
                cylinders    : [],
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
                    page    : page,
                    search  : this.filters.search,
                    with_trash:true,
                };

                Cylinder.get(params, data =>{
                    this.cylinders  = data.data;
                    this.pagination = data.meta;
                });
            },

            store() {

                Cylinder.store(this.create, data => {
                    this.create = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Cilindraje ha sido agregado correctamente.')
                    $('#cylinderCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                Cylinder.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Cilindraje ha sido editado correctamente.')
                    $('#cylinderEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                Cylinder.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Cilindraje ha sido eliminado correctamente.')
                    $('#cylinderDestroy').modal('hide');
                }, errors => this.errors = errors);
            },
            
            restore() {

                Cylinder.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Cilindraje ha sido restaurado correctamente.')
                    $('#cylinderRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
