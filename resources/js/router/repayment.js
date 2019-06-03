export default [
	{
		path: '/repayment', component: require('../views/repayment/index.vue'),
		meta: { resource: 'repayment' }
	},
	{
		path: '/repayment/create', component: require('../views/repayment/form.vue'),
		meta: { resource: 'repayment', mode: 'create' }
	},
	{
		path: '/repayment/:id/edit', component: require('../views/repayment/form.vue'),
		meta: { resource: 'repayment', mode: 'edit' }
	},
	{
		path: '/repayment/:id', component: require('../views/repayment/show.vue'),
		meta: { resource: 'repayment'}
	}
]