<template>
    <div>
        <template v-if="active_section == 'personal-details-info'">
            <div class="page-title">
                <div class="page-title-caption">Detalles Personales</div>
            </div>
            <div class="tab-content">
                <div class="tab-section">
                    <div class="heading">
                        <h3  class="title">Información Personal</h3>
                        <div class="edit-button">
                            <span class="icon">
                                <svg viewBox="0 0 16 16" height="25" width="25"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g fill="currentColor">
                                        <path d="M15.36 2.16L13.82.62a2.23 2.23 0 0 0-3.09 0l-9.8 9.82L0 16l5.55-.93 9.81-9.82a2.19 2.19 0 0 0 0-3.09zM2.72 10.81L9.8 3.73l2.46 2.46-7.07 7.08zm-.57 1.59l1.44 1.45-1.73.28zm12.13-8.24l-.94 1-2.46-2.52.94-.94a.65.65 0 0 1 .91 0l1.55 1.55a.63.63 0 0 1 0 .91z"></path>
                                    </g>
                                </svg>
                            </span>
                            <span class="text" @click="changeSection('personal-details-edit')">EDITAR</span>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Nombre</div>
                        <div class="value">{{ user.name }}</div>
                    </div>
                    <div class="field">
                        <div class="label">Email</div>
                        <div class="value">{{  user.email }}</div>
                    </div>
                    <div class="field">
                        <div class="label">Teléfono</div>
                        <div class="value">{{ user.phone }}</div>
                    </div>
                    <div class="field" v-if="is_affiliate">
                        <div class="label">URL Afiliado</div>
                        <div class="value">
                            <a :href="affiliate_url">{{ affiliate_url }}</a>
                        </div>
                    </div>
                </div>
                <div class="tab-section">
                    <div class="heading">
                        <h3 class="title">Seguridad</h3>
                        <div class="edit-button">
                    <span class="icon">
                        <svg viewBox="0 0 16 16" height="25" width="25"
                             xmlns="http://www.w3.org/2000/svg">
                            <g fill="currentColor">
                                <path d="M15.36 2.16L13.82.62a2.23 2.23 0 0 0-3.09 0l-9.8 9.82L0 16l5.55-.93 9.81-9.82a2.19 2.19 0 0 0 0-3.09zM2.72 10.81L9.8 3.73l2.46 2.46-7.07 7.08zm-.57 1.59l1.44 1.45-1.73.28zm12.13-8.24l-.94 1-2.46-2.52.94-.94a.65.65 0 0 1 .91 0l1.55 1.55a.63.63 0 0 1 0 .91z"></path>
                            </g>
                        </svg>
                    </span>
                            <span class="text" @click="changeSection('personal-password-edit')">EDITAR</span>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Contraseña</div>
                        <div class="value">•••••••••</div>
                    </div>
                </div>
            </div>
        </template>

        <template v-if="active_section == 'personal-details-edit'">
            <div class="page-title">
                <div class="page-title-caption">Editar Información Personal</div>
            </div>
            <div class="tab-content">
                <form class="form" v-on:submit.prevent="">

                    <div class="input-container mb-4">
                        <div class="input-column">
                            <div class="input-wrapper">
                                <input class="input" id="name" type="text" name="name" aria-labelledby="name" :class="{'is-populated' : edit.name, 'input-is-invalid' : errors.name}" v-model="edit.name">
                                <label for="name" class="input-label">Nombre</label>

                                <svg v-if="errors.name" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </g>
                                </svg>
<!--                                <svg v-else class=" input-status-icon" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                    </g>
                                </svg>-->
                            </div>
                            <small v-if="errors.name" class="error">{{ errors.name[0] }}</small>
                        </div>
                    </div>

                    <div class="input-container mb-4">
                        <div class="input-column">
                            <div class="input-wrapper">
                                <input class="input" id="email" type="text" name="email" aria-labelledby="email" :class="{'is-populated' : edit.email, 'input-is-invalid' : errors.email}" v-model="edit.email">
                                <label for="email" class="input-label">Email</label>

                                <svg v-if="errors.email" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </g>
                                </svg>
<!--                                <svg v-else class=" input-status-icon" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                    </g>
                                </svg>-->
                            </div>
                            <small v-if="errors.email" class="error">{{ errors.email[0] }}</small>
                        </div>
                    </div>

                    <div class="input-container mb-4">
                        <div class="input-column">
                            <div class="input-wrapper">
                                <input class="input" id="phone" type="text" name="phone" aria-labelledby="phone" :class="{'is-populated' : edit.phone, 'input-is-invalid' : errors.phone}" v-model="edit.phone">
                                <label for="phone" class="input-label">Teléfono</label>

                                <svg v-if="errors.phone" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </g>
                                </svg>
