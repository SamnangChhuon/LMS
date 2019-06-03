import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import customer from './customer'
import expense from './expense'
import image from './image'
import income from './income'
import productType from './product_type'
import product from './product'
import repayment from './repayment'
import sale from './sale'
import staff from './staff'
import settings from './settings'

const router = new VueRouter({
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x:0 , y:0 }
        }
    },
    routes: [
        {path: '/', component: require('../views/dashboard.vue'), meta: { resource: 'dashboard'}},
        {path: '/personal_settings', component: require('../views/users/personal_settings.vue'), meta: { resource: 'personal_settings'}},
        ...customer,
        ...expense,
        ...image,
        ...income,
        ...productType,
        ...product,
        ...repayment,
        ...sale,
        ...staff,
        ...settings
    ]
})

export default router