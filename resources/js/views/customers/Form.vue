<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white">
                <h3 class="card-title" v-show="!editMode">Add New Customer</h3>
                <h3 class="card-title" v-show="editMode">Update Customer's Info</h3>
                <div class="card-tools">
                    <a :href="urlBack()" class="btn btn-light" title="Back"><i class="fas fa-arrow-left text-dark"></i> Back</a>
                </div>
            </div>
            <form @submit.prevent="editMode ? updateCustomer() : createCustomer()" @keydown="form.onKeydown($event)">
                <div class="card-body">
                    <strong>Detail</strong>
                    <p class="text-muted">Add information to create a customer</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstname">First Name <span class="text-danger">*</span></label>
                                <input v-model="form.firstname" type="text" name="firstname" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('firstname')}">
                                <has-error :form="form" field="firstname"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                <input v-model="form.lastname" type="text" name="lastname" class="form-control"
                                    :class="{'is-invalid': form.errors.has('lastname')}">
                                <has-error :form="form" field="lastname"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" :class="{ 'is-valid': form.errors.has('sex') }">
                                <br>
                                <p-radio class="p-default p-round" v-model="form.sex" name="sex" value="male" 
                                color="primary-o">Male</p-radio>
                                <p-radio class="p-default p-round" v-model="form.sex" name="sex" value="female" 
                                color="primary-o">Female</p-radio>
                                <has-error :form="form" field="sex"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="companyname">Company Name</label>
                                <input v-model="form.companyname" type="text" name="companyname" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('companyname') }">
                                <has-error :form="form" field="companyname"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Customer Type</label>
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-valid': form.errors.has('type') }">
                                    <option value="">Select an option</option>
                                    <option value="1">Active</option>
                                    <option value="2">Acquired</option>
                                    <option value="3">Market Failed</option>
                                    <option value="4">Project Cancelled</option>
                                    <option value="5">Shutdown</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <div class="input-group">
                                    <input v-model="form.dob" type="date" name="dob" class="form-control" v-mask="{mask: '99/99/9999', greedy: true, alias:'mm/dd/yyyy'}" :class="{ 'is-invalid': form.errors.has('dob') }"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                </div>
                                <has-error :form="form" field="dob"></has-error>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <strong>Contact Information</strong>
                    <p class="text-muted">Add information to create a contact</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="businessphone">Business Phone</label>
                                <input v-model="form.businessphone" type="businessphone"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('businessphone') }">
                                <has-error :form="form" field="businessphone"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="personalphone">Personal Phone</label>
                                <input v-model="form.personalphone" type="personalphone" name="personalphone"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('personalphone') }">
                                <has-error :form="form" field="personalphone"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input v-model="form.fax" type="fax" name="fax"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('fax') }">
                                <has-error :form="form" field="fax"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input v-model="form.email" type="email" name="email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="line">Line</label>
                                <input v-model="form.line" type="line" name="line"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('line') }">
                                <has-error :form="form" field="line"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="remarkcontact">Remark</label>
                                <textarea v-model="form.remarkcontact" name="remarkcontact" id="remarkcontact"
                                class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('remarkcontact') }"></textarea>
                                <has-error :form="form" field="remarkcontact"></has-error>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <strong>Physical Address Information</strong>
                    <p class="text-muted">Add information to create a physical address</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="street">Street</label>
                                <textarea v-model="form.street" name="street" id="street"
                                class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('street') }"></textarea>
                                <has-error :form="form" field="street"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input v-model="form.city" type="city" name="city"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                <has-error :form="form" field="city"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input v-model="form.country" type="country" name="country"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                <has-error :form="form" field="country"></has-error>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input v-model="form.postalcode" type="postalcode" name="postalcode"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('postalcode') }">
                                <has-error :form="form" field="postalcode"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="remarkaddress">Remark</label>
                                <textarea v-model="form.remarkaddress" name="remarkaddress" id="remarkaddress" class="form-control" rows="1" :class="{ 'is-invalid': form.errors.has('remarkaddress') }"></textarea>
                                <has-error :form="form" field="remarkaddress"></has-error>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="card-footer bg-white">
                    <div class="fa-pull-right">
                        <a :href="urlBack()" class="btn btn-light" title="Back">Cancel</a>
                        <button v-show="editMode" type="submit" class="btn btn-success">Update <i class="fas fa-pencil-alt fa-fw"></i></button>
                        <button v-show="!editMode" type="submit" class="btn btn-primary">Save <i class="fas fa-plus fa-fw"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editMode: false,
            form: new Form({
                id: '',
                firstname: '',
                lastname: '',
                sex: 'male',
                companyname: '',
                dob: '',
                type: '1',
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
        urlBack(){
            if (this.form.id) {
                return '/customer/' + this.form.id;
            } else {
                return '/customer';
            }
        },
        createCustomer() {
            this.$Progress.start();
            this.form.post('/api/customer')
            .then((response) => {
                if (response.data.existed) {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Duplicate Data!!!',
                        text: 'Customer\'s name already existed.',
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
                    toast.fire({
                        type: 'success',
                        title: 'Customer added in successfully'
                    });
                    this.$Progress.finish();
                    this.$router.push({ name: 'Viewcustomer', params: { id: response.data.id }});
                }
            })
            .catch((error) => {
                this.$Progress.fail();
                Swal.fire({
                    title: 'Required Fields!!!',
                    text: 'The required fields can\'t be empty.',
                    type: 'error',
                    confirmButtonText: 'Close',
                });
            });
        },
        updateCustomer(){
            this.$Progress.start();
            this.form.put('/api/customer/' + this.form.id)
            .then((response) => {
                if (response.data.existed) {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Duplicate Data!!!',
                        text: 'Customer\'s name already existed.',
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
                    Swal.fire(
                        'Updated!',
                        'Customer\'s information has been updated.',
                        'success'
                    )
                    this.$Progress.finish();
                    this.$router.push({ name: 'Viewcustomer', params: { id: this.form.id }});
                }
            })
            .catch(() => {
                this.$Progress.fail();
            });
        },
    },
    created(){
        this.$Progress.start();
        if (this.$route.params.id) {
            this.editMode = true;
            axios.get('/api/customer/' + this.$route.params.id).then((response) => {
                this.form.fill(response.data);
            });
        }
    },
    mounted() {
        this.$Progress.finish()
    },
}
</script>