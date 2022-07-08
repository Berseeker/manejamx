<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Categorías</h3>
                        </div>
                        <div class="col">
                            <div class="input-group mt-2 pr-3">
                                <input type="text" v-model="filter.search" class="form-control" placeholder="Buscar" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button @click="index" class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <a class="btn btn-icon-toggle float-right"
                                data-toggle="modal"
                                data-target="#categoryCreate"
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
                                <tr v-for="category in categories" :key="category.id">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#categoryEdit"
                                            class="btn btn-primary btn-sm"
                                            @click="edit = category"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#categoryDelete"
                                            class="btn btn-danger btn-sm"
                                            @click="edit = category"
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
        <modal id="categoryCreate" title="Agregar Categoría" close="Cancelar" size="modal-lg">
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
        <modal id="categoryEdit" title="Editar Categoría" close="Cancelar" size="modal-lg">
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
        
        <modal-delete id="categoryDelete" title="¿Estás seguro de eliminar esta categoría?">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal-delete>
        
    </div>
</template>

<script>
    import Category from '../../../models/admin/blog/Category';

    import Paginator from '../../../components/Paginator';

    export default {
        components: {Paginator},

        data(){
            return{
                categories: [],
                create: {},
                edit: {},
                pagination: {},
                loading: false,
                errors: {},
                filter: {}
            }
        },

        created(){
            this.index();
        },

        methods: {
            index(page = 1){
                this.errors = {};
                this.loading = true;

                let params = {
                    page: page,
                    name: this.filter.name ? this.filter.name : ''
                };

                Category.get(params, data => {
                    this.categories = data.data;
                    this.pagination = data.meta;
                    this.loading = false;
                });
            },

            show(element){
                this.edit = element;
            },

            store(){

                Category.store(this.create, data => {
                    this.create = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Categoría ha sido Almacenada.');
                    $('#categoryCreate').modal('hide');
                }, error => this.errors = error);
            },

            update(){

                Category.update(this.edit.id, this.edit, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Categoría ha sido Actualizada.');
                    $('#categoryEdit').modal('hide');
                }, error => this.errors = error);
            },

            destroy (){

                Category.delete(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('La Categoría ha sido Eliminada.');
                    $('#categoryDelete').modal('hide');
                });
            }
        }
    }
</script>

