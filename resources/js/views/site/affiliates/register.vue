<template>
    <div>
        <section class="bg-transparent">
            <div class="contact-form-wrapper">
                <div class="text-center">
                    <hr class="title mb-3">
                    <h2 class="title-1 text-primary font-weight-bold text-uppercase mb-5">Regístrate como Afiliado</h2>
                </div>

                <div class=" pt-4 bg-transparent">
                    <div class="container d-flex justify-content-center">
                        <form class="theme-form" @submit.prevent="store">
                            <div v-if="registered" class="alert alert-success mb-5" role="alert">
                                Te has convertido en afiliado ! Te contactaremos a la brevedad para acceder a vender tus vehículos
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="group">
                                            <input type="text" required v-model="form.commercial_name">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre Comercial</label>
                                            <p class="text-danger" v-if="errors.commercial_name">{{ errors.commercial_name[0] }}</p>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="group">
                                            <input type="text" required v-model="form.business_name">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Razón Social</label>
                                            <p class="text-danger" v-if="errors.business_name">{{ errors.business_name[0] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <input type="text" required v-model="form.rfc">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>RFC</label>
                                            <p class="text-danger" v-if="errors.rfc">{{ errors.rfc[0] }}</p>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <div class="group">
                                            <input type="text" required v-model="form.address">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Dirección</label>
                                            <p class="text-danger" v-if="errors.address">{{ errors.address[0] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <input type="text" required v-model="form.name">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                            <p class="text-danger" v-if="errors.name">{{ errors.name[0] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <input type="text" required v-model="form.last_name">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Apellido</label>
                                            <p class="text-danger" v-if="errors.last_name">{{ errors.last_name[0] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <vue-tel-input v-model="form.phone" mode="international" placeholder="Teléfono" required></vue-tel-input>
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <p class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <input type="email" required v-model="form.email">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>E-mail</label>
                                            <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <input type="password" required v-model="form.password">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Contraseña</label>
                                            <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="group">
                                            <input type="password" required v-model="form.password_confirmation">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Confirmar Contraseña</label>
                                            <p class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</p>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="text-center">Documentos</h5>

                                <div class="table table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="50%">Identificación oficial con fotografía</td>
                                                <td>
                                                    <input required type="file" id="identification">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Registro Federal de contribuyentes (RFC)</td>
                                                <td>
                                                    <input required type="file" id="rcf_photo">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Comprobante de domicilio (Dirección fiscal)</td>
                                                <td>
                                                    <input required type="file" id="address_voucher">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Acta Constitutiva (Personas morales)</td>
                                                <td>
                                                    <input type="file" id="constitutive_act">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Caratula bancaria (Clabe Interbancaria)</td>
                                                <td>
                                                    <input type="file" id="bank_cover">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary float-right" :disabled="registering">
                                        <template v-if="registering">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Enviando...
                                        </template>
                                        <template v-else>
                                            Enviar
                                        </template>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Affiliate from "../../../models/site/affiliates/Affiliate";

    export default {
        data() {
            return {
                form: {},
                errors: {},
                registering: false,
                registered: false,
            }
        },

        methods: {
            async store() {
                this.errors = {};

                const identification = document.getElementById('identification').files[0];
                const rcf_photo = document.getElementById('rcf_photo').files[0];
                const address_voucher = document.getElementById('address_voucher').files[0];
                const constitutive_act = document.getElementById('constitutive_act').files[0];
                const bank_cover = document.getElementById('bank_cover').files[0];

                const form = new FormData();
                form.append('commercial_name', this.form.commercial_name ? this.form.commercial_name : '');
                form.append('business_name', this.form.business_name ? this.form.business_name : '');
                form.append('rfc', this.form.rfc ? this.form.rfc : '');
                form.append('address', this.form.address ? this.form.address : '');
                form.append('name', this.form.name ? this.form.name : '');
                form.append('last_name', this.form.last_name ? this.form.last_name : '');
                form.append('phone', this.form.phone ? this.form.phone : '');
                form.append('email', this.form.email ? this.form.email : '');
                form.append('password', this.form.password ? this.form.password : '');
                form.append('password_confirmation', this.form.password_confirmation ? this.form.password_confirmation : '');
                form.append('identification', identification ? identification : '');
                form.append('rcf_photo', rcf_photo ? rcf_photo : '');
                form.append('address_voucher', address_voucher ? address_voucher : '');
                form.append('constitutive_act', constitutive_act ? constitutive_act : '');
                form.append('bank_cover', bank_cover ? bank_cover : '');

                await Affiliate.store(form, data => {
                    this.registered = true;
                    this.form = {};
                }, errors => this.errors = errors);
            }
        }
    }
</script>
