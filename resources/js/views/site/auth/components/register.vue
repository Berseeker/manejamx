<template>
    <div>
        <form method="POST" v-on:submit.prevent="submit" action="">
            <div class="row justify-content-md-center my-2">
                <div class="col-md-8 text-center">
                    <h5>CREA TU CUENTA DE MANEJA</h5>
                    <p class="font-weight-lighter small">
                        Ya tienes una cuenta?
                        <a href="#!" @click="$emit('show', 'login')" class="btn btn-sm btn-link">Ingresa</a>
                    </p>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input v-model="user.name" type="text" class="form-control form-control-lg" :class="errors.name && errors.name[0] ? 'is-invalid' : ''" placeholder="Nombre" required autofocus>
                    <small v-if="errors.name" class="invalid-feedback" role="alert">{{ errors.name[0] }}</small>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input v-model="user.email" type="email" class="form-control form-control-lg" :class="errors.email && errors.email[0] ? 'is-invalid' : ''" placeholder="Email" required>
                    <small v-if="errors.email" class="invalid-feedback" role="alert">{{ errors.email[0] }}</small>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-4">
                    <input v-model="user.phone" type="text" class="form-control form-control-lg" :class="errors.phone && errors.phone[0] ? 'is-invalid' : ''" placeholder="Teléfono" required>
                    <small v-if="errors.phone" class="invalid-feedback" role="alert">{{ errors.phone[0] }}</small>
                </div>
                <div class="col-md-4">
                    <input v-model="user.zip_code" type="text" class="form-control form-control-lg" :class="errors.zip_code && errors.zip_code[0] ? 'is-invalid' : ''" placeholder="Cod. postal" required>
                    <small v-if="errors.zip_code" class="invalid-feedback" role="alert">{{ errors.zip_code[0] }}</small>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input v-model="user.password" type="password" class="form-control form-control-lg" :class="errors.password && errors.password[0] ? 'is-invalid' : ''" placeholder="Contraseña" required>
                    <small v-if="errors.password" class="invalid-feedback" role="alert">{{ errors.password[0] }}</small>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-8">
                    <input v-model="user.password_confirmation" type="password" class="form-control form-control-lg" :class="errors.password_confirmation && errors.password_confirmation[0] ? 'is-invalid' : ''" placeholder="Confirmar Contraseña" required>
                </div>
            </div>

            <div class="form-group row mb-4 justify-content-md-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        CREAR MI CUENTA
                    </button>
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
            Auth.register(this.user, data => {
                location.reload();
            }, errors => this.errors = errors);
        },
    }
}
</script>