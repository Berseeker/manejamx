<template>
    <div>

        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Publicaciones</h3>
                        </div>
                       
                        <div class="col">
                            <div class="form-group">
                                <v-select
                                    multiple
                                    label="label"
                                    v-model="filter.category"
                                    :options="categories"
                                    placeholder="Categoría"
                                ></v-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="filter.search" placeholder="Título">
                            </div>
                        </div>
                        <div class="col-1">
                            <button  type="button" class="btn btn-outline-primary" @click="index">Filtrar</button>
                        </div>
                        <div class="col-1">
                            <a href="/admin/blog/posts/create"  class="btn btn-primary">Nuevo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Categoría</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts" :key="post.id">
                                    <td>{{ post.id }}</td>
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.author ? post.author.name : '' }}</td>
                                    <td>
                                        <span class="label label-info" style="margin-right: 5px"
                                            v-for="category in post.categories" :key="category.id">
                                            {{ category.name }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a
                                            :href="post.edit_url"
                                            v-tooltip="'Editar'"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a
                                            v-tooltip="'Eliminar'"
                                            data-toggle="modal"
                                            data-target="#postDelete"
                                            class="btn btn-danger btn-sm"
                                            @click="edit = post"
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
        
        <modal-delete id="postDelete" title="¿Estas seguro de Eliminar este Post?" :body="false" btnClose="No">
            <button slot="btnDelete" type="button" class="btn btn-danger" @click="destroy">Si</button>
        </modal-delete>

    </div>
</template>

<script>
    import Post from "../../../../models/admin/blog/Post";

    import Paginator from '../../../../components/Paginator';
    import vSelect from 'vue-select';
    import Category from '../../../../models/admin/blog/Category';

    export default {
        components: {Paginator, vSelect},

        data(){
            return{
                categories: [],
                posts: [],
                pagination: {},
                loading: false,
                errors: {},
                filter: {}
            }
        },

        created(){
            this.loadData();
            this.index();
        },

        methods: {
            loadData(){
                Category.pluck(data => this.categories = data);
            },
            index(page = 1){
                this.errors = {};
                this.loading = true;

                let params = {
                    page: page,
                    name: this.filter.name ? this.filter.name : '',
                    category_id: this.filter.category ? this.filter.category.label : null,
                };

                Post.get(params, data => {
                    this.posts = data.data;
                    this.pagination = data.meta;
                    this.loading = false;
                });
            },

            clear() {
                this.filter = {};
                this.index();
            },

            show(element){
                this.errors = {};

                Post.show(element, data => {
                    this.edit = data;
                });
            },

            destroy (){

                Post.delete(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Post ha sido Eliminado con Éxito.');
                    $('#dlgDelete').modal('hide');
                });
            }
        },
    }
</script>

