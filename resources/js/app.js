require('./bootstrap');

window.Vue = require('vue');

import VTooltip from 'v-tooltip';
Vue.use(VTooltip);

import ToggleButton from 'vue-js-toggle-button';
Vue.use(ToggleButton);

import VueToast from 'vue-toast-notification';
Vue.use(VueToast);
import 'vue-toast-notification/dist/theme-default.css';

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

import Clipboard from 'v-clipboard'
Vue.use(Clipboard)

import CheckboxRadio from 'vue-checkbox-radio';
Vue.use(CheckboxRadio);

import VueThreeSixty from 'vue-360';
import 'vue-360/dist/css/style.css';
Vue.use(VueThreeSixty);

import VueTelInput from 'vue-tel-input';
Vue.use(VueTelInput)

import VueCurrencyFilter from 'vue-currency-filter';
Vue.use(VueCurrencyFilter,
{
    symbol : '$',
    thousandsSeparator: ',',
    fractionCount: 0,
    fractionSeparator: '.',
    symbolPosition: 'front',
    symbolSpacing: false,
    avoidEmptyDecimals: undefined,
})

Vue.component('modal', require('./components/Modal').default);
Vue.component('modal-delete', require('./components/ModalDelete').default);

Vue.component('clients', require('./views/admin/clients/index.vue').default);
Vue.component('users', require('./views/admin/users/index.vue').default);
Vue.component('roles', require('./views/admin/roles/index.vue').default);
Vue.component('admin-brands', require('./views/admin/brands/index.vue').default);
Vue.component('admin-transmissions', require('./views/admin/transmissions/index.vue').default);
Vue.component('admin-cylinders', require('./views/admin/cylinders/index.vue').default);
Vue.component('admin-accessory-types', require('./views/admin/accessories/types.vue').default);
Vue.component('admin-accessories', require('./views/admin/accessories/index.vue').default);
Vue.component('admin-fuels', require('./views/admin/fuels/index.vue').default);
Vue.component('admin-vehicle-sides', require('./views/admin/vehicle_sides/index.vue').default);
Vue.component('admin-body-types', require('./views/admin/body_types/index.vue').default);
Vue.component('admin-models', require('./views/admin/models/index.vue').default);
Vue.component('admin-versions', require('./views/admin/versions/index.vue').default);
Vue.component('admin-colors', require('./views/admin/colors/index.vue').default);
Vue.component('admin-drives', require('./views/admin/drives/index.vue').default);
Vue.component('admin-vehicles-index', require('./views/admin/vehicles/index.vue').default);
Vue.component('admin-vehicles-create', require('./views/admin/vehicles/create.vue').default);
Vue.component('admin-vehicles-edit', require('./views/admin/vehicles/edit.vue').default);
Vue.component('admin-inspections', require('./views/admin/inspections/index.vue').default);
Vue.component('admin-vehicles-quote-requests', require('./views/admin/vehicles/quoteRequest.vue').default);
Vue.component('admin-vehicle-sell-requests', require('./views/admin/vehicles/sellRequest.vue').default);
Vue.component('admin-prices-index', require('./views/admin/prices/index.vue').default);

Vue.component('affiliate-levels', require('./views/admin/affiliates/levels').default);
Vue.component('admin-affiliate-vehicles', require('./views/admin/affiliates/vehicles').default);
Vue.component('affiliates', require('./views/admin/affiliates/index').default);

/* blog */
Vue.component('blog-categories', require('./views/admin/blog/categories').default);
Vue.component('posts', require('./views/admin/blog/posts/index').default);
Vue.component('create-post', require('./views/admin/blog/posts/create').default);
Vue.component('edit-post', require('./views/admin/blog/posts/edit').default);

/* site components */

Vue.component('site-blog', require('./views/site/blog/index.vue').default);
Vue.component('site-search-cars', require('./views/site/cars/index.vue').default);
Vue.component('site-car', require('./views/site/cars/show.vue').default);
Vue.component('site-car-get-quote', require('./views/site/cars/getQuote.vue').default);
Vue.component('site-sell-form', require('./views/site/cars/sell.vue').default);
Vue.component('auth-modal', require('./views/site/auth/auth_modal.vue').default);
Vue.component('site-users', require('./views/site/users/index.vue').default);
Vue.component('favorites', require('./views/site/favorites/index.vue').default);
Vue.component('contact-form', require('./views/site/contact/contactForm').default);

Vue.component('affiliate-register', require('./views/site/affiliates/register').default);
Vue.component('affiliate-store-vehicles', require('./views/site/affiliates/storeVehicle').default);
Vue.component('affiliate-vehicles', require('./views/site/affiliates/vehicles').default);

const store = Vue.observable({  savedFilters: []  })
Vue.prototype.$store = store

const app = new Vue({
    el: '#app',
});
