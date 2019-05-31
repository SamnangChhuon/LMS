<template>
    <div class="container-fluid">
        <filterable v-bind="filterable">
            <thead slot="thead">
                <tr>
                    <th>Staff ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Type</th>
                    <th>Phone Number</th>
                    <th>Mobile Phone</th>
                    <th>Registered Date</th>
                </tr>
            </thead>
            <tr slot-scope="{item}" @click="ViewStaff(item.id)">
                <td>{{item.id}}</td>
                <td>{{item.firstname}}</td>
                <td>{{item.lastname}}</td>
                <td>{{item.type | upText}}</td>
                <td>{{item.phonenumber}}</td>
                <td>{{item.mobilephone}}</td>
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
                    url: 'api/staff',
                    orderables: [
                        {title: 'Staff ID', name: 'id'},
                        {title: 'First Name', name: 'firstname'},
                        {title: 'Last Name', name: 'lastname'},
                        {title: 'Type', name: 'type'},
                        {title: 'Phone Number', name: 'phonenumber'},
                        {title: 'Mobile Phone', name: 'mobilephone'},
                        {title: 'Registered Date', name: 'created_at'},
                    ],
                    filterGroups: [
                        {
                            name: 'Staff',
                            filters: [
                                {title: 'Staff ID', name: 'id', type: 'numeric'},
                                {title: 'First Name', name: 'firstname', type: 'string'},
                                {title: 'Last Name', name: 'lastname', type: 'string'},
                                {title: 'Type', name: 'type', type: 'string'},
                                {title: 'Phone Number', name: 'phonenumber', type: 'string'},
                                {title: 'Mobile Phone', name: 'mobilephone', type: 'string'},
                                {title: 'Created At', name: 'created_at', type: 'datetime'},
                            ]
                        },
                    ]
                }
            }
        },
        methods:{
            ViewStaff(value){
                console.log('View Staff');
                // this.$router.push({ name: 'ViewStaff', params: { id: value }});
            },
        }
    }
</script>

<style>
    tbody tr:hover{cursor: pointer;}
</style>