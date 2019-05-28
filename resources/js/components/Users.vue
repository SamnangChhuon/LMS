<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal()">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="form-inline">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Search: </span>
                                        </div>
                                        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
                                    </div>
                                    <button class="btn btn-primary mb-2 mr-sm-2" v-on:click="searchit">Go</button>
                                    <button class="btn btn-secondary mb-2" v-on:click="loadUsers">Reset</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-inline fa-pull-right ">
                                    <div class="form-group mb-2">
                                        <label>Sort By: </label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <select v-model="sortBy" class="form-control mx-sm-3" @change="sortUsers">
                                            <option value="">Select an option</option>
                                            <option value="id">ID</option>
                                            <option value="name">Name</option>
                                            <option value="email">Email</option>
                                            <option value="type">Type</option>
                                            <option value="created_at">Registered Date</option>
                                        </select>
                                        <button class="btn btn-link" @click="direction()" v-show="sortDirection === 'asc'"><i class="fas fa-sort-amount-up"></i></button>
                                        <button class="btn btn-link" @click="direction()" v-show="sortDirection === 'desc'"><i class="fas fa-sort-amount-down"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Registered At</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr v-for="user in users.data" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.type | upText }}</td>
                                        <td>{{ user.created_at | myDate }}</td>
                                        <td>
                                            <a href="#" @click="editModal(user)"><i class="fas fa-edit text-info"></i></a>
                                            |
                                            <a href="#" @click="deleteUsers(user.id)"><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Showing record: {{users.from}} to {{users.to}} from {{users.total}} item(s)</p>
                            </div>
                            <div class="col-md-6">
                                <div class="fa-pull-right">
                                    <pagination class="" :data="users" @pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div> -->

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New User</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email" placeholder="Email Address"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.bio" name="bio" id="bio"  placeholder="Short bio for user (Optional)"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-valid': form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update <i class="fas fa-pencil-alt fa-fw"></i></button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create <i class="fas fa-plus fa-fw"></i></button>
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
                editmode: false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                }),
                sortBy: '',
                sortDirection: 'desc',
                search:''
            }
        },
        methods:{
            sortUsers: _.debounce(() => {
                Fire.$emit('sortUsers');
            }, 500),
            direction(){
                if (this.sortDirection == 'asc') {
                    this.sortDirection = 'desc';
                    console.log(this.sortDirection);
                } else {
                    this.sortDirection = 'asc';
                    console.log(this.sortDirection);
                }
            },
            searchit: _.debounce(() => {
                Fire.$emit('searching');
            }, 500),
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
		    },
            updateUser() {
                this.$Progress.start();

                this.form.put('api/user/' + this.form.id)
                .then(() => {
                    // if success
                    $('#addNew').modal('hide');
                    Swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate'); // Register new event "AfterCreate"
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(user) {
                this.editmode = true;
                this.form.reset(); // Reset the modal
                $('#addNew').modal('show');
                this.form.fill(user); // Pass the data to the modal
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUsers(id) {
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
                        this.form.delete('api/user/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterCreate'); // Register new event "AfterCreate"
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            loadUsers() {
                // if (this.$gate.isAdminOrAuthor()) {
                //     axios.get("api/user").then(({ data }) => (this.users = data));
                // }
                    axios.get("/api/user").then(({ data }) => (this.users = data));

            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/user')
                .then(() => {
                    // If Insert Success
                    Fire.$emit('AfterCreate'); // Register new event "AfterCreate"
                    $('#addNew').modal('hide');
    
                    toast.fire({
                        type: 'success',
                        title: 'User created in successfully'
                    })
    
                    this.$Progress.finish();

                })
                .catch(() => {
                    // If not success
                    this.$Progress.fail();
                    
                });
            }
        },
        created() {
            Fire.$on('searching', () => {
                let query = this.search;
                this.$Progress.start();
                axios.get('/api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            });
            Fire.$on('sortUsers', () => {
                let sort = this.sortBy;
                let direction = this.sortDirection;
                this.$Progress.start();
                axios.get('/api/sortUsers?sort=' + sort + '&direction=' + direction )
                .then((data) => {
                    this.users = data.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            });
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            }); // using event AfterCreate
            // setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>
