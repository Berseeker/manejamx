<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <h3 class=" mt-2">Peticiones de Citas</h3>
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
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th class="text-center">¿Respondido?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="quote in quotes" :key="quote.id">
                                    <td>{{ quote.created_at}}</td>
                                    <td>{{ quote.name}} {{ quote.last_name}}</td>
                                    <td>{{ quote.email}}</td>
                                    <td>{{ quote.phone}}</td>
                                    <td>{{ quote.date}}</td>
                                    <td>{{ quote.time}}</td>
                                    <td class="text-center"><span v-if="quote.answered" class="fas fa-check-circle text-success"></span></td>
                                    <td class="text-right">
                                        <a
                                            v-tooltip="'Detalles'"
                                            data-toggle="modal"
                                            data-target="#showQuote"
                                            @click="edit = quote"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a
                                            v-tooltip="'Editar'"
                                            data-toggle="modal"
                                            data-target="#editQuote"
                                            @click="edit = quote"
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

        <modal v-if="edit.id" id="showQuote" title="Petición de cita" close="Salir" size="modal-lg">
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

                <dt class="col-sm-3 text-truncate">Mensaje</dt>
                <dd class="col-sm-9">{{ edit.description }}</dd>
                
                <dt class="col-sm-3 text-truncate">Respondido</dt>
                <dd class="col-sm-9"><span v-if="edit.answered" class="fas fa-check-circle text-success"></span></dd>

                <dt class="col-sm-3 text-truncate">Observaciones</dt>
                <dd class="col-sm-9">{{ edit.observations }}</dd>

                <dt class="col-sm-3">Vehículo</dt>
                <dd class="col-sm-9">
                    <p><a :href="'/autos/'+edit.vehicle.id">{{ edit.vehicle.year}} {{edit.vehicle.brand ? edit.vehicle.brand.name : ''}} {{edit.vehicle.model ? edit.vehicle.model.name :''}}</a></p>
                    <p>{{ edit.vehicle.version ? edit.vehicle.version.name : '' }}</p>
                    <p>{{ edit.vehicle.odometer}} kilometros</p>
                    <p class="text-theme-secondary">{{ edit.vehicle.price | currency}} </p>
                </dd>
                <img v-if="edit.vehicle.three_sixty_images && edit.vehicle.three_sixty_images[0]" :src="edit.vehicle.three_sixty_images[0].show_url" class="img-fluid" alt="">
            </dl>
            
        </modal>
        
        <modal id="editQuote" title="Marcar Como Respondido" close="Cancelar" size="modal-lg">
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
    import VehicleQuoteRequest from "../../../models/admin/VehicleQuoteRequest";

    export default {
        components: {Paginator},

        data() {
            return {
                quotes    : [],
                filters   : {},
                edit      : {},
                pagination: {},
                errors    : {},
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

                VehicleQuoteRequest.get(params, data => {
                    this.quotes     = data.data;
                    this.pagination = data.meta;
                })

            },

            update(){

                this.edit.answered = true;

                VehicleQuoteRequest.update(this.edit.id, this.edit, data => {
                    this.index();
                    this.edit = {};
                    this.$toast.clear();
                    this.$toast.success('Cita marcada como respondida.')
                    $('#editQuote').modal('hide');

                },error => this.errors = errors)
            }

        },
    }
</script>
