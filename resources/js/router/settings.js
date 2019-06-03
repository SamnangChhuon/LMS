// import role from './settings/role'
// import invitation from './settings/invitation'

export default [
	{
		path: '/settings', component: require('../views/settings/base.vue'),
		children: [
			{
				path: '', component: require('../views/settings/general.vue'),
				meta: { resource: 'settings/general' }
			},
			{
				path: 'contacts', component: require('../views/settings/contacts.vue'),
				meta: { resource: 'settings/custom_fields?type=contacts' }
			},
			{
				path: 'items', component: require('../views/settings/items.vue'),
				meta: { resource: 'settings/items' }
			},
			// {
			// 	path: 'contracts', component: require('../views/settings/contracts.vue'),
			// 	meta: { resource: 'settings/contracts' }
			// },
			{
				path: 'invoices', component: require('../views/settings/invoices.vue'),
				meta: { resource: 'settings/invoices' }
			},
			{
				path: 'payments', component: require('../views/settings/payments.vue'),
				meta: { resource: 'settings/payments' }
			},
			{
				path: 'expenses', component: require('../views/settings/expenses.vue'),
				meta: { resource: 'settings/expenses' }
			},
		]
	}
]