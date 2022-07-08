<template>
    <div v-show="show" class="create-filter-modal" >
        <div aria-hidden="true" tabindex="-1"></div>
        <div class="wrapper">
            <div class="header-container">
                <h5 class="main-title">CREAR ALERTA DE BÚSQUEDA</h5>
                <svg @click="close" class="close-button" viewBox="0 0 24 24" data-test="SvgIcon" data-qa="svg-icon" focusable="false" aria-hidden="true" tabindex="-1">
                    <g>
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                    </g>
                </svg>
            </div>
            <div class="create-container">
                <svg width="38" height="38" viewBox="0 0 54 54" fill="none"
                     xmlns="http://www.w3.org/2000/svg" data-test="NotifyIconBig" data-qa="notify-icon-big">
                    <path d="M14 23C14 15.8203 19.8203 10 27 10C34.1797 10 40 15.8203 40 23V35H14V23Z" stroke="#00619E" stroke-width="2"></path>
                    <path d="M34 29C34 29.5523 34.4477 30 35 30C35.5523 30 36 29.5523 36 29H34ZM30.4118 15.0887C29.9086 14.8613 29.3162 15.0849 29.0887 15.5882C28.8613 16.0914 29.0849 16.6838 29.5882 16.9113L30.4118 15.0887ZM34 23.4747V29H36V23.4747H34ZM29.5882 16.9113C32.2259 18.1034 34 20.6143 34 23.4747H36C36 19.7486 33.69 16.5703 30.4118 15.0887L29.5882 16.9113Z" fill="#00AED9"></path>
                    <path d="M30 10V8C30 6.34315 28.6569 5 27 5V5C25.3431 5 24 6.34315 24 8V10" stroke="#00619E" stroke-width="2"></path>
                    <path d="M24 45H30V46C30 47.6569 28.6569 49 27 49C25.3431 49 24 47.6569 24 46V45Z" stroke="#00619E" stroke-width="2"></path>
                    <path d="M44 41H10L10 40.8057C10.0001 38.3677 11.3491 36.1367 13.4924 35.0004H40.5294C42.6585 36.1227 44 38.3351 44 40.754V41Z" stroke="#00619E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M39.3622 9.98862L40.5 3.49994" stroke="#00AED9" stroke-width="2"></path>
                    <path d="M42.2184 13.2045L48.3117 9.03648" stroke="#00AED9" stroke-width="2"></path>
                    <path d="M43.636 17.0763L49.657 18.3831" stroke="#00AED9" stroke-width="2"></path>
                </svg>
                <h4 class="sub-title">Siéntate y relájate mientras</h4>
                <h3 class="third-title">Nosotros hacemos todo el trabajo</h3>
                <p class="main-text">¿Quiere ser el primero en saber cuándo tenemos un nuevo inventario? ¿Qué tal si el precio baja en ese vehículo que tiene en la mira? Te tenemos cubierto. Cree un nombre para su alerta y agregue su correo electrónico y nosotros hacemos el resto.</p>
                <form name="createAlert">
                    <div class="text-field">
                        <div class="input-container">
                            <div class="input-column">
                                <div class="input-wrapper">
                                    <input class="input" id="name" type="text" name="name" aria-labelledby="name" :class="{'is-populated' : create.name, 'input-is-invalid' : errors.name}" v-model="create.name">
                                    <label for="name" class="input-label">Nombre de la alerta</label>
                                    <svg v-if="errors.name" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                        <g>
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <small v-if="errors.name" class="error">{{ errors.name[0] }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="text-field" data-test="TextField" data-qa="text-field">
                        <div class="input-container">
                            <div class="input-column">
                                <div class="input-wrapper">
                                    <input class="input" id="email" type="email" name="email" aria-labelledby="email" :class="{'is-populated' : create.email, 'input-is-invalid' : errors.email}" v-model="create.email">
                                    <label for="email" class="input-label">Correo Electrónico</label>
                                    <svg v-if="errors.email" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                        <g>
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <small v-if="errors.email" class="error">{{ errors.email[0] }}</small>
                            </div>
                        </div>
                    </div>
                    <button @click.prevent="addNotification" type="submit" class="confir-button confirm-button" data-test="Button" data-qa="button">CREAR ALERTA</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Filter from "../../../../models/site/Filter";

export default {
    props: [
        'show',
        'filters',
        'brand',
        'models',
        'price_ranges',
        'year_ranges',
        'odometer_ranges',
        'accessory_types',
        'bodies',
        'fuels',
        'cylinders',
        'colors',
        'transmissions',
        'drives',
    ],

    data() {
        return {
            create: {
                filter_names: '',
                name: '',
                email: ''
            },
            errors: {}
        }
    },

    watch: {
        show: function(newVal, oldVal) {
            this.errors = {}

            this.filter_names = ''

            this.create.email = window.userEmail.content

            let filters = []

            if (newVal === true) {

                if (this.computedFilters.brand_id) {
                    filters.push(this.brand.name)
                }

                if (this.computedFilters.models.length > 0) {
                    this.models.forEach(model => {
                        if (model.active === true) {
                            filters.push(model.name)
                        }
                    })
                }

                if (this.price_ranges != this.computedFilters.price) {
                    filters.push('$' + this.computedFilters.price[0] + ' - $' + this.computedFilters.price[1])
                }

                if (this.year_ranges != this.computedFilters.year) {
                    filters.push('Año ' + this.computedFilters.year[0] + ' - ' + this.computedFilters.year[1])
                }

                if (this.odometer_ranges != this.computedFilters.odometer) {
                    filters.push('Kilometraje ' + this.computedFilters.odometer[0] + ' - ' + this.computedFilters.odometer[1])
                }

                if (this.computedFilters.accessories.length > 0) {
                    this.accessory_types.forEach(accessory_type => {
                        accessory_type.accessories.forEach(accessory => {
                            if (accessory.active === true) {
                                filters.push(accessory.name)
                            }
                        })

                    })
                }

                if (this.computedFilters.body_types.length > 0) {
                    this.bodies.forEach(body => {
                        if (body.active === true) {
                            filters.push(body.name)
                        }
                    })
                }

                if (this.computedFilters.fuels.length > 0) {
                    this.fuels.forEach(fuel => {
                        if (fuel.active === true) {
                            filters.push(fuel.name)
                        }
                    })
                }

                if (this.computedFilters.cylinders.length > 0) {
                    this.cylinders.forEach(cylinder => {
                        if (cylinder.active === true) {
                            filters.push('Cilindros ' + cylinder.name)
                        }
                    })
                }

                if (this.computedFilters.colors.length > 0) {
                    this.colors.forEach(color => {
                        if (color.active === true) {
                            filters.push('Color ' + color.name)
                        }
                    })
                }

                if (this.computedFilters.transmissions.length > 0) {
                    this.transmissions.forEach(transmission => {
                        if (transmission.active === true) {
                            filters.push('Transmisión ' + transmission.name)
                        }
                    })
                }

                if (this.computedFilters.drives.length > 0) {
                    this.drives.forEach(drive => {
                        if (drive.active === true) {
                            filters.push('Tracción ' + drive.name)
                        }
                    })
                }

                this.create.name =  filters.join(' | ')
                this.create.filter_names =  filters
            }
        }
    },

    computed: {
        computedFilters() {
            return {
                brand_id     : this.brand.hasOwnProperty('id') ?this.brand.id : null,
                models       : this.filters.models,
                price        : this.filters.price,
                year         : this.filters.year,
                odometer     : this.filters.odometer,
                body_types   : this.filters.body_types,
                accessories  : this.filters.accessories,
                fuels        : this.filters.fuels,
                cylinders    : this.filters.cylinders,
                colors       : this.filters.colors,
                transmissions: this.filters.transmissions,
                drives       : this.filters.drives,
            }
        }
    },

    methods: {
        close() {
            this.$emit('close')
        },

        addNotification() {
            this.errors = {}

            let parameters = {
                filters: this.computedFilters,
                filter_names: this.create.filter_names,
                name: this.create.name,
                email: this.create.email
            }

            Filter.store(parameters, data => {
                this.$store.savedFilters.push(data.data)
                this.$emit('close')
            }, errors => this.errors = errors)
        },
    }
}
</script>