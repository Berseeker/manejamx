<template>
    <div>
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link" href="#!" @click="show_modal = true">
                <div class="favorite-wrapper">
                    <div class="favorite-icon-wrapper">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 18" class="favorite-icon">
                            <g>
                                <path d="M20.2 1.48a5.82 5.82 0 0 0-7.75 0L11 2.82 9.55 1.48a5.82 5.82 0 0 0-7.75 0 5.39 5.39 0 0 0 0 8L11 18l9.2-8.48a5.39 5.39 0 0 0 0-8.04z"></path>
                            </g>
                        </svg>
                    </div>
                    <span class="favorite-counter">{{ favVehicles.length }}</span>
                </div>
            </a>
        </li>

        <transition name="slide-fade">
            <div v-show="show_modal" class="favorites-modal">
                <div @click="show_modal = false" class="drawer-backdrop"></div>
                <div class="drawer-wrapper">
                    <div class="favorites-container">
                        <header class="favorites-header">
                            <h4 class="favorites-header-title">
                                <div class="fav-wrapper">
                                    <div class="fav-icon">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 18" class="icon-wrapper">
                                            <g>
                                                <path d="M20.2 1.48a5.82 5.82 0 0 0-7.75 0L11 2.82 9.55 1.48a5.82 5.82 0 0 0-7.75 0 5.39 5.39 0 0 0 0 8L11 18l9.2-8.48a5.39 5.39 0 0 0 0-8.04z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="icon-counter">{{ favVehicles.length }}</span>
                                </div>Favoritos
                            </h4>
                            <div @click="show_modal = false" class="close-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" class="icon-wrapper">
                                    <g>
                                        <path d="M5.71,5,9.85.85a.48.48,0,0,0,0-.7.48.48,0,0,0-.7,0L5,4.29.85.15a.48.48,0,0,0-.7,0,.48.48,0,0,0,0,.7L4.29,5,.15,9.15a.48.48,0,0,0,0,.7A.47.47,0,0,0,.5,10a.47.47,0,0,0,.35-.15L5,5.71,9.15,9.85a.48.48,0,0,0,.7,0,.48.48,0,0,0,0-.7Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </header>
                        <section class="favorites-drawer">
                            <favorite-card
                                v-for="vehicle in favVehicles" :key="vehicle.id"
                                :vehicle="vehicle" @removeFromFavorites="removeFromFavorites"
                            >
                            </favorite-card>
                        </section>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import favoriteCard from './favoriteCard';
import { getters, actions } from '../../../store.js';

export default {
    components: {
        favoriteCard
    },

    data() {
        return {
            show_modal: false
        }
    },

    created() {
        this.index()
    },

    computed: {
        ...getters
    },

    methods: {
        ...actions,

        index(){
            this.getFavVehicles()
        },

        removeFromFavorites(vehicle_id) {
            this.removeFavVehicle(vehicle_id)
        }
    }
}
</script>


<style>
.slide-fade-enter-active {
    transition: all .3s ease;
}
.slide-fade-leave-active {
    transition: all .3s ease;
}
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
</style>