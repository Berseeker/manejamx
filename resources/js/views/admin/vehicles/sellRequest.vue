<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <h3 class=" mt-2">Peticiones de Ventas</h3>
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
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ingreso</th>
                                    <th>Cliente</th>
                                    <th>Vehículo</th>
                                    <th class="text-right">P. de venta</th>
                                    <th class="text-center">¿Respondido?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sell_request in sell_requests" :key="sell_request.id">
                                    <td>{{ sell_request.created_at}}</td>
                                    <td>
                                        <p class="mb-0">
                                            {{ sell_request.name}} {{ sell_request.last_name}}
                                        </p>
                                        <small>{{sell_request.email}}</small>
                                        <br>
                                        <small>{{sell_request.phone}}</small>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{sell_request.year}} {{sell_request.brand ? sell_request.brand.name : '' }} {{sell_request.model ? sell_request.model.name : '' }}</p>
                                        <small>{{sell_request.version ? sell_request.version.name : '' }}</small> 
                                        <br>
                                        <small>{{sell_request.odometer}} kilometros</small>
                                    </td>
                                    <td class="text-right">{{ sell_request.sell_price | currency}}</td>
                                    <td class="text-center"><span v-if="sell_request.answered" class="fas fa-check-circle text-success"></span></td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Detalles'"
                                            data-toggle="modal"
                                            data-target="#showSell"
                                            @click="edit = sell_request"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#editSell"
                                            @click="edit = sell_request"
                                            class="btn btn-primary btn-sm"
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

        <modal v-if="edit.id" id="showSell" title="Petición de cita" close="Salir" size="modal-lg">
            <dl class="row">
                <dt class="col-sm-3">Fecha de solicitud</dt>
                <dd class="col-sm-9">{{edit.created_at}}</dd>

                <dt class="col-sm-3">Cliente</dt>
                <dd class="col-sm-9">
                    <p>{{ edit.name }} {{ edit.last_name }}</p>

                </dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ edit.email }}</dd>

                <dt class="col-sm-3 text-truncate">Teléfono</dt>
                <dd class="col-sm-9">{{ edit.phone }}</dd>
                
                <dt class="col-sm-3 text-truncate">Respondido</dt>
                <dd class="col-sm-9"><span v-if="edit.answered" class="fas fa-check-circle text-success"></span></dd>

                <dt class="col-sm-3 text-truncate">Observaciones</dt>
                <dd class="col-sm-9">{{ edit.observations }}</dd>

                <dt class="col-sm-3">Vehículo</dt>
                <dd class="col-sm-9">
                    <p>{{ edit.year}} {{edit.brand ? edit.brand.name : ''}} {{edit.model ? edit.model.name :''}}</p>
                    <p>{{ edit.version ? edit.version.name : '' }}</p>
                    <p>{{ edit.odometer}} kilometros</p>
                    <p class="text-theme-secondary">{{ edit.sell_price | currency}} </p>
                </dd>
                <img v-if="edit.images && edit.images[0]" :src="edit.images[0].show_url" class="img-fluid" alt="">
            </dl>
            
        </modal>
        
        <modal id="editSell" title="Marcar Como Respondido" close="Cancelar" size="modal-lg">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observaciones</label>
                            <input type="text" class="form-control" v-model="edit.observations" placeholder="Nombre">
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
    import VehicleSellRequest from "../../../models/admin/VehicleSellRequest";

    export default {
        components: {Paginator},

        data() {
            return {
                sell_requests: [],
                filters      : {},
                edit         : {},
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
                    search: this.filters.search,
                };

                VehicleSellRequest.get(params, data => {
                    this.sell_requests     = data.data;
                    this.pagination = data.meta;
                })

            },

            update(){

                this.edit.answered = true;

                VehicleSellRequest.update(this.edit.id, this.edit, data => {
                    this.index();
                    this.edit = {};
                    this.$toast.clear();
                    this.$toast.success('Petición marcada como respondida.')
                    $('#editSell').modal('hide');

                },error => this.errors = errors)
            }

        },
    }
</script>
