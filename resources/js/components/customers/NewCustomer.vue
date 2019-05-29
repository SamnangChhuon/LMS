<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customers Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="addNewCustomer() , collapseToggle()">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
            </div>
        </div>

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
                    <th>Modify</th>
                </tr>
            </thead>
            <tr slot-scope="{item}">
                <td>{{item.id}}</td>
                <td>{{item.firstname}}</td>
                <td>{{item.lastname}}</td>
                <td>{{item.type | upText}}</td>
                <td>{{item.businessphone}}</td>
                <td>{{item.personalphone}}</td>
                <td>{{item.created_at | myDate}}</td>
                <td>
                    <a href="#" @click="editCustomer(customer)" title="Edit"><i class="fas fa-edit text-info"></i></a>
                    |
                    <a href="#" @click="deleteCustomer(customer.id)" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                </td>
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
        method:{
            
        }
    }
</script>
