<template>
    <modal id="authModal" :title="title" :title_styles="'w-100 text-center ml-4'" :size="'modal-dialog-centered modal-dialog-scrollable'" :footer="false">
        <template v-if="show === 'login'">
            <login @show="changeShow"></login>
        </template>
        <template v-if="show === 'register'">
            <register @show="changeShow"></register>
        </template>
        <template v-if="show === 'reset_password'">
            <reset-password @show="changeShow"></reset-password>
        </template>
    </modal>
</template>

<script>
import login from "./components/login";
import register from "./components/register";
import resetPassword from "./components/resetPassword";

export default {
    components: {
        login,
        register,
        resetPassword
    },

    data() {
        return {
            show: 'login'
        }
    },

    methods:{
        changeShow(show){
            this.show = show
        }
    },

    computed: {
        title() {
            switch (this.show) {
                case 'login':
                    return 'Ingresar'
                case 'register':
                    return 'Crear cuenta'
                case 'reset_password':
                    return 'Resetear contraseña'
            }
        }
    }
}
</script>