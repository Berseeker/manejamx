<template>
    <div>
        <form method="POST" v-on:submit.prevent="submit" action="">
            <div class="row justify-content-md-center my-2">
                <div class="col-md-8 text-center">
                    <h5>OLVIDASTE TU CONTRASEÑA?</h5>
                    <p class="font-weight-lighter small">
                        Por favor, ingresa tu email para resetear tu contraseña.
                    </p>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input id="email" v-model="user.email" type="email" class="form-control form-control-lg" :class="errors.email && errors.email[0] ? 'is-invalid' : ''" placeholder="Email" name="email" required autocomplete="email" autofocus>
                    <small v-if="errors.email" class="invalid-feedback" role="alert">{{ errors.email[0] }}</small>
                </div>
            </div>

            <div class="form-group row mb-0 justify-content-md-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        RESETEAR CONTRASEÑA
                    </button>

                    <p class="font-weight-lighter small text-center mt-2">
                        <a class="btn btn-link btn-sm" href="#!" @click="$emit('show', 'login')">
                            Ingresar con mi cuenta
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
            },
            errors: {},
        }
    },

    methods: {
        submit() {
            Auth.registerPassword(this.user, data => {
                location.reload();
            }, errors => this.errors = errors);
        },
    }
}
</script>