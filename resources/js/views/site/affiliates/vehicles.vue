<template>
    <div>
        <div class="page-title">
            <div class="page-title-caption">Mis Vehículos</div>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Versión</th>
                            <th>Año</th>
                            <th>Kilometraje</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="vehicle in vehicles" :key="vehicle.id">
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
                        </tr>
                    </tbody>
                </table>
            </div>

            <paginator :pagination="pagination" @changePage="index"></paginator>
        </div>
    </div>
</template>

<script>
    import Vehicle from "../../../models/site/affiliates/Vehicle";

    import Paginator from "../../../components/Paginator";

    export default {
        components: {Paginator},

        data() {
            return {
                vehicles: [],
                pagination: {},
            }
        },

        created() {
            this.index();
        },

        methods: {
            async index() {
                await Vehicle.get(data => {
                    this.vehicles = data.data;
                    this.pagination = data.meta;
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
