<template>
    <div class="container">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 align-items-center align-content-center">
                        <h3 @click="removeFilter('all')" class="float-left pointer">Precios</h3>
                        <h5 @click="removeFilter('selectedMake')" class="float-left ml-4 mt-2 pointer">Marca: {{ selectedMake }}</h5>
                        <h5 @click="removeFilter('selectedModel')" class="float-left ml-4 mt-2 pointer">Modelo: {{ selectedModel }}</h5>
                        <h5 @click="removeFilter('selectedVersion')" class="float-left ml-4 mt-2 pointer">Versión: {{ selectedVersion === 'null' ? 'Sin versión' : selectedVersion }}</h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div v-for="(make, index) in makes" :key="index" class="col-md-3 my-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-center">{{ make.make }}</h5>
                                <h5 v-if="make.model" class="card-title text-center">{{ make.model }}</h5>
                                <h5 v-if="selectedModel !== null && selectedVersion === null" class="card-title text-center">{{ make.version ? make.version : 'Sin versión' }}</h5>
                                <h5 v-if="make.year" class="card-title text-center">{{ make.year }}</h5>

                                <p class="card-text">Precio mayor: {{ make.max_price | currency }}</p>
                                <p class="card-text">Precio promedio: {{ make.avg_price | currency }}</p>
                                <p class="card-text">Precio menor: {{ make.min_price | currency }}</p>
                                <p class="card-text">Kilometraje promedio: {{ numberWithCommas(make.avg_km) }}</p>

                                <a v-if="selectedMake === null" @click="setMake(make.make)" href="#" class="btn btn-primary">
                                    Modelos: {{ make.model_count }}
                                </a>
                                <a v-if="selectedMake !== null && selectedModel === null" @click="setModel(make.model)" href="#" class="btn btn-primary">
                                    Versiones: {{ make.version_count }}
                                </a>
                                <a v-if="selectedModel !== null && selectedVersion === null" @click="setVersion(make.version)" href="#" class="btn btn-primary">
                                    Años: {{ make.year_count }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <paginator :pagination="pagination" @changePage="index"></paginator>
            </div>
        </div>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import ExternalVehicle from "../../../models/admin/ExternalVehicle";

    export default {
        components: { Paginator },

        data() {
            return {
                pagination: {},
                errors: {},
                makes: [],
                selectedMake: null,
                selectedModel: null,
                selectedVersion: null,
            }
        },

        created() {
            this.index();
        },

        methods: {
             numberWithCommas(x) {
                 return parseInt(x).toLocaleString()
             },

            index(page = 1) {
                let params = {
                    page: page,
                    selectedMake: this.selectedMake,
                    selectedModel: this.selectedModel,
                    selectedVersion: this.selectedVersion,
                };

                ExternalVehicle.get(params, data => {
                    this.makes = data.data
                    this.pagination = data;
                })
            },

            setMake(make) {
                this.selectedMake = make
                this.index(1)
            },

            setModel(model) {
                this.selectedModel = model
                this.index(1)
            },

            setVersion(version) {
                this.selectedVersion = version
                if (version == '') {
                    this.selectedVersion = 'null'
                }
                this.index(1)
            },

            removeFilter(filter) {
                switch (filter) {
                    case 'all':
                        this.selectedMake = null;
                        this.selectedModel = null;
                        this.selectedVersion = null;
                        break;
                    case 'selectedMake':
                        this.selectedModel = null;
                        this.selectedVersion = null;
                        break;
                    case 'selectedModel':
                        this.selectedVersion = null;
                        break;
                }
                this.index(1)
            }
        },

        computed: {

        }
    }
</script>
