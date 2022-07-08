<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left mt-2">Roles</h3>
                            <!-- <a class="btn btn-icon-toggle float-right"
                               data-toggle="modal"
                               data-target="#roleCreate"
                               @click="create"
                            >
                                <button class="btn btn-primary" id="menu-toggle">Nuevo</button>
                            </a> -->
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th style="width: 30px">Herramientas</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="role in roles" :key="role.id">
                                    <td>{{ role.id }}</td>
                                    <td>{{ role.readable_name }}</td>
                                    <td>
                                        <a
                                           data-toggle="modal"
                                           data-target="#roleEdit"
                                           class="btn btn-primary btn-sm"
                                           @click="edit(role)"
                                           >
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a
                                            data-toggle="modal"
                                            data-target="#roleDelete"
                                            @click="edit(role)"
                                            class="btn btn-danger btn-sm"
                                            >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <paginator :pagination="pagination" @changePage="index"></paginator>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal id="roleCreate" title="Nuevo Rol" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="role.readable_name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-primary" role="alert" v-model="role.name">
                            <small>Nombre interno: {{ slug }}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Permisos</label>
                        <div v-for="permission in permissions" :key="permission.id">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" :value="permission" v-model="role.permissions" :id="permission.name">
                                <label class="form-check-label" :for="permission.name">{{ permission.name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>

        <modal id="roleEdit" title="Editar Rol" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="role.readable_name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="alert alert-primary" role="alert" v-model="role.name">
                            <small>Nombre interno: {{ slug }}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div v-for="permission in permissions" :key="permission.id">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" :value="permission" v-model="role.permissions" :id="permission.name">
                                <label class="form-check-label" :for="permission.name">{{ permission.name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>

        <modal-delete id="roleDelete" title="¿Estás seguro de eliminar este Rol?">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal-delete>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Role from "../../../models/admin/Role";
    import Permission from "../../../models/admin/Permission";

    export default {
        components: {Paginator},

        data() {
            return {
                roles: [],
                role: {},
                permissions: [],
                pagination: {},
                errors: {},
            }
        },

        methods: {
            index(page = 1) {
                let params = {
                    page: page,
                    with: ['permissions']
                };

                Role.get(params, data =>{
                    this.roles = data.data;
                    this.pagination = data.meta;
                });

                Permission.get({}, data =>{
                    this.permissions = data.data;
                });
            },

            create() {
                this.role = {
                    permissions: []
                }
            },

            store() {
                Role.store(this.role, data => {
                    this.role = {};
                    this.index();
                    $('#roleCreate').modal('hide');
                }, errors => this.errors = errors);
            },

            edit(role) {
                this.role = _.clone(role);
            },

            update() {
                Role.update(this.role.id, this.role, data => {
                    this.role = {};
                    this.index();
                    $('#roleEdit').modal('hide');
                }, errors => this.errors = errors);
            },

            destroy() {
                Role.destroy(this.role.id, data => {
                    this.index();
                    $('#roleDelete').modal('hide');
                });
            }
        },

        created() {
            this.index();
        },

        computed: {
            slug() {
                return this.role.name = this.role.readable_name;
            }
        }
    }
</script>
