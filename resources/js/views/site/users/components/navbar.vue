<template>
    <nav class="desktop-navbar d-sm-none d-md-block">
        <div class="account-container">
            <svg
                xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" class="navbar-avatar" data-qa="large-account">
                <g>
                    <g>
                        <g>
                            <path fill="none" stroke="#00aed9" stroke-miterlimit="50" stroke-width="2" d="M26 51c13.807 0 25-11.193 25-25S39.807 1 26 1 1 12.193 1 26s11.193 25 25 25z"></path>
                        </g>
                        <g>
                            <path fill="none" stroke="#00aed9" stroke-miterlimit="50" stroke-width="2" d="M26.25 25.182c4.004 0 7.25-3.175 7.25-7.091 0-3.916-3.246-7.091-7.25-7.091S19 14.175 19 18.09c0 3.917 3.246 7.092 7.25 7.092z"></path>
                        </g>
                        <g>
                            <path fill="none" stroke="#00aed9" stroke-miterlimit="50" stroke-width="2" d="M41 36.666c-.309-2.083-1.222-4.122-2.741-6.116-1.519-1.994-2.786-2.819-3.801-2.474-2.269 2.384-4.922 3.57-7.958 3.56-3.036.01-5.689-1.176-7.958-3.56-1.015-.345-2.282.48-3.801 2.474-1.519 1.994-2.432 4.033-2.741 6.116"></path>
                        </g>
                    </g>
                </g>
            </svg>
            <p class=" account-header">
                Hola <span> {{ firstName }}!</span> <br>
                <span v-if="is_affiliate">
                    {{ points }} Puntos <br>
                    <img v-if="level_image" :src="level_image" height="50">
                </span>
            </p>
        </div>
        <ul class="navigation-container">
            <a class="desktop-navigation-item" :class="{'activeTab' : active_tab == 0}" @click="changeTab(0)" href="#!">
                <li class="navigation-item-container">
                    <div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14" class="navigation-item-icon">
                            <g>
                                <path d="M12 11.638c0-2.342-1.77-4.285-4.085-4.543A3.707 3.707 0 0 0 6 .21a3.707 3.707 0 0 0-1.913 6.885C1.772 7.353 0 9.295 0 11.638v.13l.003.002A9.39 9.39 0 0 0 6 13.923a9.386 9.386 0 0 0 5.998-2.154H12z"></path>
                            </g>
                        </svg>
                    </div>
                    <p class="navigation-label">Detalles Personales</p>
                    <div v-if="active_tab == 0" class="triangle-tab"></div>
                </li>
            </a>
            <a class="desktop-navigation-item" :class="{'activeTab' : active_tab == 1}" @click="changeTab(1)" href="#!">
                <li class="navigation-item-container">
                    <div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg" width="13" height="16" viewBox="0 0 13 15" class="navigation-item-icon">
                            <g>
                                <path d="M10.28 6.067c.78 1.733 2.04.74 2.662 2.54.454 1.311-1.776 3.996-5.308 5.35-3.532 1.352-6.879.803-7.333-.51-.622-1.798.95-1.89.49-3.745C-.305 5.295-.522 3.446 1.836 1.449c.84-.713.136-1.173.957-1.488.822-.314.563.515 1.641.492C7.463.388 8.425 1.95 10.28 6.067m-3.034 6.78c3.152-1.207 4.718-3.462 4.593-3.822-.21-.608-2.22-1.121-5.823.26-3.603 1.382-4.809 3.2-4.62 3.744.11.316 2.699 1.026 5.85-.182m-1.008-2.93c.215-.083.424-.158.628-.227l.012.03c.301.87-.46 1.962-1.702 2.437-.975.373-1.953.254-2.475-.236.742-.65 1.888-1.373 3.537-2.005"></path>
                            </g>
                        </svg>
                    </div>
                    <p class="navigation-label">Notificaciones</p>
                    <div v-if="active_tab == 1" class="triangle-tab"></div>
                </li>
            </a>
            <a class="desktop-navigation-item" :class="{'activeTab' : active_tab == 2}" @click="changeTab(2)" href="#!">
                <li class="navigation-item-container">
                    <div>
                        <i class="fa fa-car-alt navigation-item-icon"></i>
                    </div>
                    <p class="navigation-label">Agregar Vehículo</p>
                    <div v-if="active_tab == 2" class="triangle-tab"></div>
                </li>
            </a>
            <a class="desktop-navigation-item" :class="{'activeTab' : active_tab == 3}" @click="changeTab(3)" href="#!">
                <li class="navigation-item-container">
                    <div>
                        <i class="fa fa-car navigation-item-icon"></i>
                    </div>
                    <p class="navigation-label">Mis Vehículos</p>
                    <div v-if="active_tab == 3" class="triangle-tab"></div>
                </li>
            </a>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['username', 'active_tab', 'points', 'level_image', 'is_affiliate'],

    methods: {
        changeTab(tab) {
            this.$emit('changeTab', tab)
        }
    },

    computed: {
        firstName() {
            return _.first( this.username.split(" ") )
        }
    }
}
</script>
