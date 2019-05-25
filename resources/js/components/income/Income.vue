<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title m-0">{{ (type == 'expense') ? 'Expense' : 'Income' }}</h3>
                        <div class="btn-toolbar ml-auto mb-2 mb-md-0">
                            <div class="btn-group mr-2 nav nav-pills">
                                <button type="button" class="btn btn-outline-secondary active" id="tabIncome" data-toggle="pill" href="#pillIncome" role="tab" aria-controls="pillIncome" aria-selected="false" v-on:click="type = 'income'">Income</button>
                                <button type="button" class="btn btn-outline-secondary" id="tabExpense" data-toggle="pill" href="#pillExpense" role="tab" aria-controls="pillExpense" aria-selected="true" v-on:click="type = 'expense'">Expense</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-5">
                                <strong>General</strong>
                                <p>Put data in here to create income profile</p>
                                <div class="tab-content" id="pillOptions">
                                    <div class="tab-pane fade" id="pillExpense" role="tabpanel" aria-labelledby="tabExpense">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="cid">Payment ID <span class="text-danger">*</span></label>
                                                        <input v-model="formIncome.cid" type="text" name="cid" class="form-control"
                                                        :class="{ 'is-invalid': formIncome.errors.has('cid')}">
                                                        <has-error :form="formIncome" field="cid"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Expense Type <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select name="type" v-model="formIncome.type" id="type" class="form-control" :class="{ 'is-valid': formIncome.errors.has('type') }">
                                                                <option value="">Select an option</option>
                                                                <!-- <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.type_name }}</option> -->
                                                            </select>
                                                            <has-error :form="formIncome" field="type"></has-error>
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Expense Date <span class="text-danger">*</span></label>
                                                        <input v-model="formIncome.date" type="date" name="date" class="form-control"
                                                        :class="{ 'is-invalid': formIncome.errors.has('date')}">
                                                        <has-error :form="formIncome" field="date"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                                        <input v-model="formIncome.amount" type="text" name="amount" class="form-control"
                                                        :class="{ 'is-invalid': formIncome.errors.has('amount')}">
                                                        <has-error :form="formIncome" field="amount"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea v-model="formIncome.description" name="description" id="description" class="form-control" rows="4" :class="{ 'is-invalid': formIncome.errors.has('description') }"></textarea>
                                                        <has-error :form="formIncome" field="description"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade active show" id="pillIncome" role="tabpanel" aria-labelledby="tabIncome">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="cid">Payment ID <span class="text-danger">*</span></label>
                                                        <input v-model="formExpense.cid" type="text" name="cid" class="form-control"
                                                        :class="{ 'is-invalid': formExpense.errors.has('cid')}">
                                                        <has-error :form="formExpense" field="cid"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Income Type <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select name="type" v-model="formExpense.type" id="type" class="form-control" :class="{ 'is-valid': formExpense.errors.has('type') }">
                                                                <option value="">Select an option</option>
                                                                <!-- <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.type_name }}</option> -->
                                                            </select>
                                                            <has-error :form="formExpense" field="type"></has-error>
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Income Date <span class="text-danger">*</span></label>
                                                        <input v-model="formExpense.date" type="date" name="date" class="form-control"
                                                        :class="{ 'is-invalid': formExpense.errors.has('date')}">
                                                        <has-error :form="formExpense" field="date"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input v-model="formExpense.amount" type="text" name="amount" class="form-control" placeholder="0.00"
                                                            :class="{ 'is-invalid': formExpense.errors.has('amount')}">
                                                            <has-error :form="formExpense" field="amount"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea v-model="formExpense.description" name="description" id="description" class="form-control" rows="4" :class="{ 'is-invalid': formExpense.errors.has('description') }"></textarea>
                                                        <has-error :form="formExpense" field="description"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </form>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                type: 'expense',
                formIncome: new Form({
                    cid: ''
                }),
                formExpense: new Form({
                    
                })
            }
        },
        methods: {
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
                        this.formIncome.clear();
                        this.formIncome.reset();
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            }
        },
        created() {
            
        },
    }
</script>
