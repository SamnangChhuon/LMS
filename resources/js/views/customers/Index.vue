<template>
    <div class="container-fluid">
        <filterable v-bind="filterable">
            <router-link :to="{name: 'CreateCustomer'}" class="btn btn-success" slot="addNew">Add New <i class="fas fa-user-plus fa-fw"></i></router-link>
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
            <tr slot-scope="{item}" @click="ViewCustomer(item.id)">
                <td>{{item.id}}</td>
                <td>{{item.firstname}}</td>
                <td>{{item.lastname}}</td>
                <td>{{item.type | upText}}</td>
                <td>{{item.businessphone | phoneNumber}}</td>
                <td>{{item.personalphone | phoneNumber}}</td>
                <td>{{item.created_at | myDate}}</td>
                <td>
                    <button class="btn btn-primary" @click.stop="editCustomer(item.id)" title="Edit"><i class="fas fa-edit text-white"></i></button>
                    <button class="btn btn-danger" @click.stop="deleteCustomer(item.id)" title="Delete"><i class="fas fa-trash text-white"></i></button>
                </td>
            </tr>
        </filterable>
        <Form></Form>
    </div>
</template>

<script type="text/javascript">
    export default {
        data() {
            return {
                editMode: false,
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
            editCustomer(value) {
                this.$router.push({ name: 'UpdateCustomer', params: { id: value }});
            },
            deleteCustomer(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.$Progress.start();
                        axios.delete('/api/customer/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Customer\'s information has been deleted.',
                                'success'
                            )
                            this.$Progress.finish();
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                            this.$Progress.fail();
                        });
                    }
                })
            },
        },
        created(){
            this.$Progress.start();
        },
        mounted() {
            this.$Progress.finish()
        },
    }
</script>

<style>
    tbody tr:hover{cursor: pointer;}
</style>