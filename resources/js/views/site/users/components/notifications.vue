<template>
    <div>
        <template>
            <div class="page-title">
                <div class="page-title-caption">Notificaciones</div>
            </div>
            <div class="tab-content notifications">
                <div class="notifications-header">
                    <div class="wrapper">
                        <div class="notifications-title">Notificaciones por Email</div>
                        <div data-qa="subtitle" class="notifications-subtitle">
                            {{ user.email }}
                            <a @click="changeSection('personal-details-edit')" href="#!" class="notifications-edit-link"> EDITAR</a>
                        </div>
                    </div>
                    <label :aria-checked="notifications" class="notifications-label">
                        <input type="checkbox" :value="notifications" @click="toggleNotifications">
                        <span  class="notifications-slider" :class="{'is-on' : notifications}"></span>
                    </label>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import User from "../../../../models/site/User";

export default {
    props: ['user'],

    data() {
        return {
            notifications: this.user.notifications,
        }
    },

    methods: {
        toggleNotifications() {
            this.notifications = !this.notifications
            User.toggleNotifications(this.user.id, data => {
                this.$emit('userUpdated', data.data)
                this.errors = {}
                this.$toast.clear();
                this.$toast.success(
                    data.data.notifications
                    ? 'Ahora recibirá notificaciones por correo electrónico.'
                    : 'Ya no recibirás notificaciones por correo electrónico.'
                )
            }, errors => this.errors = errors);
        },

        changeSection(section) {
            this.$emit('changeSection', section)
        },
    }
}
</script>

<style>
.notifications-label{
    position:relative;
    display:inline-block;
    width:44px;
    height:21px;
    border:1px solid rgb(217, 221, 233);
    border-radius:16px;
}
.notifications-label input{
    opacity:0;
    width:0px;
    height:0px;
}
.notifications-slider{
    position:absolute;
    cursor:pointer;
    inset:0px;
    background-color:rgb(170, 177, 199);
    transition:all 0.4s ease 0s;
    border-radius:34px;
}
.notifications-slider::before{
    position:absolute;
    content:"";
    top:-2px;
    left:-1px;
    height:23px;
    width:24px;
    border:1px solid rgb(217, 221, 233);
    background-color:rgb(255, 255, 255);
    box-shadow:rgba(25, 41, 61, 0.13) 0px 2px 3px;
    transition:all 0.4s ease 0s;
    border-radius:16px;
}
.notifications-slider.is-on{
    background-color:rgb(29, 208, 139);
}
.notifications-slider.is-on::before{
    transform:translateX(20px);
}
.notifications .notifications-header{
    display:flex;
    margin-bottom:36px;
}
.notifications .wrapper{
    flex:1 1 0%;
}
.notifications-title{
    font-size:18px;
    line-height:24px;
    font-weight:700;
    margin-bottom:9px;
    text-transform:uppercase;
}
.notifications-subtitle{
    font-size:16px;
    line-height:16px;
}
.notifications-edit-link{
    font-size:12px;
    line-height:12px;
    font-weight:700;
    color:rgb(0, 174, 217);
    text-transform:uppercase;
}
.notifications-edit-link:hover{
    color:rgb(1, 141, 192);
}
@media (min-width: 768px){
    .notifications .notifications-header{
        margin-bottom:40px;
    }
}
@media (min-width: 768px){
    .notifications-title{
        font-size:20px;
        line-height:24px;
        margin-bottom:10px;
    }
}
</style>

