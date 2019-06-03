export default [
	{
		path: '/products', component: require('../views/products/index.vue'),
		meta: { resource: 'products' }
	},
	{
		path: '/products/create', component: require('../views/products/form.vue'),
		meta: { resource: 'products', mode: 'create' }
	},
	{
		path: '/products/:id/edit', component: require('../views/products/form.vue'),
		meta: { resource: 'products', mode: 'edit' }
	},
	{
		path: '/products/:id', component: require('../views/products/show.vue'),
		meta: { resource: 'products'}
	}
]