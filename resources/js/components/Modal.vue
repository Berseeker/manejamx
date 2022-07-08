<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" :data-backdrop="backdrop" :data-keyboard="keyboard">
        <div class="modal-dialog" :class="size" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :class="title_styles">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer" v-if="footer">
                    <button v-if="is_lockable" type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">{{ close }}</button>
                    <slot name="btnAdditional"></slot>
                    <slot name="btnSave"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String
            },

            id: {
                type: String
            },

            close: {
                type: String
            },

            size: {
                type: String
            },

            backdrop: {
                type: String,
                default: 'true'
            },

            keyboard: {
                type: String,
                default: 'true'
            },

            is_lockable: {
                type: Boolean,
                default: true
            },

            footer: {
                type: Boolean,
                default: true
            },

            title_styles: {
                type: String
            }
        },

        methods: {
            cancel() {
                this.$emit('cancel');
            }
        }
    }
</script>
