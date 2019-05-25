<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title m-0"><small>Add Product</small></h3>
                        <div class="card-tools">
                            <router-link v-show="customer!=''" :to="{name:'Viewcustomer'}" class="btn btn-dark btn-sm" title="Back to Customer Profile"><i class="fas fa-long-arrow-alt-right"></i></router-link>
                            <router-link v-show="customer==''" :to="{name:'Products'}" class="btn btn-dark btn-sm" title="Back to Products Table"><i class="fas fa-long-arrow-alt-right"></i></router-link>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 pb-4">
                                <form @submit.prevent="editModeProduct ? updateProduct() : createProduct()" @keydown="formProduct.onKeydown($event)">
                                    <div v-show="customer" class="row">
                                        <div class="col-md-6">
                                            <strong>Customer ID</strong>
                                            <p>CID {{ customer.id }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Customer Name</strong>
                                            <p v-if="customer.firstname != null && customer.lastname != null">
                                                {{ (customer.sex == 'male') ? 'Mr. ' : 'Ms/Mrs. ' }}{{ customer.firstname + ' ' + customer.lastname }}</p>
                                        </div>
                                        <div class="col-md-12"><hr></div>
                                    </div>
                                    <div>
                                        <strong>General</strong>
                                        <p class="text-muted">Change general information for this product</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Name <span class="text-danger">*</span></label>
                                                <input v-model="formProduct.name" type="text" name="name" class="form-control"
                                                :class="{ 'is-invalid': formProduct.errors.has('name')}">
                                                <has-error :form="formProduct" field="name"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">Product Code</label>
                                                <input v-model="formProduct.code" type="text" name="code" class="form-control"
                                                :class="{ 'is-invalid': formProduct.errors.has('code')}">
                                                <has-error :form="formProduct" field="code"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea v-model="formProduct.description" name="description" id="description" class="form-control" rows="3" :class="{ 'is-invalid': formProduct.errors.has('description') }"></textarea>
                                                <has-error :form="formProduct" field="description"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="typeid">Product Type</label>
                                                <div class="input-group">
                                                    <select name="typeid" v-model="formProduct.typeid" id="typeid" class="form-control" :class="{ 'is-valid': formProduct.errors.has('typeid') }">
                                                        <option value="">Select an option</option>
                                                        <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.type_name }}</option>
                                                    </select>
                                                    <has-error :form="formProduct" field="typeid"></has-error>
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Product Price <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                    </div>
                                                    <input v-model="formProduct.price" type="text" name="price" class="form-control" placeholder="0.00"
                                                    :class="{ 'is-invalid': formProduct.errors.has('price')}">
                                                    <has-error :form="formProduct" field="price"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">File Image<small>(.png, .jpg, .jpeg, .webp, .gif)</small></label>
                                                <div class="input-group">
                                                    <file-upload
                                                    class="btn btn-primary"
                                                    post-action="/upload/post"
                                                    extensions="gif,jpg,jpeg,png,webp"
                                                    accept="image/png,image/gif,image/jpeg,image/webp"
                                                    :multiple="true"
                                                    :size="1024 * 1024 * 10"
                                                    v-model="formFile.file"
                                                    @input-filter="inputFilter"
                                                    @input-file="inputFile"
                                                    ref="upload">
                                                    <i class="fa fa-plus"></i> Select File
                                                    </file-upload>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" :class="{ 'is-valid': formProduct.errors.has('promotion') }">
                                                <label>Do you want to add Promotion for this product ?</label>
                                                <br>
                                                <p-radio class="p-default p-round mr-4" v-model="formProduct.promotion" name="promotion" value="yes" 
                                                color="primary-o">Yes</p-radio>
                                                <p-radio class="p-default p-round" v-model="formProduct.promotion" name="promotion" value="no" 
                                                color="primary-o">No</p-radio>
                                                <has-error :form="formProduct" field="promotion"></has-error>
                                            </div>
                                            <div class="form-group" v-if="formProduct.promotion == 'yes'">
                                                <button type="button" class="btn btn-success" id="btnAddPromotion" data-toggle="modal" data-target="#addPromotion">Add Promotion <i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="text-danger">Note: <br>Existing attachments (images/files) will not allow.<br> File can not larger than 2MB.</label>
                                            <ul class="p-0" style="list-style-type:none;">
                                                <li v-for="(file, index) in formFile.file" :key="file.id">
                                                <button @click="removeInputFile(index)" class="btn btn-tool"><i class="fas fa-times"></i></button>
                                                <span>{{file.name}}</span> -
                                                <span>{{file.size | formatSize}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <!-- <router-link v-if="customer!=''" :to="{name:'Viewcustomer'}" class="btn btn-secondary" title="Back to Customer">Cancel</router-link>
                                            <router-link v-else :to="{name:'Products'}" class="btn btn-secondary" title="Back to Products">Cancel</router-link> -->
                                            <div class="float-right">
                                                <button type="button" @click="resetProductForm()" class="btn btn-danger">Clear</button>
                                                <button v-show="editModeProduct" type="submit" class="btn btn-success">Update <i class="fas fa-pencil-alt fa-fw"></i></button>
                                                <button v-show="!editModeProduct" type="submit" class="btn btn-primary">Save <i class="fas fa-plus fa-fw"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <table style="width:100%">
                                            <tr>
                                                <td>
                                                    <h5>Product Type Table</h5>
                                                </td>
                                                <td class="fa-pull-right">
                                                    <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType">New Type <i class="fas fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-hover table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product Type</th>
                                                    <th>Modified Time</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(type, index) in types.data" :key="type.id">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ type.type_name }}</td>
                                                    <td>{{ type.created_at | myDate }}</td>
                                                    <td>
                                                        <a href="#" @click="editProductType(type)"><i class="fas fa-edit text-info"></i></a>
                                                        |
                                                        <a href="#" @click="deleteProductType(type.id)"><i class="fas fa-trash text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <pagination :data="types" @pagination-change-page="getTypes"></pagination>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Model Product Type -->
        <div class="modal fade" id="createProductType" tabindex="100" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Creating New Type Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form @submit.prevent="editModeProductType ? updateProductType() : createProductType()" @keydown="formType.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type_name">Product Type <span class="text-danger">*</span></label>
                                <input v-model="formType.type_name" type="text" name="type_name" class="form-control" :class="{ 'is-invalid': formType.errors.has('type_name')}">
                                <has-error :form="formType" field="type_name"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="editModeProductType" type="submit" id="btnCreateProductType" name="submitCreateProductType" class="btn btn-success">Update Type <i class="fas fa-pencil-alt fa-fw"></i></button>
                            <button v-show="!editModeProductType" type="submit" id="btnCreateProductType" name="submitCreateProductType" class="btn btn-primary">Add Type <i class="fas fa-plus fa-fw"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="addPromotion" tabindex="100" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <promotion></promotion>
            </div>
        </div>

    </div>
</template>

<script>
    import FileUpload from 'vue-upload-component'
    export default {
        components:{
            FileUpload
        },
        data() {
            return {
                customer: {},

                editModeProduct: false,
                editModeProductCategory: false,
                editModeProductType: false,
                product: {},
                categories: {},
                types: {},
                formProduct: new Form({
                    id:'',
                    name: '',
                    code:'',
                    description: '',
                    typeid: '',
                    price: '',
                    promotion: 'no',
                }),
                formType: new Form({
                    id: '',
                    type_name: ''
                }),
                formFile: new Form({
                    cid: this.$route.params.id,
                    file: [],
                })
            }
        },
        methods: {
            // Form File Input
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

            resetProductForm(){
                this.formProduct.reset();
                this.formProduct.clear();
                const input = this.$refs.imageProduct;
                input.type = 'text';
                input.type = 'file';
                this.url = '';
            },
            loadCustomer(id = this.$route.params.id) {
                if (id!='') {
                    axios.get("/api/customer/" + id )
                    .then((response) => {
                        this.customer = response.data
                    });
                }
            },
            // loadProductUpdate(id = this.$route.params.id) {
            //     if (id != null) {
            //         // editModeProduct = true;
            //         axios.get("/api/product/" + id )
            //         .then((response) => {
            //             this.product = response.data
            //             this.formProduct.reset();
            //             this.formProduct.clear();
            //             this.formProduct.fill(this.product);
            //         });
            //     }
            // },
            // Product
            createProduct(){
                this.$Progress.start();
                this.formProduct.post('/api/product')
                .then((response) => {
                    if (response.data.error) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Insert Error!!!',
                            text: 'Product can not insert.',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                    } else {
                        toast.fire({
                            type: 'success',
                            title: 'Product added in successfully'
                        })
                        this.$Progress.finish();
                        this.formProduct.clear();
                        this.formProduct.reset();
                        const input = this.$refs.imageProduct;
                        input.type = 'text';
                        input.type = 'file';
                        this.url = '';
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProduct() {
                this.$Progress.start();
                this.formProduct.put('/api/product/' + this.formProduct.id)
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Product\'s already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=name]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=name]').addClass('is-invalid');
                        }, 4000);
                    } else {
                        Swal.fire(
                            'Updated!',
                            'Product\'s name has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                        this.formProduct.clear();
                        this.formProduct.reset();
                        const input = this.$refs.imageProduct;
                        input.type = 'text';
                        input.type = 'file';
                        this.url = '';
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },

            // Product Type
            createType() {
                this.editModeProductType = false;
                this.formType.clear(); // Clear Errors Form
                this.formType.reset();  // Clear Input Form
                $('#createProductType').modal('show');
            },
            createProductType(){
                this.$Progress.start();
                this.formType.post('/api/productType')
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Type\'s already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=type_name]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=type_name]').removeClass('is-invalid');
                        }, 5000);
                    } else {
                        Fire.$emit('reloadTypes');
                        $('#createProductType').modal('hide');
                        toast.fire({
                            type: 'success',
                            title: 'Type added in successfully'
                        })
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            indexProductType() {
                axios.get("/api/productType").then(({ data }) => (this.types = data));
            },
            getTypes(page = 1){
                axios.get('/api/productType?page=' + page)
                    .then(response => {
                        this.types = response.data;
                    });
            },
            editProductType(type){
                this.editModeProductType = true;
                this.formType.reset(); // Reset the modal
                this.formType.clear();
                $('#createProductType').modal('show');
                this.formType.fill(type); // Pass the data to the modal
            },
            updateProductType() {
                this.$Progress.start();
                this.formType.put('/api/productType/' + this.formType.id)
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Type\'s already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=type_name]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=type_name]').addClass('is-invalid');
                        }, 4000);
                    } else {
                        Fire.$emit('reloadTypes'); 
                        $('#createProductType').modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Type\'s has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            deleteProductType(id) {
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
                        this.formType.delete('/api/productType/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Type\'s has been deleted.',
                                'success'
                            )
                            Fire.$emit('reloadTypes'); // Register new event "reloadData"
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
        },
        created() {
            this.loadCustomer();
            // this.loadProductUpdate();

            this.indexProductType();
            Fire.$on('reloadTypes', () => {
                this.indexProductType();
            });
        }
    }
</script>