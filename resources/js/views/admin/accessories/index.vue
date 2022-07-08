<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Accesorios</h3>
                        </div>
                         <div class="col">
                            <div class="form-group mt-2">
                                <v-select
                                    label="value"
                                    v-model="filters.type"
                                    :options="types"
                                    placeholder="Tipo"
                                ></v-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mt-2">
                                <input type="text" class="form-control" v-model="filters.search" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-3 text-right">
                            <button  type="button" class="btn btn-primary" @click="index">Filtrar</button>
                            <button type="button" class="btn btn-icon-toggle"
                                data-toggle="modal"
                                data-target="#accesoryCreate"
                            >
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
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>TIpo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="accessory in accessories" :key="accessory.id">
                                    <td>{{ accessory.id }}</td>
                                    <td>{{ accessory.name }}</td>
                                    <td>{{ accessory.type ? accessory.type.name : ''  }}</td>
                                    <td class="text-right">
                                        <template v-if="!accessory.deleted_at">
                                            <a
                                                v-tooltip="'Editar'"
                                                data-toggle="modal"
                                                data-target="#accessoryEdit"
                                                class="btn btn-primary btn-sm"
                                                @click="show(accessory)"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a
                                                v-tooltip="'Eliminar'"
                                                data-toggle="modal"
                                                data-target="#accessoryDestroy"
                                                class="btn btn-danger btn-sm"
                                                @click="show(accessory)"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </template>
                                        <a
                                            v-if="accessory.deleted_at"
                                            v-tooltip="'Restaurar'"
                                            data-toggle="modal"
                                            data-target="#accessoryRestore"
                                            class="btn btn-success btn-sm"
                                            @click="show(accessory)"
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
        <modal id="accesoryCreate" title="Agregar Accesorio" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="create.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo</label>
                            <v-select label="value" :options="types" v-model="create.type" placeholder="Tipo de accesorio"></v-select>
                            <small v-if="errors.type_id" class=" text-danger">{{ errors.type_id[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="store">Guardar</button>
        </modal>
        <modal id="accessoryEdit" title="Editar Tipo de Accesorio" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" v-model="edit.name" placeholder="Nombre">
                            <small v-if="errors.name" class=" text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo</label>
                            <v-select label="value" :options="types" v-model="edit.type_value" placeholder="Tipo de accesorio"></v-select>
                            <small v-if="errors.type_id" class=" text-danger">{{ errors.type_id[0] }}</small>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="update">Guardar</button>
        </modal>
        <modal id="accessoryDestroy" title="¿Estas Seguro de Eliminar este Accesorio?" close="No" >
            <button slot="btnSave" type="button" class="btn btn-primary" @click="destroy">Si</button>
        </modal>
        <modal id="accessoryRestore" title="¿Estas Seguro de Restaurar este Accesorio?" close="No" >
            <button slot="btnSave" type="button" class="btn btn-primary" @click="restore">Si</button>
        </modal>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Accessory from "../../../models/admin/Accessory";
    import AccessoryType from "../../../models/admin/AccessoryType";

    export default {
        components: {Paginator},

        data() {
            return {
                types      : [],
                accessories: [],
                edit       : {},
                create     : {},
                pagination : {},
                errors     : {},
                filters    : {}
            }
        },

        created() {
            this.index();
            this.loadData();
        },

        methods: {
            loadData(){
                AccessoryType.pluck(data => this.types = data);
            },

            index(page = 1) {
                let params = {
                    page   : page,
                    search : this.filters.search,
                    type_id: this.filters.type ? this.filters.type.label : null,
                    with_trash:true
                };

                Accessory.get(params, data =>{
                    this.accessories = data.data;
                    this.pagination  = data.meta;
                });
            },

            show(element){
                this.edit = element;

                if(this.edit.type){
                    this.edit.type_value = {
                        label:this.edit.type.id,
                        value:this.edit.type.name
                    }
                }
            },

            store() {
                this.create.type_id = this.create.type ? this.create.type.label : null,

                Accessory.store(this.create, data => {
                    this.create = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Accesorio ha sido agregada correctamente.')
                    $('#accesoryCreate').modal('hide');
                }, errors => this.errors = errors);
            },

            update() {

                this.edit.type_id = this.edit.type_value ? this.edit.type_value.label : null,

                Accessory.update(this.edit.id, this.edit, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Accesorio ha sido editada correctamente.')
                    $('#typeEdit').modal('hide');
                }, errors => this.errors = errors);
            },

            destroy() {

                Accessory.destroy(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Accesorio ha sido eliminada correctamente.')
                    $('#accessoryDestroy').modal('hide');
                }, errors => this.errors = errors);
            },

            restore() {

                Accessory.restore(this.edit.id, data => {
                    this.edit = {};
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Accesorio ha sido restaurado correctamente.')
                    $('#accessoryRestore').modal('hide');
                }, errors => this.errors = errors);
            },
        }
    }
</script>
