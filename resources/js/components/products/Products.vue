<template>
    <div class="container-fluid">
        <!-- <bounce-loader></bounce-loader> -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Table</h3>

                        <div class="card-tools">
                            <router-link class="btn btn-success" :to="{name:'AddProduct'}">Add New <i class="fas fa-plus fa-fw"></i></router-link>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Status</th>
                                    <th>Modified Time</th>
                                    <th>Modify</th>
                                </tr>
                                <tr v-for="product in products.data" :key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.code }}</td>
                                    <td>
                                        <span class="right badge badge-success" v-if="product.status === 'available'">{{ product.status | upText }}</span>
                                        <span class="right badge badge-danger" v-else-if="product.status === 'soldout'">{{ product.status | upText }}</span>
                                        <span class="right badge badge-warning" v-else-if="product.status === 'block'">{{ product.status | upText }}</span>
                                    </td>
                                    <td>{{ product.created_at | myDate }}</td>
                                    <td>
                                        <router-link :to="{name: 'addNewProductPage', params: {id: product.id}}"><i class="fas fa-edit text-info"></i></router-link>
                                        |
                                        <a href="#" @click="deleteProduct(product.id)"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="products" @pagination-change-page="getAllProducts"></pagination>
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
                search: '',
                url: null,
                products: {},
                category: {},
            }
        },
        methods: {
            // Search
            searchit: _.debounce(() => {
                Fire.$emit('searching');
            }, 1000),
            getAllProducts(page = 1){
                axios.get('/api/product?page=' + page)
                .then(response => {
                    this.products = response.data;
                })
            },
            loadProducts(){
                axios.get("/api/product").then(({ data }) => (this.products = data));
            },
            deleteProduct(id) {
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
                        this.form.delete('/api/product/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Product has been deleted.',
                                'success'
                            )
                            Fire.$emit('reloadData'); // Register new event "AfterCreate"
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
        },
        created() {
            this.loadProducts();
            Fire.$on('reloadData', () => {
                this.loadProducts();
            });
        },
        // mounted() {
        //     console.log('Component mounted.')
        // }
    }
</script>
