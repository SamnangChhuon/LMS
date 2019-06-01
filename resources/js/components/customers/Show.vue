<style>
.nav-tabs .nav-link{ color: #000; }
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
    background-color: #fff;
    border: none;
    border-radius: 0;
    border-top: 2px solid #00c0ef;
}
#customerContent th{ color: #6c757d !important; }
#informationsTab th { width: 50%; }
</style>

<template>
    <div class="container-fluid">

        <div class="card card-widget widget-user-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-user-header bg-info-active">
                        <div class="widget-user-image">
                            <img v-if="customer.photo == null || customer.photo == ''" class="img-customer img-circle elevation-2"
                                :src="customerProfile()" alt="User Avatar">
                            <img v-else class="img-customer img-circle elevation-2" :src="'/storage/customers/' + customer.id + '/' + customer.photo" alt="User Avatar">
                            <span class="hover-image img-circle" @click="avatarModel"></span>
                        </div>
                        <h3 class="widget-user-username">{{ customer.firstname + ' ' + customer.lastname }}</h3>
                        <h5 class="widget-user-desc">CID {{ customer.id }}</h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fa-pull-right">
                        <div class="card-tools p-2">
                            <a href="/customer" class="btn btn-light" title="Back"><i class="fas fa-arrow-left text-dark"></i> Back</a>
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"><i class="fas fa-cog"></i></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" @click="editCustomer(customer.id)"><i class="fas fa-edit text-primary"></i> Edit</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" @click="deleteCustomer(customer.id)"><i class="fas fa-trash text-danger"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <ul class="nav nav-tabs" id="customer" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#productsTab">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#legalDocumentsTab">Legal Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#informationsTab">Informations</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="customerContent">

            <!-- Product Tab -->
            <div class="tab-pane fade show active" id="productsTab">
                <div class="card">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title m-0">Product Details</h3>
                        <div class="card-tools">
                            <router-link :to="{name: 'addNewProductPage', param: {id: customer.id}}" class="btn btn-info text-white"><i class="fa fa-plus"></i> Add product</router-link>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Unit</th>
                                            <th>Unit Type</th>
                                            <th>Original Price</th>
                                            <th>Discount</th>
                                            <th>Net Sale Price</th>
                                            <th>Paid Amount</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="product in customerProduct" :key="product.id">
                                            <td>{{ product.name }} / {{product.code}}</td>
                                            <td>{{ getType(product.typeid) }}</td>
                                            <td>$ {{ formatPrice(product.price) }}</td>
                                            <td>{{ product.promotion }}</td>
                                            <td>000</td>
                                            <td>1111</td>
                                            <td>22222</td>
                                        </tr>
                                        <tr v-if="customerProduct == ''" class="text-center">
                                            <td colspan="7">No product found.</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title m-0">Product Details</h3>
                        <div class="card-tools">
                            <!-- <router-link :to="{name: 'addNewProductPage', param: {id: customer.id}}" class="btn btn-info text-white"><i class="fa fa-plus"></i> Add product</router-link> -->
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Payment Date</th>
                                            <th>Installment</th>
                                            <th>Description</th>
                                            <th>Progressive %</th>
                                            <th>Amount</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody>
                                        <tr v-for="product in customerProduct" :key="product.id">
                                            <td>{{ product.name }} / {{product.code}}</td>
                                            <td>{{ getType(product.typeid) }}</td>
                                            <td>$ {{ formatPrice(product.price) }}</td>
                                            <td>{{ product.promotion }}</td>
                                            <td>000</td>
                                            <td>1111</td>
                                            <td>22222</td>
                                        </tr>
                                        <tr v-if="customerProduct == ''" class="text-center">
                                            <td colspan="7">No product found.</td>
                                        </tr>
                                    </tbody> -->
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Legal Documents Tab -->
            <div class="tab-pane fade" id="legalDocumentsTab">
                <div class="card">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title m-0">Legal Documents</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-info text-white" data-toggle="modal" data-target="#addImage" @click="addFile()"><i class="fa fa-plus"></i> Add file</button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-2 bg-dark" style="height:400px;">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Thumb</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="customerFile == ''">
                                        <td colspan="7">
                                            <div class="text-center p-5">
                                                <h4>Customer have no file or image.</h4>
                                                <button type="button" class="btn btn-info text-white" @click="addFile()"><i class="fa fa-plus"></i> Select Files</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-for="(file, index) in customerFile" :key="file.id">
                                        <td>{{index + 1}}</td>
                                        <!-- <td><img v-if="file.file" :src="file.file" width="40" height="auto"></td> -->
                                        <td><img v-if="file.file" :src="'/storage/app/customers/img/'  + file.cid +'/' + file.file" width="40" height="auto"></td>
                                        <td>{{file.file}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <!-- Informations Tab -->
            <div class="tab-pane fade" id="informationsTab">
                <div class="card">
                    <div class="card-header bg-white p-2 pl-3">
                        <h3 class="card-title m-0"><small>Customer Details</small></h3>
                        <div class="card-tools fa-pull-right">
                            <button type="button" class="btn btn-tool p-0" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table no-border">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ customer.firstname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ customer.lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company Name</th>
                                        <td>{{ customer.companyname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Customer Type</th>
                                        <td>{{ customer.type | upText }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table no-border">
                                    <tr>
                                        <th>Customer ID</th>
                                        <td>{{ customer.id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ customer.dob }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sex</th>
                                        <td>{{ customer.sex | upText }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modified Time</th>
                                        <td>{{ customer.created_at | modified }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white p-2 pl-3">
                        <h3 class="card-title m-0"><small>Contact Information</small></h3>
                        <div class="card-tools fa-pull-right">
                            <button type="button" class="btn btn-tool p-0" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table no-border">
                                    <tr>
                                        <th>Business Phone</th>
                                        <td>{{ customer.businessphone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Personal Phone</th>
                                        <td>{{ customer.personalphone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fax</th>
                                        <td>{{ customer.fax }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ customer.email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table no-border">
                                    <tr>
                                        <th>Website</th>
                                        <td>{{ customer.website }}</td>
                                    </tr>
                                    <tr>
                                        <th>Twitter</th>
                                        <td>{{ customer.twitter }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line</th>
                                        <td>{{ customer.line }}</td>
                                    </tr>
                                    <tr>
                                        <th>Remark</th>
                                        <td>{{ customer.remarkcontact }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white p-2 pl-3">
                        <h3 class="card-title m-0"><small>Physical Address Information</small></h3>
                        <div class="card-tools fa-pull-right">
                            <button type="button" class="btn btn-tool p-0" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table no-border">
                                    <tr>
                                        <th>Postal Code</th>
                                        <td>{{ customer.postalcode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Street</th>
                                        <td>{{ customer.street }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ customer.city }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table no-border">
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ customer.country }}</td>
                                    </tr>
                                    <tr>
                                        <th>Remark</th>
                                        <td>{{ customer.remarkaddress }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <add-multi-file></add-multi-file>

        <!-- Customer Upload Profile Model -->
        <div class="modal fade" id="avatarCustomer" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form class="form-horizontal">
                        <div class="modal-header">
                            <h4 class="modal-title">Customer Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <label for="avatar">
                                    <img :src="previewAvatar()"  class="img-circle w-100" />
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="file" @change="updateProfile" ref="imageInput">
                            </div>
                        </div>
                        <div class="modal-footer d-block">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                            <button type="submit" class="btn btn-success fa-pull-right" @click.prevent="updateInfo">Save</button>
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
                customerProduct: [],
                customerFile: [],
                productType: '',
                customer: {
                    firstname: '',
                    lastname: '',
                    photo: '',
                },
                formAvatar: new Form({
                    photo: ''
                }),
            }
        },
        methods: {
            avatarModel(){
                $('#avatarCustomer').modal('show');
                this.$refs.imageInput.value = null;
            },
            customerProfile(){
                let profile = (this.customer.sex == 'male') ? '/img/profile/none/male.png' : '/img/profile/none/female.png';
                return profile;
            },
            previewAvatar() {
                this.$Progress.start();
                let photo = (this.formAvatar.photo.length > 200) ? this.formAvatar.photo : "/img/profile/avatar.png";
                this.$Progress.finish();
                return photo;
            },
            updateProfile(e) {
                this.$Progress.start();
                // console.log('uploading');
                let file = e.target.files[0];
                // console.log(file);
                let reader = new FileReader();

                if (file['size'] < 2111775 ) {
                    reader.onloadend = (file) => {
                        // console.log('RESULT', reader.result);
                        this.formAvatar.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                    this.$Progress.finish();
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: "You are uploading a large file!",
                    });
                    this.$Progress.fail();
                }
            },
            updateInfo() {
                this.$Progress.start();
                if (this.formAvatar.photo == "") {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: "Please upload the picture!",
                    });
                    this.$Progress.fail();
                } else {
                    this.formAvatar.put('/api/customerAvatar/' + this.$route.params.id)
                    .then(() => {
                        $('#avatarCustomer').modal('hide');
                        toast.fire({
                            type: 'success',
                            title: 'Customer profile updated in successfully'
                        })
                        Fire.$emit('reloadData'); 
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        if (this.formAvatar.photo == "") {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: "There was something wrong.",
                            })
                        }
                        this.$Progress.fail();
                    });
                }
            },

            // Price for Format
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            loadCustomer(id = this.$route.params.id) {
                axios.get("/api/customer/" + id )
                .then((response) => {
                    this.customer = response.data
                });
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
                            );
                            this.$Progress.finish();
                            this.$router.push({ name: 'Customers'});
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                            this.$Progress.fail();
                        });
                    }
                })
            },

            // Get Product by Customer ID
            getProduct(cid = this.$route.params.id) {
                axios.get('/api/product/' + cid).then((response) => {
                    this.customerProduct = response.data;
                }).catch((error) => {
                    return 'Customer have no product.';
                });
            },

            // Get Type Name by typeid
            getType(value) {
                axios.get('/api/productType/' + value).then(response => {
                    this.productType  = response.data[0].type_name
                    console.log(productType.data.id)
                    console.log(this.productType)
                }).catch((error) => {
                    return 'Unit Type can not found!';
                });
                return this.productType;
            },

            // Get File by Customer ID
            getCustomerFile(cid = this.$route.params.id){
                axios.get('/api/showFile/' + cid).then((response) => {
                    this.customerFile = response.data;
                    
                }).catch((error) => {
                    return 'File can not found.'
                });
            },

        },
        created() {
            this.$Progress.start();
            this.loadCustomer();
            this.getProduct();
            this.getCustomerFile();
        },
        mounted() {
            this.$Progress.finish();
        },
    }
</script>

<style>
    .hover-image{
        width: 65px;
        height: 65px;
        display: none;
        cursor: pointer;
        background-color: rgba(86, 86, 86, 0.6);
        background-image: url('/img/icon/photo-camera.png');
        background-position: center;
        position: absolute;
        background-repeat: no-repeat;
    }
    .widget-user-image:hover .hover-image{
        display: block;
    }

</style>
