export default [
	{
		path: '/income', component: require('../views/income/index.vue'),
		meta: { resource: 'income' }
	},
	{
		path: '/income/create', component: require('../views/income/form.vue'),
		meta: { resource: 'income', mode: 'create' }
	},
	{
		path: '/income/:id/edit', component: require('../views/income/form.vue'),
		meta: { resource: 'income', mode: 'edit' }
	},
	{
		path: '/income/:id', component: require('../views/income/show.vue'),
		meta: { resource: 'income'}
	}
]