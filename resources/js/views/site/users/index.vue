<template>
    <main class="site-account">
        <navbar
            :username="user.name"
            :is_affiliate="is_affiliate"
            :points="points"
            :level_image="level_image"
            :active_tab="activeTab"
            @changeTab="changeTab"></navbar>

        <section v-if="activeTab == 0">
            <personal-details
                :user="user"
                :is_affiliate="is_affiliate"
                :affiliate_url="affiliate_url"
                :active_section="activeSection"
                @changeSection="changeSection"
                @userUpdated="refreshUser"
            >
            </personal-details>
        </section>

        <section v-if="activeTab == 1">
            <notifications
                :user="user"
                @changeSection="changeSection"
                @userUpdated="refreshUser"
            >
            </notifications>
        </section>

        <section v-if="activeTab == 2">
            <affiliate-store-vehicles></affiliate-store-vehicles>
        </section>

        <section v-if="activeTab == 3">
            <affiliate-vehicles></affiliate-vehicles>
        </section>
    </main>
</template>

<script>
import navbar from './components/navbar';
import personalDetails from './components/personalDetails'
import notifications from "./components/notifications";

export default {
    props: ['user', 'is_affiliate', 'points', 'level_image', 'affiliate_url'],

    components: {
        navbar,
        personalDetails,
        notifications
    },

    data() {
        return {
            activeTab: 0,
            activeSection: 'personal-details-info',
        }
    },

    methods: {
        changeTab(tab) {
            this.activeTab = tab

            if (tab === 0) {
                this.activeSection = 'personal-details-info'
            }
        },

        changeSection(section) {
            if (section === 'personal-details-edit') {
                this.activeTab = 0
            }
            this.activeSection = section
        },

        refreshUser(user) {
            this.user = user
        }
    }
}
</script>

<style>
.navbar-avatar{
    align-self:center;
}
a,a:hover{
    text-decoration:none;
}
ul{
    margin-bottom:0px;
    margin-block:0px;
    /* padding-inline-start:0px; */
}
</style>
