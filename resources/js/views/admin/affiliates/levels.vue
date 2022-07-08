<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Niveles de Afiliados</h3>
                        </div>

                        <div class="col-3 text-right">
                            <button type="button" class="btn btn-icon-toggle" data-toggle="modal" data-target="#dlgCreateLevel">
                                <button class="btn btn-primary" id="menu-toggle">Nuevo</button>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Puntos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="level in levels" :key="level.id">
                                <td class="text-center">
                                    <img v-if="level.file" :src="level.file.show_url" class="img-responsive" height="30">
                                </td>
                                <td>{{ level.name }}</td>
                                <td>{{ level.start_points }} - {{ level.end_points }}</td>
                                <td class="text-right">
                                    <a v-tooltip="'Editar'" data-toggle="modal" data-target="#dlgEditLevel"
                                       class="btn btn-primary btn-sm" @click="show(level)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a v-tooltip="'Eliminar'" data-toggle="modal" data-target="#dlgDeleteLevel"
                                        class="btn btn-danger btn-sm" @click="show(level)">
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

        <modal id="dlgCreateLevel" title="Agregar Nivel" close="Cancelar" size="modal-lg">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="create.name">
                        <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Insignia</label>
                        <input type="file" class="form-control-file" id="file_create">
                        <small v-if="errors.file" class=" text-danger">{{ errors.file[0] }}</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Puntos Desde</label>
                        <input type="number" class="form-control" v-model="create.start_points">
                        <small v-if="errors.start_points" class=" text-danger">{{ errors.start_points[0] }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Puntos Hasta</label>
                        <input type="number" class="form-control" v-model="create.end_points">
                        <small v-if="errors.end_points" class=" text-danger">{{ errors.end_points[0] }}</small>
                    </div>
                </div>
            </div>

            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>

        <modal id="dlgEditLevel" title="Editar Nivel" close="Cancelar" size="modal-lg">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="edit.name">
                        <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Insignia</label>
                        <input type="file" class="form-control-file" id="file_edit">
                        <small v-if="errors.file" class=" text-danger">{{ errors.file[0] }}</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Puntos Desde</label>
                        <input type="number" class="form-control" v-model="edit.start_points">
                        <small v-if="errors.start_points" class=" text-danger">{{ errors.start_points[0] }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Puntos Hasta</label>
                        <input type="number" class="form-control" v-model="edit.end_points">
                        <small v-if="errors.end_points" class=" text-danger">{{ errors.end_points[0] }}</small>
                    </div>
                </div>
            </div>

            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>

        <modal-delete id="dlgDeleteLevel" title="¿Estas Seguro de Eliminar este Nivel?" close="No">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal-delete>
    </div>
</template>

<script>
    import Level from "../../../models/admin/affiliates/Level";
    import Paginator from "../../../components/Paginator";

    export default {
        components: {Paginator},
        data() {
            return {
                levels: [],
                create: {},
                edit: {},
                errors: {},
                pagination: {},
            }
        },

        created() {
            this.index();
        },

        methods: {
            async index(page = 1) {
                await Level.get({page: page}, data => {
                    this.levels = data.data;
                    this.pagination = data.meta;
                });
            },

            async store() {
                this.errors = {};
                Vue.$toast.info('Guardando.');

                const form = new FormData();

                const file = document.getElementById('file_create').files[0];

                form.append('name', this.create.name ? this.create.name : '');
                form.append('start_points', this.create.start_points ? this.create.start_points : '');
                form.append('end_points', this.create.end_points ? this.create.end_points : '');
                form.append('file', file ? file : '');

                await Level.store(form, data => {
                    this.create = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Nivel ha sido agregado correctamente.')
                    $('#dlgCreateLevel').modal('hide');
                }, errors => this.errors = errors);
            },

            show(element) {
                this.edit = _.clone(element);
            },

            async update() {
                this.errors = {};
                Vue.$toast.info('Guardando.');

                const form = new FormData();

                const file = document.getElementById('file_edit').files[0];

                form.append('name', this.edit.name ? this.edit.name : '');
                form.append('start_points', this.edit.start_points ? this.edit.start_points : '');
                form.append('end_points', this.edit.end_points ? this.edit.end_points : '');
                form.append('file', file ? file : '');
                form.append('_method', 'PUT');

                await Level.update(this.edit.id, form, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Nivel ha sido actualizado correctamente.')
                    $('#dlgEditLevel').modal('hide');
                }, errors => this.errors = errors);
            },

            async destroy() {
                Vue.$toast.info('Eliminando.')

                await Level.destroy(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Nivel ha sido eliminado correctamente.')
                    $('#dlgDeleteLevel').modal('hide');
                });
            }
        }
    }
</script>
