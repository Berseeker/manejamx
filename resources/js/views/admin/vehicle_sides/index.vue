<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left mt-2">Lados de Vehículo</h3>
                    <a class="btn btn-icon-toggle float-right"
                        data-toggle="modal"
                        data-target="#sideCreate"
                    >
                        <button class="btn btn-primary" id="menu-toggle">Nuevo</button>
                    </a>
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
                                <tr v-for="side in sides" :key="side.id">
                                    <td>{{ side.id }}</td>
                                    <td>{{ side.name }}</td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#sideEdit"
                                            class="btn btn-primary btn-sm"
                                            @click="edit = side"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a
                                            v-tooltip="'Eliminar'"
                                            data-toggle="modal"
                                            data-target="#sideDestroy"
                                            class="btn btn-danger btn-sm"
                                            @click="edit = side"
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
        <modal id="sideCreate" title="Agregar Lado de Vehículo" close="Cancelar" size="modal-lg">
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
        <modal id="sideEdit" title="Editar Lado de Vehículo" close="Cancelar" size="modal-lg">
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
        <modal id="sideDestroy" title="¿Estas seguro de Eliminar Lado de Vehículo?" close="No" size="modal-lg">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import VehicleSide from "../../../models/admin/VehicleSide";

    export default {
        components: {Paginator},

        data() {
            return {
                sides        : [],
                edit         : {},
                create       : {},
                pagination   : {},
                errors       : {},
            }
        },

        created() {
            this.index();
        },

        methods: {
            index(page = 1) {
                let params = {
                    page: page,
                };

                VehicleSide.get(params, data =>{
                    this.sides       = data.data;
                    this.pagination  = data.meta;
                });
            },

            store() {

                VehicleSide.store(this.create, data => {
                    this.create = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Lado de Vehículo ha sido agregado correctamente.')
                    $('#sideCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                VehicleSide.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Lado de Vehículo ha sido editado correctamente.')
                    $('#sideEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                VehicleSide.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    this.$toast.clear();
                    this.$toast.success('El Lado de Vehículo ha sido eliminado correctamente.')
                    $('#sideDestroy').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
