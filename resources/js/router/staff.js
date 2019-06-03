export default [
	{
		path: '/staffs', component: require('../views/staffs/index.vue'),
		meta: { resource: 'staffs' }
	},
	{
		path: '/staffs/create', component: require('../views/staffs/form.vue'),
		meta: { resource: 'staffs', mode: 'create' }
	},
	{
		path: '/staffs/:id/edit', component: require('../views/staffs/form.vue'),
		meta: { resource: 'staffs', mode: 'edit' }
	},
	{
		path: '/staffs/:id', component: require('../views/staffs/show.vue'),
		meta: { resource: 'staffs'}
	}
]