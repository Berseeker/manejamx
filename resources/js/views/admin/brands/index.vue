<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Marcas</h3>
                        </div>
                        <div class="col">
                            <div class="input-group mt-2">
                                <input type="text" v-model="filters.search" class="form-control" placeholder="Buscar" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button @click="index" class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo</th>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="brand in brands" :key="brand.id">
                                    <td>{{ brand.id }}</td>
                                    <td><img v-if="brand.logo" height="40" :src="brand.logo ? brand.logo.show_url :''" :alt="brand.name"></td>
                                    <td>{{ brand.name }}</td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#brandEdit"
                                            class="btn btn-primary btn-sm"
                                            @click="edit = brand"
                                        >
                                            <i class="fa fa-edit"></i>
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
        <modal id="brandEdit" title="Editar Marca" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" disabled class="form-control" v-model="edit.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control-file" id="file" placeholder="Logo">
                            <small v-if="errors.file" class=" text-danger">{{ errors.file[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Brand from "../../../models/admin/Brand";

    export default {
        components: {Paginator},

        data() {
            return {
                brands    : [],
                edit      : {},
                pagination: {},
                errors    : {},
                filters    : {},
            }
        },

        created() {
            this.index();
        },

        methods: {
            index(page = 1) {
                let params = {
                    page   : page,
                    search : this.filters.search
                };

                Brand.get(params, data =>{
                    this.brands     = data.data;
                    this.pagination = data.meta;
                });
            },

            update() {

                let formData = new FormData();
                let file = document.getElementById('file').files[0];

                formData.append('file', file ? file : '');
                formData.append('_method', 'PUT');

                Brand.update(this.edit.id, formData, data => {
                    this.edit = {};
                    this.index();
                     Vue.$toast.clear();
                    Vue.$toast.success('La marca ha sido editada correctamente.')
                    $('#brandEdit').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
