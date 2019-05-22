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
                                                        <input v-model="form.cid" type="text" name="cid" class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('cid')}">
                                                        <has-error :form="form" field="cid"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Expense Type <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-valid': form.errors.has('type') }">
                                                                <option value="">Select an option</option>
                                                                <!-- <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.type_name }}</option> -->
                                                            </select>
                                                            <has-error :form="form" field="type"></has-error>
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Expense Date <span class="text-danger">*</span></label>
                                                        <input v-model="form.date" type="text" name="date" class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('date')}">
                                                        <has-error :form="form" field="date"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                                        <input v-model="form.amount" type="text" name="amount" class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('amount')}">
                                                        <has-error :form="form" field="amount"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea v-model="form.description" name="description" id="description" class="form-control" rows="4" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                                        <has-error :form="form" field="description"></has-error>
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
                                                        <input v-model="form.cid" type="text" name="cid" class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('cid')}">
                                                        <has-error :form="form" field="cid"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Income Type <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-valid': form.errors.has('type') }">
                                                                <option value="">Select an option</option>
                                                                <!-- <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.type_name }}</option> -->
                                                            </select>
                                                            <has-error :form="form" field="type"></has-error>
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Income Date <span class="text-danger">*</span></label>
                                                        <input v-model="form.date" type="text" name="date" class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('date')}">
                                                        <has-error :form="form" field="date"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                                        <input v-model="form.amount" type="text" name="amount" class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('amount')}">
                                                        <has-error :form="form" field="amount"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea v-model="form.description" name="description" id="description" class="form-control" rows="4" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                                        <has-error :form="form" field="description"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-7">
                                <strong>Customer ID</strong>
                                <p>CID</p>
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
                form: new Form({

                }),
            }
        },
    }
</script>
