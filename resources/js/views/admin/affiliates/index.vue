<template>
    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class=" mt-2">Afiliados</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre Comercial</th>
                                    <th>RFC</th>
                                    <th>Dirección</th>
                                    <th>E-mail</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="affiliate in affiliates" :key="affiliate.id">
                                    <td>{{ affiliate.commercial_name }}</td>
                                    <td>{{ affiliate.rfc }}</td>
                                    <td>{{ affiliate.address }}</td>
                                    <td>{{ affiliate.email }}</td>
                                    <td>
                                        <span :class="getBadge(affiliate)" class="badge">
                                            {{ affiliate.status ? affiliate.status.name : '' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a v-tooltip="'Ver Detalles'" data-toggle="modal" data-target="#dlgView"
                                           class="btn btn-primary btn-sm" @click="show(affiliate)">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <span v-if="affiliate.in_process">
                                            <a v-tooltip="'Aprobar'" data-toggle="modal" data-target="#dlgApprove"
                                               class="btn btn-primary btn-sm" @click="show(affiliate)">
                                                <i class="fa fa-check"></i>
                                            </a>
                                            <a v-tooltip="'Rechazar'" data-toggle="modal" data-target="#dlgReject"
                                               class="btn btn-danger btn-sm" @click="show(affiliate)">
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
                    <label>Nombre Comercial</label>
                    <p class="help-text">{{ edit.commercial_name }}</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label>Razón Social</label>
                    <p class="help-text">{{ edit.business_name }}</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label>RFC</label>
                    <p class="help-text">{{ edit.rfc }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <label>Dirección</label>
                    <p class="help-text">{{ edit.address }}</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label>E-mail</label>
                    <p class="help-text">{{ edit.email }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <label>Nombre</label>
                    <p class="help-text">{{ edit.name }}</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label>Apellido</label>
                    <p class="help-text">{{ edit.last_name }}</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label>Teléfono</label>
                    <p class="help-text">{{ edit.phone }}</p>
                </div>
            </div>

            <h5 class="text-center">Documentos</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr v-for="file in edit.files" :key="file.id">
                            <td>{{ file.type ? file.type.name : '' }}</td>
                            <td class="text-center">
                                <a v-tooltip="'Ver'" class="btn btn-primary btn-sm" target="_blank" :href="file.show_url">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </modal>

        <modal-delete id="dlgApprove" title="¿Estas Seguro de Aprobar este afiliado ?" close="No">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="approve">Si</button>
        </modal-delete>

        <modal-delete id="dlgReject" title="¿Estas Seguro de Rechazar este afiliado ?" close="No">
            <button slot="btnDelete" type="button" class="btn btn-primary" @click="reject">Si</button>
        </modal-delete>
    </div>
</template>

<script>
    import Affiliate from "../../../models/admin/affiliates/Affiliate";
    import Approbation from "../../../models/admin/affiliates/Approbation";
    import Rejection from "../../../models/admin/affiliates/Rejection";
    import Paginator from "../../../components/Paginator";

    export default {
        components: {Paginator},
        data() {
            return {
                affiliates: [],
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
                await Affiliate.get({page: page}, data => {
                    this.affiliates = data.data;
                    this.pagination = data.meta;
                });
            },

            show(element) {
                this.edit = _.clone(element);
            },

            async approve() {
                Vue.$toast.info('Aprobando.')

                await Approbation.store(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Afiliado ha sido aprobado correctamente.')
                    $('#dlgApprove').modal('hide');
                });
            },

            async reject() {
                Vue.$toast.info('Rechazando.')

                await Rejection.store(this.edit.id, data => {
                    this.index();
                    Vue.$toast.clear();
                    Vue.$toast.success('El Afiliado ha sido rechazado correctamente.')
                    $('#dlgReject').modal('hide');
                });
            },

            getBadge(affiliate) {
                if(affiliate.is_approved) {
                    return 'badge-success';
                }

                if(affiliate.is_rejected) {
                    return 'badge-danger';
                }

                return 'badge-info';
            }
        }
    }
</script>
