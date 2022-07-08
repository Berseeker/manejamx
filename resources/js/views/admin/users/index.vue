<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left mt-2">Usuarios</h3>
                            <a class="btn btn-icon-toggle float-right"
                               data-toggle="modal"
                               data-target="#userCreate"
                               @click="create"
                            >
                                <button class="btn btn-primary" id="menu-toggle">Nuevo</button>
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th style="width: 30px">Herramientas</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <span v-for="role in user.roles" :key="role.id"
                                              class="badge badge-primary mr-1"
                                        >
                                            {{ role.readable_name }}
                                        </span>
                                    </td>
                                    <td>
                                        <a
                                            data-toggle="modal"
                                            data-target="#userEdit"
                                            class="btn btn-primary btn-sm"
                                            @click="edit(user)"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a
                                            data-toggle="modal"
                                            data-target="#userDelete"
                                            @click="edit(user)"
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

        <modal id="userCreate" title="Nuevo Usuario" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="user.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="user.email" placeholder="Email">
                            <small v-if="errors.email" class=" text-danger">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" v-model="user.password" placeholder="Contraseña">
                            <small v-if="errors.password" class=" text-danger">{{ errors.password[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirmación</label>
                            <input type="password" class="form-control" v-model="user.password_confirmation" placeholder="Confirmación">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Roles</label>
                        <div v-for="role in roles" :key="role.id">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" :value="role" v-model="user.roles" :id="role.name">
                                <label class="form-check-label" :for="role.name">{{ role.readable_name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>

        <modal id="userEdit" title="Editar Usuario" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="user.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="user.email" placeholder="Email">
                            <small v-if="errors.email" class=" text-danger">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Roles</label>
                        <div v-for="role in roles" :key="role.id">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" :value="role" v-model="user.roles" :id="role.name">
                                <label class="form-check-label" :for="role.name">{{ role.readable_name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>

        <modal-delete id="userDelete" title="¿Estás seguro de eliminar este Usuario?">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal-delete>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import User from "../../../models/admin/User";
    import Role from "../../../models/admin/Role";

    export default {
        components: {Paginator},

        data() {
            return {
                users: [],
                user: {},
                roles: [],
                pagination: {},
                errors: {},
            }
        },

        methods: {
            index(page = 1) {
                let params = {
                    page: page,
                };

                Role.get(params, data =>{
                    this.roles = data.data;
                });

                User.get(params, data =>{
                    this.users = data.data;
                    this.pagination = data.meta;
                });
            },

            create() {
                this.user = {
                    roles: []
                }
            },

            store() {
                User.store(this.user, data => {
                    this.user = {};
                    this.index();
                    $('#userCreate').modal('hide');
                }, errors => this.errors = errors);
            },

            edit(user) {
                this.user = _.clone(user);
            },

            update() {
                User.update(this.user.id, this.user, data => {
                    this.user = {};
                    this.index();
                    $('#userEdit').modal('hide');
                }, errors => this.errors = errors);
            },

            destroy() {
                User.destroy(this.user.id, data => {
                    this.user = {};
                    this.index();
                    $('#userDelete').modal('hide');
                });
            }
        },

        created() {
            this.index();
        }
    }
</script>
