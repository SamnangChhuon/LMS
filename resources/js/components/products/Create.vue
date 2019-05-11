<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title m-0"><small>Add Product</small></h3>
                        <div class="card-tools">
                            <router-link :to="{name:'Viewcustomer'}" class="btn btn-dark btn-sm" title="Back to Products Table"><i class="fas fa-long-arrow-alt-right"></i></router-link>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 pb-4">
                                <form @submit.prevent="editModeProduct ? updateProduct() : createProduct()" @keydown="formProduct.onKeydown($event)">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Customer ID</strong>
                                            <p>CID {{ customer.id }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Customer Name</strong>
                                            <p v-if="customer.firstname != null && customer.lastname != null">
                                                {{ (customer.sex == 'male') ? 'Mr. ' : 'Ms/Mrs. ' }}{{ customer.firstname + ' ' + customer.lastname }}</p>
                                        </div>
                                    </div>
                                    <hr>
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
                                                <label for="categoryid">Product Category</label>
                                                <div class="input-group">
                                                    <select name="categoryid" v-model="formProduct.categoryid" id="categoryid" class="form-control" :class="{ 'is-valid': formProduct.errors.has('categoryid') }">
                                                        <option value="">Select an option</option>
                                                        <option :value="category.id" v-for="category in categories.data" :key="category.id">{{ category.cate_name }}</option>
                                                    </select>
                                                    <has-error :form="formProduct" field="categoryid"></has-error>
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-success" id="btnCreateCategory" @click="createCategory()" data-toggle="modal" data-target="#createProductCategory"><i class="fas fa-plus"></i></button>
                                                    </span>
                                                </div>
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
                                                <label for="price">Product Price</label>
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
                                                <label for="image">File <small>(.pdf, .doc, .png, .jpg, .jpeg)</small></label>
                                                <div class="input-group">
                                                    <file-upload
                                                    class="btn btn-primary"
                                                    post-action="/upload/post"
                                                    extensions="gif,jpg,jpeg,png,webp"
                                                    accept="image/png,image/gif,image/jpeg,image/webp"
                                                    :multiple="true"
                                                    :size="1024 * 1024 * 10"
                                                    v-model="formImage.file"
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
                                                <label>Do you want to add Promotion ?</label>
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
                                            <label for="" class="text-danger">Note: Existing attachments (images/files) will be replaced.</label>
                                            <ul class="p-0" style="list-style-type:none;">
                                                <li v-for="(img, index) in formImage.file" :key="img.id">
                                                <button @click="removeInputFile(index)" class="btn btn-tool"><i class="fas fa-times"></i></button>
                                                <span>{{img.name}}</span> -
                                                <span>{{img.size | formatSize}}</span> -
                                                <span v-if="img.error">{{img.error}}</span>
                                                <span v-else-if="img.success">success</span>
                                                <span v-else-if="img.active">active</span>
                                                <span v-else-if="img.active">active</span>
                                                <span v-else></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <router-link :to="{name:'Viewcustomer'}" class="btn btn-secondary" title="Back to Customer">Cancel</router-link>
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
                                    <div class="col-md-12 mb-3">
                                        <table style="width:100%">
                                            <tr>
                                                <td><h5>Product Category Table</h5></td>
                                                <td class="fa-pull-right">
                                                    <button type="button" class="btn btn-success" id="btnCreateCategory" @click="createCategory()" data-toggle="modal" data-target="#createProductCategory">New Category <i class="fas fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <table class="table table-hover table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product Category</th>
                                                    <th>Modified Time</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(category, index) in categories.data" :key="category.id">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ category.cate_name }}</td>
                                                    <td>{{ category.created_at | myDate }}</td>
                                                    <td>
                                                        <a href="#" @click="editProductCategory(category)"><i class="fas fa-edit text-info"></i></a>
                                                        |
                                                        <a href="#" @click="deleteProductCategory(category.id)"><i class="fas fa-trash text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <pagination :data="categories" @pagination-change-page="getCategories"></pagination>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
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

        <!-- Model Product Category -->
        <div class="modal fade" id="createProductCategory" tabindex="100" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Creating New Product Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form @submit.prevent="editModeProductCategory ? updateProductCategory() : createProductCategory()" @keydown="formCate.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cate_name">Product Category <span class="text-danger">*</span></label>
                                <input v-model="formCate.cate_name" type="text" name="cate_name" class="form-control" :class="{ 'is-invalid': formCate.errors.has('cate_name')}">
                                <has-error :form="formCate" field="cate_name"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="editModeProductCategory" type="submit" id="btnCreateProductCategory" name="submitCreateProductCategory" class="btn btn-success">Update Category <i class="fas fa-pencil-alt fa-fw"></i></button>
                            <button v-show="!editModeProductCategory" type="submit" id="btnCreateProductCategory" name="submitCreateProductCategory" class="btn btn-primary">Add Category <i class="fas fa-plus fa-fw"></i></button>
                        </div>
                    </form>

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
                    categoryid: '',
                    typeid: '',
                    price: '',
                    image: 'no',
                    promotion: 'no'
                }),
                formCate: new Form({
                    id: '',
                    cate_name: '',
                }),
                formType: new Form({
                    id: '',
                    type_name: ''
                }),
                formImage: new Form({
                    cid: this.$route.params.id,
                    file: [],
                })
            }
        },
        methods: {
            removeInputFile(index) {
                this.formImage.files.splice(index, 1);
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
                }
            },
            inputFile(newFile, oldFile) {
                if (newFile && !oldFile) {
                    // add
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

                if (newFile && !oldFile) {
                    // add
                    console.log('add', newFile)
                }

                // console.log('uploading');
                let file = newFile.target.file[0];
                // console.log(file);
                let reader = new FileReader();

                if (file['size'] < 2111775 ) {
                    reader.onloadend = (file) => {
                        console.log('RESULT', reader.result);
                        this.formImage.file = reader.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: "You are uploading a large file!",
                    })
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
                axios.get("/api/customer/" + id )
                .then((response) => {
                    this.customer = response.data
                });
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
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Product\'s name already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=name]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=name]').removeClass('is-invalid');
                        }, 5000);
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

            // Product Category
            createCategory() {
                this.editModeProductCategory = false;
                this.formCate.clear(); // Clear Errors Form
                this.formCate.reset();  // Clear Input Form
                $('#createProductCategory').modal('show');
            },
            createProductCategory(){
                this.$Progress.start();
                this.formCate.post('/api/productCategory')
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Category\'s already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=cate_name]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=cate_name]').removeClass('is-invalid');
                        }, 5000);
                    } else {
                        Fire.$emit('reloadCategories');
                        $('#createProductCategory').modal('hide');
                        toast.fire({
                            type: 'success',
                            title: 'Category added in successfully'
                        })
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            indexProductCategory() {
                axios.get("/api/productCategory").then(({ data }) => (this.categories = data));
            },
            getCategories(page = 1){
                axios.get('/api/productCategory?page=' + page)
                    .then(response => {
                        this.categories = response.data;
                    });
            },
            editProductCategory(category){
                this.editModeProductCategory = true;
                this.formCate.reset(); // Reset the modal
                this.formCate.clear();
                $('#createProductCategory').modal('show');
                this.formCate.fill(category); // Pass the data to the modal
            },
            updateProductCategory() {
                this.$Progress.start();
                this.formCate.put('/api/productCategory/' + this.formCate.id)
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Category\'s already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=cate_name]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=cate_name]').addClass('is-invalid');
                        }, 4000);
                    } else {
                        Fire.$emit('reloadCategories'); 
                        $('#createProductCategory').modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Category\'s name has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            deleteProductCategory(id) {
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
                        this.formCate.delete('/api/productCategory/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Category\'s has been deleted.',
                                'success'
                            )
                            Fire.$emit('reloadCategories'); // Register new event "reloadData"
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
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

            this.indexProductCategory();
            Fire.$on('reloadCategories', () => {
                this.indexProductCategory();
            });

            this.indexProductType();
            Fire.$on('reloadTypes', () => {
                this.indexProductType();
            });
        }
    }
</script>
