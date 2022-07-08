<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="mt-2">Transmissiones</h3>
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
                                data-target="#transmissionCreate"
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
                                <tr v-for="transmission in transmissions" :key="transmission.id">
                                    <td>{{ transmission.id }}</td>
                                    <td>{{ transmission.name }}</td>
                                    <td class="text-right">
                                        <template v-if="!transmission.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#transmissionEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="edit = transmission"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#transmissionDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="edit = transmission"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>

                                        </template>
                                        <a v-if="transmission.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#transmissionRestore"
                                            class="btn btn-success btn-sm"
                                            @click="edit = transmission"
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
        <modal id="transmissionCreate" title="Agregar Transmisión" close="Cancelar" size="modal-lg">
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
        <modal id="transmissionEdit" title="Editar Transmisión" close="Cancelar" size="modal-lg">
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
        <modal id="transmissionDestroy" title="¿Estas seguro de Eliminar esta Transmisión?" close="No" size="modal-sm">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="transmissionRestore" title="¿Estas seguro de Restaurar esta Transmisión?" close="No" size="modal-sm">
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Transmission from "../../../models/admin/Transmission";

    export default {
        components: {Paginator},

        data() {
            return {
                transmissions: [],
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
                    page: page,
                    search: this.filters.search,
                    with_trash: true,
                };

                Transmission.get(params, data =>{
                    this.transmissions = data.data;
                    this.pagination    = data.meta;
                });
            },

            store() {

                Transmission.store(this.create, data => {
                    this.create = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Transmisión ha sido agregada correctamente.')
                    $('#transmissionCreate').modal('hide');
                }, errors => this.errors = errors);
            },
            
            update() {

                Transmission.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Transmisión ha sido editada correctamente.')
                    $('#transmissionEdit').modal('hide');
                }, errors => this.errors = errors);
            },
            
            destroy() {

                Transmission.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Transmisión ha sido eliminada correctamente.')
                    $('#transmissionDestroy').modal('hide');
                }, errors => this.errors = errors);
            },
            
            restore() {

                Transmission.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Transmisión ha sido restaurada correctamente.')
                    $('#transmissionRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
