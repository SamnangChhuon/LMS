<template>
    <form>
        <div class="row">
            <div class="col-md-6">
                <strong>General</strong>
                <p>Put data in here to create income profile</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cid">Payment ID <span class="text-danger">*</span></label>
                            <input v-model="formExpense.payment_id" type="text" name="payment_id" class="form-control"
                            :class="{ 'is-invalid': formExpense.errors.has('payment_id')}">
                            <has-error :form="formExpense" field="payment_id"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Expense Type <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="type" v-model="formExpense.expense_type_id" class="form-control" :class="{ 'is-valid': formExpense.errors.has('expense_type_id') }">
                                    <option value="">Select an option</option>
                                    <!-- <option :value="type.id" v-for="type in types.data" :key="type.id">{{ type.type_name }}</option> -->
                                </select>
                                <has-error :form="formExpense" field="expense_type_id"></has-error>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success" id="btnCreateType" @click="createType()" data-toggle="modal" data-target="#createProductType"><i class="fas fa-plus"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Expense Date <span class="text-danger">*</span></label>
                            <input v-model="formExpense.expense_date" type="date" name="expense_date" class="form-control"
                            :class="{ 'is-invalid': formExpense.errors.has('expense_date')}">
                            <has-error :form="formExpense" field="expense_date"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Amount <span class="text-danger">*</span></label>
                            <input v-model="formExpense.amount" type="text" name="amount" class="form-control"
                            :class="{ 'is-invalid': formExpense.errors.has('amount')}">
                            <has-error :form="formExpense" field="amount"></has-error>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-model="formExpense.description" name="description" class="form-control" rows="4" :class="{ 'is-invalid': formExpense.errors.has('description') }"></textarea>
                            <has-error :form="formExpense" field="description"></has-error>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table style="width:100%">
                    <tr>
                        <td>
                            <h5>Expense Type Table</h5>
                        </td>
                        <td class="fa-pull-right">
                            <button type="button" class="btn btn-success" @click="createExpenseType()" data-toggle="modal" data-target="#createExpenseType">New Type <i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </table>
                <table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Expense Type</th>
                            <th>Modified Time</th>
                            <th>Modify</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr v-for="(type, index) in types.data" :key="type.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ type.type_name }}</td>
                            <td>{{ type.created_at | myDate }}</td>
                            <td>
                                <a href="#" @click="editProductType(type)"><i class="fas fa-edit text-info"></i></a>
                                |
                                <a href="#" @click="deleteProductType(type.id)"><i class="fas fa-trash text-danger"></i></a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
                <pagination :data="expenseTypes" @pagination-change-page="getExpenseType"></pagination>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            formExpense: new Form({
                payment_id: '',
                expense_type_id:'',
                expense_date:'',
                amount:'',
                description:'',
            })
        }
    },
}
</script>