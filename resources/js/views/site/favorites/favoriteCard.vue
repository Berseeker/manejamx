<template>
    <div class="result-tile">
        <a :href="'/autos/'+vehicle.id" class="result-click-arear" role="button" tabindex="0">
            <div class="image-wrapper">
                <img v-if="vehicle.three_sixty_images && vehicle.three_sixty_images[0]" :src="vehicle.three_sixty_images[0].show_url" class=" vehicle-image">
                <img v-else src="/images/silluete.png" class=" vehicle-image">
            </div>
            <div class="title-wrapper">
                <div class="left-section">
                    <span property="name">
                        <h3 class="vehicle-brand">{{ vehicle.year }} {{ vehicle.brand.name }}</h3>
                        <span class="vehicle-model">{{ vehicle.model.brand_name }}</span>
                        <h4 class="vehicle-type">{{ vehicle.body_type.name }}</h4>
                    </span>
                    <h4 class="vehicle-miles">{{ vehicle.odometer }} kilómetros</h4>
                </div>
                <div class="right-section">
                    <h4 class="vehicle-price">
                        <span class="dollar-sign">$</span>
                        <span>{{ vehicle.sell_price }}</span>
                    </h4>
                </div>
            </div>
        </a>
        <button @click="remove_overlay = true" class="remove-favorite-button">
            <svg viewBox="0 0 25 25" class="remove-favorite-icon" role="presentation" aria-hidden="true" tabindex="-1" disabled="disabled" clickable="false">
                <path id="close-x-10x10-dark" d="M5.71,5,9.85.85a.48.48,0,0,0,0-.7.48.48,0,0,0-.7,0L5,4.29.85.15a.48.48,0,0,0-.7,0,.48.48,0,0,0,0,.7L4.29,5,.15,9.15a.48.48,0,0,0,0,.7A.47.47,0,0,0,.5,10a.47.47,0,0,0,.35-.15L5,5.71,9.15,9.85a.48.48,0,0,0,.7,0,.48.48,0,0,0,0-.7Z" role="presentation" aria-hidden="true" tabindex="-1"></path>
            </svg>
        </button>
        <div v-show="remove_overlay" class="remove-favorite-overlay">
            <p class="remove-favorite-text">Quieres eliminar este vehiculo de tus favoritos?</p>
            <button @click="removeFromFavorites" class="remove-favorite-confirm">Si, Eliminar</button>
            <p @click="remove_overlay = false" class="remove-favorite-cancel">NO, LO QUIERO MANTENER</p>
        </div>
    </div>
</template>

<script>

export default {
    props: ['vehicle'],

    data() {
        return {
            remove_overlay: false
        }
    },

    methods: {
        removeFromFavorites() {
            return this.$emit('removeFromFavorites', this.vehicle.id)
        }
    }
}
</script>