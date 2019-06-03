export default [
	{
		path: '/customers', component: require('../views/customers/index.vue'),
		meta: { resource: 'customers' }
	},
	{
		path: '/customers/create', component: require('../views/customers/form.vue'),
		meta: { resource: 'customers', mode: 'create' }
	},
	{
		path: '/customers/:id/edit', component: require('../views/customers/form.vue'),
		meta: { resource: 'customers', mode: 'edit' }
	},
	{
		path: '/customers/:id', component: require('../views/customers/show.vue'),
		meta: { resource: 'customers'}
	}
]