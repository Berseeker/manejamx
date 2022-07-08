<template>
    <div>
        <form method="POST" v-on:submit.prevent="submit" action="">
            <div class="row justify-content-md-center my-2">
                <div class="col-md-8 text-center">
                    <h5>HOLA, BIENVENIDO!</h5>
                    <p class="font-weight-lighter small">
                        No tienes una cuenta?
                        <a href="#!" @click="$emit('show', 'register')" class="btn btn-sm btn-link">Crear cuenta</a>
                    </p>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input v-model="user.email" type="email" class="form-control form-control-lg" :class="errors.email && errors.email[0] ? 'is-invalid' : ''" placeholder="Email" required autocomplete="email" autofocus>
                    <small v-if="errors.email" class="invalid-feedback" role="alert">{{ errors.email[0] }}</small>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input v-model="user.password" type="password" class="form-control form-control-lg" :class="errors.password && errors.password[0] ? 'is-invalid' : ''" placeholder="Contraseña" required autocomplete="current-password">
                    <small v-if="errors.password" class="invalid-feedback" role="alert">{{ errors.password[0] }}</small>
                </div>
            </div>

            <div class="form-group row mb-0 justify-content-md-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        INGRESAR
                    </button>

                    <p class="font-weight-lighter small text-center mt-2">
                        <a class="btn btn-link btn-sm" href="password/reset">
                            Te has olvidado la contraseña?
                        </a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

import Auth from "../../../../models/Auth";

export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            errors: {},
        }
    },

    methods: {
        submit() {
            Auth.login(this.user, data => {
                location.reload();
            }, errors => this.errors = errors);
        },
    }
}
</script>