<!--                                <svg v-else class=" input-status-icon" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                    </g>
                                </svg>-->
                            </div>
                            <small v-if="errors.phone" class="error">{{ errors.phone[0] }}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <button v-on:click.prevent="" @click="changeSection('personal-details-info')" class="btn btn-outline-info btn-block cancel-button">CANCELAR</button>
                                </div>
                                <div class="col-6">
                                    <button @click="updatePersonalInfo" class="btn btn-outline-info btn-block confirm-button">GUARDAR CAMBIOS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </template>

        <template v-if="active_section == 'personal-password-edit'">
            <div class="page-title">
                <div class="page-title-caption">Editar Contraseña</div>
            </div>
            <div class="tab-content">

                <form class="form" v-on:submit.prevent="">

                    <div class="input-container mb-4">
                        <div class="input-column">
                            <div class="input-wrapper">
                                <input class="input" id="current_password" type="password" name="current_password" aria-labelledby="current_password" :class="{'is-populated' : edit.current_password, 'input-is-invalid' : errors.current_password}" v-model="edit.current_password">
                                <label for="current_password" class="input-label">Contraseña actual</label>
                                <svg v-if="errors.current_password" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </g>
                                </svg>
<!--                                <svg v-else class=" input-status-icon" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                    </g>
                                </svg>-->
                            </div>
                            <small v-if="errors.current_password" class="error">{{ errors.current_password[0] }}</small>
                        </div>
                    </div>

                    <div class="input-container mb-4">
                        <div class="input-column">
                            <div class="input-wrapper">
                                <input class="input" id="password" type="password" name="password" aria-labelledby="password" :class="{'is-populated' : edit.password, 'input-is-invalid' : errors.password}" v-model="edit.password">
                                <label for="password" class="input-label">Nueva Contraseña</label>
                                <svg v-if="errors.password" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </g>
                                </svg>
<!--                                <svg v-else class=" input-status-icon" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                    </g>
                                </svg>-->
                            </div>
                            <small v-if="errors.password" class="error">{{ errors.password[0] }}</small>
                        </div>
                    </div>

                    <div class="input-container mb-4">
                        <div class="input-column">
                            <div class="input-wrapper">
                                <input class="input" id="password_confirmation" type="password" name="password_confirmation" aria-labelledby="password_confirmation" :class="{'is-populated' : edit.password_confirmation, 'input-is-invalid' : errors.password_confirmation}" v-model="edit.password_confirmation">
                                <label for="password_confirmation" class="input-label">Confirmar Nueva Contraseña</label>
                                <svg v-if="errors.password_confirmation" class="input-status-icon input-status-icon-is-invalid" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </g>
                                </svg>
<!--                                <svg v-else class=" input-status-icon" focusable="false" viewBox="0 0 22 22" aria-hidden="true">
                                    <g>
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                    </g>
                                </svg>-->
                            </div>
                            <small v-if="errors.password_confirmation" class="error">{{ errors.password_confirmation[0] }}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <button v-on:click.prevent="" @click="changeSection('personal-details-info')" class="btn btn-outline-info btn-block cancel-button">CANCELAR</button>
                                </div>
                                <div class="col-6">
                                    <button @click="updatePassword" class="btn btn-outline-info btn-block confirm-button">GUARDAR CAMBIOS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </template>
    </div>
</template>

<script>
import User from "../../../../models/site/User";

export default {
    props: ['user', 'active_section', 'is_affiliate', 'affiliate_url'],

    data() {
        return {
            edit: {},
            errors: {}
        }
    },

    created() {
        this.edit = _.clone(this.user)
    },

    methods: {
        changeSection(section) {
            this.edit = _.clone(this.user)
            this.$emit('changeSection', section)
        },

        updatePersonalInfo() {
            let parameters = {
                name: this.edit.name,
                email: this.edit.email,
                phone: this.edit.phone
            }

            User.updatePersonalDetails(this.user.id, parameters, data => {
                this.$emit('userUpdated', data.data)
                this.errors = {}
                this.$toast.clear();
                this.$toast.success('Información editada correctamente.')
                this.changeSection('personal-details-info')
            }, errors => this.errors = errors);
        },

        updatePassword() {
            let parameters = {
                current_password: this.edit.current_password,
                password: this.edit.password,
                password_confirmation: this.edit.password_confirmation
            }

            User.updatePassword(this.user.id, parameters, data => {
                this.$emit('userUpdated', data.data)
                this.errors = {}
                this.$toast.clear();
                this.$toast.success('Información editada correctamente.')
                this.changeSection('personal-details-info')
            }, errors => this.errors = errors);
        },
    }
}
</script>

<style>
.form {
    width:480px;
}

.form .btn {
    display: flex;
    height: 56px;
    border-radius: 3px;
    flex: 1 1 0%;
    border: 1px solid rgb(0, 174, 217);
    background-color: rgb(255, 255, 255);
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    color: rgb(0, 174, 217);
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    text-transform: uppercase;
    cursor: pointer;
}

.form .btn.cancel-button:hover {
    border: 1px solid rgb(1, 141, 192);
    color: rgb(1, 141, 192);
}

.form .btn.confirm-button {
    background-color: rgb(0, 174, 217) !important;
    color: rgb(255, 255, 255) !important;
}

.form .confirm-button:hover {
    background-color: rgb(1, 141, 192) !important;
}
</style>
