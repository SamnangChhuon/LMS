export default [
	{
		path: '/expense', component: require('../views/expense/index.vue'),
		meta: { resource: 'expense' }
	},
	{
		path: '/expense/create', component: require('../views/expense/form.vue'),
		meta: { resource: 'expense', mode: 'create' }
	},
	{
		path: '/expense/:id/edit', component: require('../views/expense/form.vue'),
		meta: { resource: 'expense', mode: 'edit' }
	},
	{
		path: '/expense/:id', component: require('../views/expense/show.vue'),
		meta: { resource: 'expense'}
	}
]