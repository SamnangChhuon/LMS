export default [
	{
		path: '/product_types', component: require('../views/product_types/index.vue'),
		meta: { resource: 'product_types' }
	},
	{
		path: '/product_types/create', component: require('../views/product_types/form.vue'),
		meta: { resource: 'product_types', mode: 'create' }
	},
	{
		path: '/product_types/:id/edit', component: require('../views/product_types/form.vue'),
		meta: { resource: 'product_types', mode: 'edit' }
	},
	{
		path: '/product_types/:id', component: require('../views/product_types/show.vue'),
		meta: { resource: 'product_types'}
	}
]