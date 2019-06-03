
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform'

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import swal from 'sweetalert2'
window.Swal = swal;
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

import VueBreadcrumbs from 'vue-breadcrumbs'
Vue.use(VueBreadcrumbs, {
    template: '<ol class="breadcrumb" v-if="$breadcrumbs.length"> ' + 
    '<li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>' + 
    '<li class="breadcrumb-item" v-for="(crumb, key) in $breadcrumbs" :key="key">{{ crumb | crumbText }}</li> ' +
    '</ol>'
})

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

import PrettyCheckbox from 'pretty-checkbox-vue';
Vue.use(PrettyCheckbox);

const VueInputMask = require('vue-inputmask').default
Vue.use(VueInputMask)

import Vuetable from 'vuetable-2';
Vue.use(Vuetable)

import Cropper from 'cropperjs';
window.Cropper = Cropper

import vSelect from 'vue-select'
Vue.component('v-select', vSelect);

let routes = [
    // Dasboard
    { 
        path: '/dashboard', 
        name: 'Dashboard',
        component: require('./components/Dashboard.vue').default, 
        meta: {
            breadcrumb: 'Dashboard'
        }
    },
    // Customer
    { 
        path: '/customer', 
        name: 'Customers',
        component: require('./components/customers/NewCustomer.vue').default, 
        meta: {
            breadcrumb: 'Customers'
        } 
    },
    // Customer > Create
    { 
        path: '/customer/create', 
        name: 'CreateCustomer',
        component: require('./components/customers/Form.vue').default, 
        meta: {
            breadcrumb: 'Create Customer'
        } 
    },
    // Customer > :id > edit
    { 
        path: '/customer/:id/edit', 
        name: 'UpdateCustomer',
        component: require('./components/customers/Form.vue').default, 
        meta: {
            breadcrumb: 'Update Customer'
        } 
    },
    // Customer > View
    { 
        path: '/customer/:id', 
        name: 'Viewcustomer',
        component: require('./components/customers/Show.vue').default, 
        meta: {
            breadcrumb: 'Show Customer'
        } 
    },
    // Customer > View > Add Product
    { 
        path: '/customer/:id/add/product', 
        name: 'addNewProductPage',
        component: require('./components/products/Create.vue').default, 
        meta: {
            breadcrumb: 'Add New Product'
        } 
    },
    // Product
    { 
        path: '/products', 
        name: 'Products',
        component: require('./components/products/NewProducts.vue').default, 
        meta: {
            breadcrumb: 'Products'
        } 
    },
    //  Product > Add
    { 
        path: '/products/add', 
        name: 'AddProduct',
        component: require('./components/products/Create.vue').default, 
        meta: {
            breadcrumb: 'Add Product'
        } 
    },
    // Promotion
    { 
        path: '/promotion', 
        name: 'Promotion',
        component: require('./components/promotion/Promotion.vue').default, 
        meta: {
            breadcrumb: 'Promotion'
        } 
    },
    // Repayment
    { 
        path: '/sale', 
        name: 'Sale',
        component: require('./components/sale/Sale.vue').default, 
        meta: {
            breadcrumb: 'Sale'
        } 
    },
    // Income
    { 
        path: '/incomeexpense', 
        name: 'IncomeExpense',
        component: require('./components/income&expense/Index.vue').default, 
        meta: {
            breadcrumb: 'Income & Expense'
        } 
    },
    // Developer
    { 
        path: '/developer', 
        name: 'Developer',
        component: require('./components/Developer.vue').default, 
        meta: {
            breadcrumb: 'Developer'
        } 
    },
    // Report
    { 
        path: '/reports', 
        name: 'Reports',
        component: require('./components/reports/Reports.vue').default, 
        meta: {
            breadcrumb: 'Reports'
        } 
    },
    // Profile of User
    { 
        path: '/profile', 
        name: 'Profile',
        component: require('./components/Profile.vue').default, 
        meta: {
            breadcrumb: 'Profile'
        } 
    },
    // Staffs
    { 
        path: '/staffs', 
        name: 'Staffs', 
        component: require('./components/staff/Staffs.vue').default, 
        meta: {
            breadcrumb: 'Staffs'
        } 
    },
    // User
    { 
        path: '/users', 
        name: 'Users', 
        component: require('./components/users/Users.vue').default, 
        meta: {
            breadcrumb: 'Users'
        } 
    },
    // 404 not found page
    { 
        path: '*', 
        component: require('./components/NotFound.vue').default 
    }
]

const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
    linkActiveClass: 'active'
});

Vue.filter('upText', function(text){
    if (text != null) {
        return text.charAt(0).toUpperCase() + text.slice(1);
    }
});

Vue.filter('myDate', function(created){
    return moment(created).format('MMMM Do YYYY');
});

Vue.filter('modified', function(created){
    return moment(created).format('MMMM Do YYYY hh:mm a');
});

Vue.filter('formatSize', function (size) {
    if (size > 1024 * 1024 * 1024 * 1024) {
        return (size / 1024 / 1024 / 1024 / 1024).toFixed(2) + ' TB'
    } else if (size > 1024 * 1024 * 1024) {
        return (size / 1024 / 1024 / 1024).toFixed(2) + ' GB'
    } else if (size > 1024 * 1024) {
        return (size / 1024 / 1024).toFixed(2) + ' MB'
    } else if (size > 1024) {
        return (size / 1024).toFixed(2) + ' KB'
    }
    return size.toString() + ' B'
});
Vue.filter('phoneNumber', function (phone) {
    if (phone != null) {
        return phone.replace(/(\d{1,3})(\d{1,3})(\d{1,4})/g, '$1 $2 $3');
    }
});

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component(
    'promotion',
    require('./components/promotion/Promotion.vue').default
);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);


const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)

Vue.component('add-multi-file', require('./components/customers/components/AddMultiFile.vue').default)
Vue.component('customer-avatar', require('./components/components/modal/CustomerAvatar.vue').default)

Vue.component('bounce-loader', require('./components/components/vue-spinner/BounceLoader.vue').default);


Vue.component('filterable', require('./components/components/Filterable.vue').default);



// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    methods: {
        // searchit: _.debounce(() => {
        //     Fire.$emit('searching');
        // }, 1000),
        printme() {
            window.print();
        }
    }    
});
