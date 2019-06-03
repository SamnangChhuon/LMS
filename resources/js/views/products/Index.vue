<template>
    <div class="container-fluid">
        <filterable v-bind="filterable">
            <router-link class="btn btn-success" :to="{name:'AddProduct'}" slot="addNew">Add New <i class="fas fa-plus fa-fw"></i></router-link>
            <thead slot="thead">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <!-- <th>Price</th> -->
                    <th>Status</th>
                    <th>Modified Time</th>
                </tr>
            </thead>
            <tr slot-scope="{item}" @click="ViewProduct(item.id)">
                <td>{{item.id}}</td>
                <td>{{item.name}}</td>
                <td>{{item.code}}</td>
                <!-- <td>$ {{item.price | formatPrice}}</td> -->
                <td v-html="checkStatus(item.status)"></td>
                <td>{{item.created_at | myDate}}</td>
            </tr>
        </filterable>
    </div>
</template>

<script type="text/javascript">
    export default {
        data() {
            return {
                filterable: {
                    url: 'api/product',
                    orderables: [
                        {title: 'Product ID', name: 'id'},
                        {title: 'Product Name', name: 'name'},
                        {title: 'Product Code', name: 'code'},
                        {title: 'Price', name: 'price'},
                        {title: 'Status', name: 'status'},
                        {title: 'Modified Time', name: 'created_at'},
                    ],
                    filterGroups: [
                        {
                            name: 'Product',
                            filters: [
                                {title: 'Product ID', name: 'id', type: 'numeric'},
                                {title: 'Product Name', name: 'name', type: 'string'},
                                {title: 'Product Name', name: 'code', type: 'string'},
                                {title: 'Price', name: 'price', type: 'string'},
                                {title: 'Status', name: 'status', type: 'string'},
                                {title: 'Modified Time', name: 'created_at', type: 'datetime'},
                            ]
                        },
                    ]
                }
            }
        },
        methods:{
            ViewProduct(value){
                // this.$router.push({ name: 'Viewcustomer', params: { id: value }});
                console.log('View Product');
            },
            checkStatus(value) {
                if(!value) return ''
                let text = value.toString().charAt(0).toUpperCase() + value.slice(1);
                if(value === 'available') {
                    return '<h5><span class="badge badge-success">' + text + '</span></h5>';
                } else if (value === 'block') {
                    return '<h5><span class="badge badge-danger">' + text + '</span></h5>';
                } else {
                    return '<h5><span class="badge badge-info text-white">' + text + '</span></h5>';
                }
            }
        },
        filters: {
            formatPrice: function(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
        }
    }
</script>

<style>
    tbody tr:hover{cursor: pointer;}
</style>