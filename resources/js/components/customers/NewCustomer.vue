<template>
    <div class="container-fluid">
        <filterable v-bind="filterable">
            <thead slot="thead">
                <tr>
                    <th>CID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Type</th>
                    <th>Business Phone</th>
                    <th>Personal Phone</th>
                    <th>Registered Date</th>
                </tr>
            </thead>
            <tr slot-scope="{item}" @click="ViewCustomer(item.id)">
                <td>{{item.id}}</td>
                <td>{{item.firstname}}</td>
                <td>{{item.lastname}}</td>
                <td>{{item.type | upText}}</td>
                <td>{{item.businessphone}}</td>
                <td>{{item.personalphone}}</td>
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
                    url: 'api/customer',
                    orderables: [
                        {title: 'CID', name: 'id'},
                        {title: 'First Name', name: 'firstname'},
                        {title: 'Last Name', name: 'lastname'},
                        {title: 'Type', name: 'type'},
                        {title: 'Business Phone', name: 'businessphone'},
                        {title: 'Personal Phone', name: 'personalphone'},
                        {title: 'Registered Date', name: 'created_at'},
                    ],
                    filterGroups: [
                        {
                            name: 'Customer',
                            filters: [
                                {title: 'CID', name: 'id', type: 'numeric'},
                                {title: 'First Name', name: 'firstname', type: 'string'},
                                {title: 'Last Name', name: 'lastname', type: 'string'},
                                {title: 'Type', name: 'type', type: 'string'},
                                {title: 'Business Phone', name: 'businessphone', type: 'string'},
                                {title: 'Personal Phone', name: 'personalphone', type: 'string'},
                                {title: 'Created At', name: 'created_at', type: 'datetime'},
                            ]
                        },
                    ]
                }
            }
        },
        methods:{
            ViewCustomer(value){
                this.$router.push({ name: 'Viewcustomer', params: { id: value }});
            },
        }
    }
</script>

<style>
    tbody tr:hover{cursor: pointer;}
</style>