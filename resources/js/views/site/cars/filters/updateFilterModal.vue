<template>
    <div v-show="show" class="update-filter-modal">
        <div aria-hidden="true" tabindex="-1"></div>
        <div class="update-wrapper">
            <div class="header-container">
                <h5 class="modal-title">Administrar las Alertas de Búsqueda</h5>
                <svg @click="close" class="close-button" viewBox="0 0 24 24" focusable="false" aria-hidden="true" tabindex="-1">
                    <g>
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                    </g>
                </svg>
            </div>
            <div class="create-container">
                <h4 class="sub-title" role="heading" aria-level="2"> Gestiona tus Alertas</h4>
                <p class="main-text">Actualmente, le enviamos correos electrónicos para obtener un nuevo inventario o rebajas de precios según una búsqueda que haya guardado con estos parámetros de filtro.</p>

                <div v-for="savedFilter in $store.savedFilters" :key="savedFilter.id" class="data-search data-search">
                    <edit-filter-card :savedFilter="savedFilter"></edit-filter-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import editFilterCard from "./editFilterCard";
import Filter from "../../../../models/site/Filter";

export default {
    props : ['show'],

    components: {editFilterCard},

    data() {
        return {
        }
    },

    created() {
        this.index()
    },

    methods: {
        async index() {
            if (this.userLoggedIn()) {
                Filter.get(data => {
                    this.$store.savedFilters = data.data
                })
            }
        },

        userLoggedIn() {
            return window.userLoggedIn.content
        },

        close() {
            this.$emit('close')
        }
    }
}
</script>