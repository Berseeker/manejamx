<template>
    <a :href="'/autos/'+vehicle.slug" class="text-decoration-none">
        <div class="card card-vehicle h-100">
                <span v-if="vehicle.status && vehicle.status.id == 2" class="vehicle-alert" :class="{'text-success':vehicle.status.id == 1, 'text-danger':vehicle.status.id == 2 }">
                    <i v-if="vehicle.status.id == 1" class="fas  fa-star mr-1"></i>
                    <i v-if="vehicle.status.id == 2" class="fas fa-exclamation-circle mr-1"></i>
                    {{vehicle.status.name}}
                </span>
                <a href="#!" @click="toggleLike"><span class="fas fa-lg fa-heart" :class="liked"></span></a>
                <img v-if="vehicle.principal_images && vehicle.principal_images[0]" :src="vehicle.principal_images[0].show_url" class="card-img-top rounded-0" alt="">
                <img v-else src="/images/silluete.png" class="card-img-top rounded-0" alt="">
                <div class="card-body">
                    <div class="row">
                        <div class="col details">
                            <h5 class="card-title">{{ vehicle.year}} {{vehicle.brand ? vehicle.brand.name : ''}}</h5>
                            <h5 class="card-title">{{vehicle.model ? vehicle.model.name :''}}</h5>
                            <p class="card-text">{{ vehicle.version ? vehicle.version.name : '' }}</p>
                        </div>
                        <div class="col price text-right">
                            <h4 class="card-title">{{ vehicle.sell_price | currency}}</h4>
                            <!-- <p class="card-text text-theme-secondary">est. $502/mo</p>
                            <p class="card-text">$500 cash down</p> -->
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <p class="card-text">{{ vehicle.odometer}} kilometros</p>
                        </div>
                        <!-- <div class="col text-right">
                            <p class="card-text">Shipping: $599</p>
                        </div> -->
                    </div>
                </div>
        </div>
    </a>
</template>

<script>
import { getters, actions } from '../../../store.js';

export default {
    props:['vehicle'],

    methods: {

        ...actions,

        show(){
            window.location = 'cars/'+this.vehicle.id;
        },

        toggleLike() {
            this.toggleFavVehicle(this.vehicle.id)
        }
    },

    computed: {
        ...getters,

        liked() {

            if (this.favVehicles.find(favVehicle => favVehicle.id === this.vehicle.id)) {
                return 'liked'
            }

            return 'favorite'
        }
    }
}
</script>

<style>
    .liked {
        color: red
    }
</style>
