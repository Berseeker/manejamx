<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Vehículos de Afiliados</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Afiliado</th>
                                    <th>Fecha de Alta</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Versión</th>
                                    <th>Año</th>
                                    <th>Kilometraje</th>
                                    <th>Estado</th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="vehicle in vehicles" :key="vehicle.id">
                                <td>{{ vehicle.user ? vehicle.user.name : '' }}</td>
                                <td>{{ vehicle.created_at }}</td>
                                <td>{{ vehicle.brand ? vehicle.brand.name : '' }}</td>
                                <td>{{ vehicle.model ? vehicle.model.name : '' }}</td>
                                <td>{{ vehicle.version ? vehicle.version.name : '' }}</td>
                                <td>{{ vehicle.year }}</td>
                                <td>{{ vehicle.odometer }} kms</td>
                                <td>
                                    <span :class="getBadge(vehicle)" class="badge">
                                        {{ vehicle.status ? vehicle.status.name : '' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a v-tooltip="'Ver'" data-toggle="modal" data-target="#dlgView"
                                       class="btn btn-primary btn-sm" @click="show(vehicle)">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <span v-if="vehicle.in_process">
                                        <a v-tooltip="'Aprobar'" data-toggle="modal" data-target="#dlgApprove"
                                           class="btn btn-primary btn-sm" @click="show(vehicle)">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a v-tooltip="'Rechazar'" data-toggle="modal" data-target="#dlgReject"
                                           class="btn btn-danger btn-sm" @click="show(vehicle)">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <paginator :pagination="pagination" @changePage="index"></paginator>
                </div>
            </div>
        </div>

        <modal id="dlgView" title="Detalles del Afiliado" size="modal-lg" close="Cerrar">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <label>Afiliado</label>
                    <p>{{ edit.user ? edit.user.name : '' }}</p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Fecha de Alta</label>
                    <p>{{ edit.created_at }}</p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Marca</label>
                    <p>{{ edit.brand ? edit.brand.name : '' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <label>Modelo</label>
                    <p>{{ edit.model ? edit.model.name : '' }}</p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Versión</label>
                    <p>{{ edit.version ? edit.version.name : '' }}</p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Año</label>
                    <p>{{ edit.year }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <label>Kilometraje</label>
                    <p>{{ edit.odometer }} kms</p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Precio</label>
                    <p>{{ edit.sell_price | currency }}</p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Estado</label>
                    <p>
                        <span :class="getBadge(edit)" class="badge">
                            {{ edit.status ? edit.status.name : '' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <label>Color Interior</label>
                    <p>
                        <span v-for="color in edit.interior_colors" :key="color.id">
                            {{ color.name }}
                        </span>
                    </p>
                </div>

                <div class="col-md-4 col-xs-12">
                    <label>Color Exterior</label>
                    <p>
                        <span v-for="color in edit.exterior_colors" :key="color.id">
                            {{ color.name }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <img v-for="file in edit.files" :key="file.id" :src="file.show_url" class="img-fluid">
                </div>
            </div>
        </modal>

        <modal-delete id="dlgApprove" title="¿Estas Seguro de Aprobar este vehículo ?" close="No">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="approve">Si</button>
        </modal-delete>

        <modal-delete id="dlgReject" title="¿Estas Seguro de Rechazar este vehículo ?" close="No">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="reject">Si</button>
        </modal-delete>
    </div>
</template>

<script>
    import Approbation from "../../../models/admin/affiliates/Approbation";
    import Rejection from "../../../models/admin/affiliates/Rejection";
    import Paginator from "../../../components/Paginator";
    import Vehicle from "../../../models/admin/affiliates/Vehicle";
    import VehicleApprobation from "../../../models/admin/affiliates/VehicleApprobation";
    import VehicleRejection from "../../../models/admin/affiliates/VehicleRejection";

    export default {
        components: {Paginator},
        data() {
            return {
                vehicles: [],
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
                await Vehicle.get({page: page}, data => {
                    this.vehicles = data.data;
                    this.pagination = data.meta;
                });
            },

            show(element) {
                this.edit = _.clone(element);
            },

            async approve() {
                Vue.$toast.info('Aprobando.')

                await VehicleApprobation.store(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Vehículo ha sido aprobado correctamente.')
                    $('#dlgApprove').modal('hide');
                });
            },

            async reject() {
                Vue.$toast.info('Rechazando.')

                await VehicleRejection.store(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Vehículo ha sido rechazado correctamente.')
                    $('#dlgReject').modal('hide');
                });
            },

            getBadge(vehicle) {
                if(vehicle.is_approved) {
                    return 'badge-success';
                }

                if(vehicle.is_rejected) {
                    return 'badge-danger';
                }

                return 'badge-info';
            }
        }
    }
</script>
