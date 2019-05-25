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
        <div class="row">
            <div class="col-md-12">

                <div class="card card-widget widget-user-2">
                    <div class="row">
                        <div class="col-md-6">
                           <div class="widget-user-header bg-info-active">
                                <div class="widget-user-image">
                                    <img v-if="customer.sex === 'male'" class="img-circle elevation-2" src="/img/user/none/male_user.png" alt="User Avatar">
                                    <img v-else-if="customer.sex === 'female'" class="img-circle elevation-2" src="/img/user/none/female_user.png" alt="User Avatar">
                                </div>
                                <h3 class="widget-user-username">{{ customer.firstname + ' ' + customer.lastname }}</h3>
                                <h5 class="widget-user-desc">CID {{ customer.id }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fa-pull-right">
                                <div class="btn-group p-2">
                                    <a href="#" class="btn btn-default" @click="editCustomer(customer)" title="Edit"><i class="fas fa-edit text-info"></i> Edit</a>
                                    <a href="#" class="btn btn-default" @click="deleteCustomer(customer.id)" title="Delete"><i class="fas fa-trash text-danger"></i> Delete</a>
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

        <div class="modal fade" id="addFile" tabindex="-1" role="dialog" aria-labelledby="addImage" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Files</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style-type:none;padding:0;">
                            <li>
                                <label for="" class="text-danger">Note: <br>- Existing attachments (images/files) will not allow.<br>- File can not larger than 2MB.<br>*** File name will be change to unique name in database.</label>
                            </li>
                            <li>
                                <div class="text-center p-5">
                                    <h4>Drop files anywhere to upload<br/>or</h4>
                                    <file-upload
                                    class="btn btn-primary"
                                    extensions="gif,jpg,jpeg,png,webp"
                                    accept="image/png,image/gif,image/jpeg,image/webp"
                                    :multiple="true"
                                    :drop="true"
                                    :drop-directory="true"
                                    :size="1024 * 1024 * 10"
                                    v-model="formFile.file"
                                    @input-filter="inputFilter"
                                    @input-file="inputFile"
                                    ref="file">
                                        <i class="fa fa-plus"></i> Select files
                                    </file-upload>
                                </div>
                            </li>
                            <!-- <li>
                                <input type="file" name="file" ref="file" multiple v-on:change="handleFileUpload">
                            </li> -->
                        </ul>
                        <table v-if="formFile.file.length" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:10px;text-align:center">#</th>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(file, index) in formFile.file" :key="file.id">
                                    <td><button @click="removeInputFile(index)" class="btn btn-tool"><i class="fas fa-times"></i></button></td>
                                    <td><span>{{file.name}}</span></td>
                                    <td><span>{{file.size | formatSize}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-show="$refs.files && $refs.files.dropActive" class="drop-active">
                            <h3>Drop files to upload</h3>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal" aria-label="Close">Close</button>
                        <div class="float-right">
                            <button class="btn btn-success" @click.prevent="handleFileUpload" type="submit">Upload File</button>
                        </div>
                    </div>
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
                editMode: false,
                customer: {
                    firstname: '',
                    lastname: '',
                },
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

                files: [],
                formFile: new Form({
                    cid: this.$route.params.id,
                    file: [],
                })
            }
        },
        methods: {
            // Price for Format
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            // Remove Input File
            removeInputFile(index) {
                this.formFile.file.splice(index, 1);
            },
            inputFilter(newFile, oldFile, prevent) {
                if (newFile && !oldFile) {
                    // Before adding a file
                    // Filter system files or hide files
                    if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
                        return prevent()
                    }
                    // Filter php html js file
                    if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                        return prevent()
                    }
                    // Filter large file
                    let e = newFile.file;
                    let reader = new FileReader();
                    if(e['size'] > 2111775){
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'You are uploading a large file!\n' + '"' + newFile.name + '"',
                            confirmButtonText: 'Close'
                        })
                        return prevent();
                    }

                    // Filter Duplicate File
                    this.formFile.file.forEach(element => {
                        if (newFile.file.name === element.name) {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'You are uploading a duplicate file!\n' + '"' + newFile.name + '"',
                                confirmButtonText: 'Close'
                            })
                            return prevent();
                        }
                    });

                    if ( /\s/.test(newFile.name) ) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'The file name must not have space! ' + '"' + newFile.name + '"',
                            confirmButtonText: 'Close'
                        })
                        return prevent();
                    }
                }
            },
            inputFile(newFile, oldFile) {
                if (newFile && !oldFile) {
                    // Filter the file size
                    console.log('add', newFile)
                }
                if (newFile && oldFile) {
                    // update
                    console.log('update', newFile)
                }
                if (!newFile && oldFile) {
                    // remove
                    console.log('remove', oldFile)
                }
            },

            loadCustomer(id = this.$route.params.id) {
                axios.get("/api/customer/" + id )
                .then((response) => {
                    this.customer = response.data
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
                this.form.put('/api/customer/' + this.form.id)
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
                        this.form.delete('/api/customer/' + id).then(() => {
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

            // Add File
            addFile(){
                $('#addFile').modal('show');
                this.formFile.file = [];
            },
            fieldChange(e){
                let selectedFiles=e.target.files;
                console.log("1")
                if(!selectedFiles.length){
                    return false;
                }
                console.log("2")

                for(let i=0; i < selectedFiles.length; i++){
                    this.files.push(selectedFiles[i]);
                }
                console.log("3")

                console.log(this.files);
            },
            inputFileByCustomer(){
                let formData = new FormData();

                for(let i=0; i < this.files.length ; i++){
                    formData.append('files['+ i +']', this.files[i]);
                }

                this.$Progress.start();

                const config = { };
                $('#upload-file').value=[];
                axios.post('/api/file',
                    formData,
                    {
                        data: {
                            cid: this.formFile.cid
                        }
                    })
                .then((response) => {
                    toast.fire({
                        type: 'success',
                        title: 'File added in successfully'
                    })
                    this.$Progress.finish();
                    $('#addFile').modal('show');
                    this.formFile.clear();
                    this.formFile.reset();
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Insert Error!!!',
                        text: 'File can not insert.',
                        type: 'error',
                        confirmButtonText: 'Close',
                    })
                    this.$Progress.fail();
                });
            },

            handleFileUpload(){
                let files = this.$refs.file.files;
                let formData = new FormData();
                let headers = {'Content-Type': 'multipart/form-data'};

                for (let index = 0; index < files.length; index++) {
                    formData.append('files[' + index + ']', files[index]);                    
                }

                this.formFile.post('/api/inputFile/' + this.$route.params.id)
                    .then((response) => {
                        console.log('response', response);
                    })
                    .catch((error) => {
                        console.error(error.response);
                    })
            }
        },
        created() {
            this.$Progress.start();
            this.loadCustomer();
            this.getProduct();
            this.getCustomerFile();
            this.$Progress.finish();
            Fire.$on('reloadData', () => {
                this.loadCustomer();
            }); // using event AfterCreate
        }
    }
</script>
