<template>
    <div>
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="float-left mt-2">
                            Editar Publicación
                        </h3>
                        <a href="/admin/blog/posts" class="btn btn-link float-right">Regresar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Título</label>
                                    <input type="text" class="form-control" v-model="edit.title">
                                    <p class="text-danger" v-if="errors.title">{{ errors.title[0] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Imagen</label>
                                    <br>
                                    <input type="file" id="file_edit">
                                    <p class="text-danger" v-if="errors.file">{{ errors.file[0] }}</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Categorías</label>
                                    <v-select multiple label="value" :options="categories" v-model="edit.categories_value"></v-select>
                                    <p class="text-danger" v-if="errors.categories">{{ errors.categories[0] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Contenido</label>
                                    <vue-editor  v-model="edit.content"></vue-editor>
                                    <p class="text-danger" v-if="errors.content">{{ errors.content[0] }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a class="btn btn-link" href="/admin/blog/posts">
                            <i class="fa fa-chevron-left"></i> Regresar
                        </a>

                        <button type="button"  class="btn btn-primary float-right" @click="update">
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Post from "../../../../models/admin/blog/Post";
    import Category from '../../../../models/admin/blog/Category';

    import { VueEditor } from "vue2-editor";

    export default {
        components: {VueEditor},

        data(){
            return{
                categories: [],
                edit: {},
                loading: false,
                errors: {},
            }
        },

        props: ['post_id'],

        created(){
            this.loadData();
            this.show();
        },

        methods:{
            loadData(){
                Category.pluck(data => this.categories = data);
            },

            show(){
                this.errors = {};

                Post.show(this.post_id, data => {
                    this.edit = data;

                    this.edit.categories_value = [];
                    this.edit.categories.forEach(element => {
                        this.edit.categories_value.push({label: element.id, value: element.name});
                    })
                });
            },

            update() {

                let file = document.getElementById('file_edit').files[0];

                let formData = new FormData();
                formData.append('title', this.edit.title ? this.edit.title : '');
                formData.append('file', file ? file : '');
                formData.append('content', this.edit.content ? this.edit.content : '');

                this.edit.categories_value.forEach((element, key) => {
                    formData.append('categories[' + key + ']', element.label);
                });

                formData.append('_method', 'PUT');

                Post.update(this.edit.id, formData, data => {
                    Vue.$toast.clear();
                    Vue.$toast.success('El Post ha sido Actualizado con Éxito.');
                }, error => this.errors = error);
            },

        },
    }
</script>

