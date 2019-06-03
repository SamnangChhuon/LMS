<template>
    <div>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <strong>General</strong>
                    <p>Put data in here to create income profile</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cid">Payment ID <span class="text-danger">*</span></label>
                                <input v-model="formIncome.payment_id" type="text" name="payment_id" class="form-control"
                                :class="{ 'is-invalid': formIncome.errors.has('payment_id')}">
                                <has-error :form="formIncome" field="payment_id"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Income Type <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select name="type" v-model="formIncome.income_type_id" class="form-control" :class="{ 'is-valid': formIncome.errors.has('income_type_id') }">
                                        <option value="">Select an option</option>
                                        <!-- <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.name }}</option> -->
                                    </select>
                                    <has-error :form="formIncome" field="income_type_id"></has-error>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Income Date <span class="text-danger">*</span></label>
                                <input v-model="formIncome.income_date" type="date" name="income_date" class="form-control"
                                :class="{ 'is-invalid': formIncome.errors.has('income_date')}">
                                <has-error :form="formIncome" field="income_date"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount">Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                    </div>
                                    <input v-model="formIncome.amount" type="text" name="amount" class="form-control" placeholder="0.00"
                                    :class="{ 'is-invalid': formIncome.errors.has('amount')}">
                                    <has-error :form="formIncome" field="amount"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="formIncome.description" name="description" class="form-control" rows="4" :class="{ 'is-invalid': formIncome.errors.has('description') }"></textarea>
                                <has-error :form="formIncome" field="description"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <h5>Income Type Table</h5>
                            </td>
                            <td class="fa-pull-right">
                                <button type="button" class="btn btn-success" @click="createIncomeType()" data-toggle="modal" data-target="#createIncomeType">New Type <i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Income Type</th>
                                <th>Modified Time</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(type, index) in incomeTypes.data" :key="type.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ type.name }}</td>
                                <td>{{ type.created_at | myDate }}</td>
                                <td>
                                    <a href="#" @click="editIncomeType(type)"><i class="fas fa-edit text-info"></i></a>
                                    |
                                    <a href="#" @click="deleteIncomeType(type.id)"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="incomeTypes" @pagination-change-page="getIncomeTypes"></pagination>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Model Product Type -->
        <div class="modal fade" id="createIncomeType" tabindex="100" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Creating New Income Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form @submit.prevent="incomeTypeEditMode ? updateIncomeType() : createIncomeType()" @keydown="formIncomeType.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type_name">Product Type <span class="text-danger">*</span></label>
                                <input v-model="formIncomeType.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': formIncomeType.errors.has('name')}">
                                <has-error :form="formIncomeType" field="name"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <button v-show="incomeTypeEditMode" type="submit" class="btn btn-success">Update Type <i class="fas fa-pencil-alt fa-fw"></i></button>
                            <button v-show="!incomeTypeEditMode" type="submit" class="btn btn-primary">Add Type <i class="fas fa-plus fa-fw"></i></button>
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
            incomeEditMode: false,
            formIncome: new Form({
                payment_id: '',
                income_type_id:'',
                income_date:'',
                amount:'',
                description:'',
            }),

            incomeTypeEditMode: false,
            incomeTypes:{},
            formIncomeType: new Form({
                name:''
            })
        }
    },
    methods: {

        //Income
        createIncome(){
            this.$Progress.start();
            this.formIncome.post('/api/income')
            .then((response) => {
                if (response.data.error) {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Insert Error!!!',
                        text: 'Income can not insert.',
                        type: 'error',
                        confirmButtonText: 'Close',
                    })
                } else {
                    toast.fire({
                        type: 'success',
                        title: 'Income added in successfully'
                    })
                    this.$Progress.finish();
                    this.formIncome.clear();
                    this.formIncome.reset();
                }
            })
            .catch(() => {
                this.$Progress.fail();
            });
        },
        updateIncome() {
            this.$Progress.start();
            this.formIncome.put('/api/income/' + this.formIncome.id)
            .then((response) => {
                if (response.data.existed) {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Duplicate Data!!!',
                        text: 'Income\'s already existed',
                        type: 'error',
                        confirmButtonText: 'Close',
                    });
                } else {
                    Swal.fire(
                        'Updated!',
                        'Income\'s name has been updated.',
                        'success'
                    )
                    this.$Progress.finish();
                    this.formIncome.clear();
                    this.formIncome.reset();
                }
            })
            .catch(() => {
                this.$Progress.fail();
            });
        },

        // Type of Income
        createType() {
            this.incomeTypeEditMode = false;
            this.formIncomeType.clear(); // Clear Errors Form
            this.formIncomeType.reset();  // Clear Input Form
            $('#createIncomeType').modal('show');
        },
        createIncomeType(){
            this.$Progress.start();
            this.formType.post('/api/incomeType')
            .then((response) => {
                if (response.data.existed) {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Duplicate Data!!!',
                        text: 'Type\'s already existed',
                        type: 'error',
                        confirmButtonText: 'Close',
                    })
                    $('input[name=name]').addClass('is-invalid');
                    setTimeout(function () { 
                        $('input[name=name]').removeClass('is-invalid');
                    }, 5000);
                } else {
                    Fire.$emit('reloadTypes');
                    $('#createIncomeType').modal('hide');
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
        indexIncomeType() {
            axios.get("/api/incomeType").then(({ data }) => (this.incomeTypes = data));
        },
        getIncomeTypes(page = 1){
            axios.get('/api/incomeType?page=' + page)
            .then(response => {
                this.incomeTypes = response.data;
            });
        },
        editIncomeType(value){
            this.incomeTypeEditMode = true;
            this.formIncomeType.reset(); // Reset the modal
            this.formIncomeType.clear();
            $('#createIncomeType').modal('show');
            this.formIncomeType.fill(value); // Pass the data to the modal
        },
        updateIncomeType() {
            this.$Progress.start();
            this.formIncomeType.put('/api/productType/' + this.formIncomeType.id)
            .then((response) => {
                if (response.data.existed) {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Duplicate Data!!!',
                        text: 'Type\'s already existed',
                        type: 'error',
                        confirmButtonText: 'Close',
                    })
                    $('input[name=name]').addClass('is-invalid');
                    setTimeout(function () { 
                        $('input[name=name]').addClass('is-invalid');
                    }, 4000);
                } else {
                    Fire.$emit('reloadTypes'); 
                    $('#createIncomeType').modal('hide');
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
        deleteIncomeType(id) {
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
                    this.formIncomeType.delete('/api/productType/' + id).then(() => {
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
        created() {
            this.indexIncomeType();
            Fire.$on('reloadTypes', () => {
                this.indexIncomeType();
            });
        },
    },
}
</script>