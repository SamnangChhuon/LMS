export default [
	{
		path: '/sales', component: require('../views/sales/index.vue'),
		meta: { resource: 'sales' }
	},
	{
		path: '/sales/create', component: require('../views/sales/form.vue'),
		meta: { resource: 'sales', mode: 'create' }
	},
	{
		path: '/sales/:id/edit', component: require('../views/sales/form.vue'),
		meta: { resource: 'sales', mode: 'edit' }
	},
	{
		path: '/sales/:id', component: require('../views/sales/show.vue'),
		meta: { resource: 'sales'}
	}
]