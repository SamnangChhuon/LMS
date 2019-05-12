<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Customers Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="addNewCustomer() , collapseToggle()">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>CID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Type</th>
                                    <th>Business Phone</th>
                                    <th>Personal Phone</th>
                                    <th>Registered At</th>
                                    <th>Modify</th>
                                </tr>
                                <tr v-for="customer in customers.data" :key="customer.id">
                                    <td><router-link :to="{name: 'Viewcustomer', params: {id: customer.id}}">{{ customer.id }}</router-link></td>
                                    <td>{{ customer.firstname }}</td>
                                    <td>{{ customer.lastname }}</td>
                                    <td>{{ customer.type | upText }}</td>
                                    <td>{{ customer.businessphone }}</td>
                                    <td>{{ customer.personalphone }}</td>
                                    <td>{{ customer.created_at | myDate }}</td>
                                    <td>
                                        <a href="#" @click="editCustomer(customer)" title="Edit"><i class="fas fa-edit text-info"></i></a>
                                        |
                                        <a href="#" @click="deleteCustomer(customer.id)" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="customers" @pagination-change-page="getAllCustomer"></pagination>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewCustomer" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-show="!editMode" id="addNewCustomer">Add New Customer</h4>
                        <h4 class="modal-title" v-show="editMode" id="addNewCustomer">Update Customer's Info</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateCustomer() : createCustomer()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <strong>Detail</strong>
                            <p class="text-muted">Add information to create a customer</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name <span class="text-danger">*</span></label>
                                        <input v-model="form.firstname" type="text" name="firstname" class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('firstname')}">
                                        <has-error :form="form" field="firstname"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                        <input v-model="form.lastname" type="text" name="lastname" class="form-control"
                                         :class="{'is-invalid': form.errors.has('lastname')}">
                                        <has-error :form="form" field="lastname"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyname">Company Name</label>
                                        <input v-model="form.companyname" type="text" name="companyname" class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('companyname') }">
                                        <has-error :form="form" field="companyname"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Customer Type</label>
                                        <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-valid': form.errors.has('type') }">
                                            <option value="">Select an option</option>
                                            <option value="acquired">Acquired</option>
                                            <option value="active">Active</option>
                                            <option value="marketFailed">Market Failed</option>
                                            <option value="projectCancelled">Project Cancelled</option>
                                            <option value="shutdown">Shutdown</option>
                                        </select>
                                        <has-error :form="form" field="type"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input v-model="form.dob" type="text" name="dob" class="form-control" v-mask="{mask: '99/99/9999', greedy: true, alias:'mm/dd/yyyy'}" :class="{ 'is-invalid': form.errors.has('dob') }"/>
                                        <has-error :form="form" field="dob"></has-error>
                                    </div>
                                    <div class="form-group" :class="{ 'is-valid': form.errors.has('sex') }">
                                        <br>
                                        <p-radio class="p-default p-round" v-model="form.sex" name="sex" value="male" 
                                        color="primary-o">Male</p-radio>
                                        <p-radio class="p-default p-round" v-model="form.sex" name="sex" value="female" 
                                        color="primary-o">Female</p-radio>
                                        <has-error :form="form" field="sex"></has-error>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a class="text-primary" data-toggle="collapse" href="#contactInformation" role="button" aria-expanded="false" aria-controls="contactInformation"><strong>Contact Information</strong> <i class="fas fa-angle-double-right"></i></a>
                            <div class="collapse" id="contactInformation" v-bind:class="{show:editMode}">
                                <p class="text-muted">Add information to create a contact</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="businessphone">Business Phone</label>
                                            <input v-model="form.businessphone" type="businessphone"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('businessphone') }">
                                            <has-error :form="form" field="businessphone"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="personalphone">Personal Phone</label>
                                            <input v-model="form.personalphone" type="personalphone" name="personalphone"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('personalphone') }">
                                            <has-error :form="form" field="personalphone"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input v-model="form.fax" type="fax" name="fax"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('fax') }">
                                            <has-error :form="form" field="fax"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input v-model="form.email" type="email" name="email"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input v-model="form.website" type="website" name="website"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('website') }">
                                            <has-error :form="form" field="website"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input v-model="form.twitter" type="twitter" name="twitter"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('twitter') }">
                                            <has-error :form="form" field="twitter"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="line">Line</label>
                                            <input v-model="form.line" type="line" name="line"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('line') }">
                                            <has-error :form="form" field="line"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="remarkcontact">Remark</label>
                                            <textarea v-model="form.remarkcontact" name="remarkcontact" id="remarkcontact"
                                            class="form-control" rows="1" :class="{ 'is-invalid': form.errors.has('remarkcontact') }"></textarea>
                                            <has-error :form="form" field="remarkcontact"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a class="text-primary" data-toggle="collapse" href="#addressInformation" role="button" aria-expanded="false" aria-controls="addressInformation"><strong>Physical Address Information</strong> <i class="fas fa-angle-double-right"></i></a>
                            <div class="collapse" id="addressInformation" v-bind:class="{show:editMode}">
                                <p class="text-muted">Add information to create a physical address</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postalcode">Postal Code</label>
                                            <input v-model="form.postalcode" type="postalcode" name="postalcode"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('postalcode') }">
                                            <has-error :form="form" field="postalcode"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <textarea v-model="form.street" name="street" id="street"
                                            class="form-control" rows="2" :class="{ 'is-invalid': form.errors.has('street') }"></textarea>
                                            <has-error :form="form" field="street"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input v-model="form.city" type="city" name="city"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                            <has-error :form="form" field="city"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input v-model="form.country" type="country" name="country"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                            <has-error :form="form" field="country"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="remarkaddress">Remark</label>
                                            <textarea v-model="form.remarkaddress" name="remarkaddress" id="remarkaddress" class="form-control" rows="2" :class="{ 'is-invalid': form.errors.has('remarkaddress') }"></textarea>
                                            <has-error :form="form" field="remarkaddress"></has-error>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update <i class="fas fa-pencil-alt fa-fw"></i></button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Save <i class="fas fa-plus fa-fw"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                customers: {},
                form: new Form({
                    id: '',
                    firstname: '',
                    lastname: '',
                    sex: 'male',
                    companyname: '',
                    dob: '',
                    type: '',
                    businessphone: '',
                    personalphone: '',
                    fax: '',
                    email: '',
                    website: '',
                    twitter: '',
                    line: '',
                    remarkcontact: '',
                    postalcode: '',
                    street: '',
                    city: '',
                    country: '',
                    remarkaddress: ''
                }),
            }
        },
        methods: {
            collapseToggle: function(){
                $('#contactInformation').removeClass('show');
                $('#addressInformation').removeClass('show');
            },
            getAllCustomer(page = 1) {
                axios.get('api/customer?page=' + page)
                    .then(response => {
                        this.customers = response.data;
                    });
            },

            loadCustomers() {
                axios.get("api/customer").then(({ data }) => (this.customers = data));
            },

            createCustomer() {
                this.$Progress.start();
                this.form.post('api/customer')
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Customer\'s name already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=firstname]').addClass('is-invalid');
                        $('input[name=lastname]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=firstname]').removeClass('is-invalid');
                            $('input[name=lastname]').removeClass('is-invalid');
                        }, 5000);
                    } else {
                        Fire.$emit('reloadData');
                        $('#addNew').modal('hide');
                        toast.fire({
                            type: 'success',
                            title: 'Customer added in successfully'
                        })
                        this.$Progress.finish();
                    }
                })
                .catch((error) => {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Data error!!!',
                        text: error,
                        type: 'error',
                        confirmButtonText: 'Close',
                    });
                });
            },
            editCustomer(customer) {
                this.editMode = true;
                $('#warningAlert').hide(); // Hide the Warning Alert
                this.form.reset(); // Reset the modal
                this.form.clear();
                $('#addNew').modal('show');
                this.form.fill(customer); // Pass the data to the modal
            },
            updateCustomer(){
                this.$Progress.start();
                this.form.put('api/customer/' + this.form.id)
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Customer\'s name already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=firstname]').addClass('is-invalid');
                        $('input[name=lastname]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=firstname]').removeClass('is-invalid');
                            $('input[name=lastname]').removeClass('is-invalid');
                        }, 4000);
                    } else {
                        Fire.$emit('reloadData'); 
                        $('#addNew').modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Customer\'s information has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
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
                    // Send requesst to the server
                    if (result.value) {
                        this.form.delete('api/customer/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Customer\'s information has been deleted.',
                                'success'
                            )
                            Fire.$emit('reloadData'); // Register new event "reloadData"
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            addNewCustomer() {
                this.editMode = false; // Reset Edit Mode
                $('#warningAlert').hide(); // Hide the Warning Alert
                this.form.clear(); // Clear Errors Form
                this.form.reset();  // Clear Input Form
                $('#addNew').modal('show');
            },
        },
        created() {
            this.loadCustomers();
            
            Fire.$on('reloadData', () => {
                this.loadCustomers();
            }); // using event AfterCreate
        },
        mounted() {
        }
    }
</script>
