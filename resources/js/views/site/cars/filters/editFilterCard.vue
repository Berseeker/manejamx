<template>
    <div>
        <p v-if="!showEditDialog" class="alert-name">{{ savedFilter.name }}</p>

        <div v-if="showEditDialog" class="text-field">
            <div class="input-container">
                <div class="input-column">
                    <div class="input-wrapper">
                        <input class="input" id="name" type="text" name="name" aria-labelledby="name" :class="{'is-populated' : edit.name, 'input-is-invalid' : errors.name}" v-model="edit.name">
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

        <div class="tags-container">
            <template v-for="(filters) in savedFilter.filter_names">
                <p class="tag">{{ filters }}</p>
            </template>
        </div>
        <div class="button-container">
            <div class="edit-container">
                <div class="button-wrapper">
                    <button @click="showDeleteDialog = true" class="base-button">
                        <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                             xmlns="http://www.w3.org/2000/svg" role="presentation" aria-hidden="true" tabindex="-1" disabled="disabled" clickable="false">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.06838 0.5C3.55797 0.5 3.14103 0.937477 3.14103 1.4813V2.71138H0.92735C0.416947 2.71138 0 3.14886 0 3.69268V5.46179C0 6.00561 0.416947 6.44309 0.92735 6.44309H1.04701V16.5187C1.04701 17.0625 1.46396 17.5 1.97436 17.5H12.0256C12.536 17.5 12.953 17.0625 12.953 16.5187V6.44309H13.0726C13.5831 6.44309 14 6.00561 14 5.46179V3.69268C14 3.14886 13.5831 2.71138 13.0726 2.71138H10.859V1.4813C10.859 0.937477 10.442 0.5 9.93162 0.5H4.06838ZM4.57697 2.71136V2.02031H9.42312V2.71136H4.57697ZM1.43588 4.92271V4.23165H12.5641V4.92271H1.43588ZM2.48287 15.9797V6.44312H4.188V13.4228C4.188 13.8445 4.51119 14.183 4.90595 14.183C5.3007 14.183 5.62389 13.8445 5.62389 13.4228V6.44312H6.28201V13.4228C6.28201 13.8445 6.60521 14.183 6.99996 14.183C7.39472 14.183 7.71791 13.8445 7.71791 13.4228V6.44312H8.37603V13.4228C8.37603 13.8445 8.69923 14.183 9.09398 14.183C9.48873 14.183 9.81193 13.8445 9.81193 13.4228V6.44312H11.5171V15.9797H2.48287Z" fill="#00AED9" role="presentation" aria-hidden="true" tabindex="-1"></path>
                        </svg>&nbsp;&nbsp;Eliminar
                    </button>
                </div>
                <div v-if="!showEditDialog" class="button-wrapper">
                    <button @click="showEditDialog = true" class="edit-button base-button">&nbsp;&nbsp;
                        <span class="edit-svg">
                            <svg viewBox="0 0 16 16" height="16" width="16"
                                 xmlns="http://www.w3.org/2000/svg" role="presentation" aria-hidden="true" tabindex="-1" disabled="disabled" clickable="false">
                                <g fill="currentColor" role="presentation" aria-hidden="true" tabindex="-1">
                                    <path d="M15.36 2.16L13.82.62a2.23 2.23 0 0 0-3.09 0l-9.8 9.82L0 16l5.55-.93 9.81-9.82a2.19 2.19 0 0 0 0-3.09zM2.72 10.81L9.8 3.73l2.46 2.46-7.07 7.08zm-.57 1.59l1.44 1.45-1.73.28zm12.13-8.24l-.94 1-2.46-2.52.94-.94a.65.65 0 0 1 .91 0l1.55 1.55a.63.63 0 0 1 0 .91z" role="presentation" aria-hidden="true" tabindex="-1"></path>
                                </g>
                            </svg>
                        </span>&nbsp;&nbsp;Editar
                    </button>
                </div>
            </div>
            <div>
                <button v-if="showEditDialog" @click="showEditDialog = false" type="button" class="cancel-button button">Cancelar</button>
                <button v-if="showEditDialog" @click="update" type="button" class="save-button button">Guardar</button>
            </div>
        </div>
        <div v-show="showDeleteDialog" class="delete-confirmation-container">
            <div>
                <p class="delete-confirmation-text">¿Eliminar esta Alerta?</p>
                <button @click="showDeleteDialog = false" type="button" class="delete-cancel-button button">No, Cancelar</button>
                <button @click="destroy" type="button" class="delete-confitm-button button">Si, Eliminar</button>
            </div>
        </div>
    </div>
</template>

<script>
import Filter from "../../../../models/site/Filter";

export default {

    props: ['savedFilter'],

    data () {
        return {
            showDeleteDialog: false,
            showEditDialog: false,
            edit: {
                name: this.savedFilter.name
            },
            errors: {}
        }
    },

    methods: {
        update() {
            this.errors = {}

            Filter.update(this.savedFilter.id, this.edit, data => {
                this.savedFilter.name = data.data.name
                this.showEditDialog = false
            }, errors => this.errors = errors);
        },

        destroy() {
            Filter.destroy(this.savedFilter.id, data => {

                this.showDeleteDialog = false

                let index = this.$store.savedFilters.findIndex(o => {
                    return o.id === this.savedFilter.id;
                })

                if (index !== -1) this.$store.savedFilters.splice(index, 1);

            }, errors => this.errors = errors);
        }
    }
}
</script>