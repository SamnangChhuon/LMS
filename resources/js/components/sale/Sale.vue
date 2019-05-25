<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title m-0">Sale</h3>
                        <div class="btn-toolbar ml-auto mb-2 mb-md-0">
                            <div class="btn-group mr-2 nav nav-pills">
                                <button type="button" class="btn btn-outline-secondary active" id="tabPay" data-toggle="pill" href="#pillPay" role="tab" aria-controls="pillExpense" aria-selected="true" v-on:click="type = 'pay'">Pay</button>
                                <button type="button" class="btn btn-outline-secondary" id="tabRepayment" data-toggle="pill" href="#pillRepayment" role="tab" aria-controls="pillIncome" aria-selected="false" v-on:click="type = 'repayment'">Repayment</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="tab-content" id="pillOptions">
                                
                                <div class="tab-pane fade active show" id="pillPay" role="tabpanel" aria-labelledby="pillPay">
                                    <form>
                                        <div class="col-md-12">
                                            <strong>Detail</strong>
                                            <p>Add information to create sale</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product">Product <span class="text-danger">*</span></label>
                                                        <select v-model="formPay.typeid" name="typeid" class="form-control" :class="{ 'is-valid': formPay.errors.has('typeid') }" @change="onChange($event)">
                                                            <option value="">Please Select Type</option>
                                                            <option :value="product.id" v-for="product in products" :key="product.id">
                                                                {{product.name}}
                                                            </option>
                                                        </select>
                                                        <has-error :form="formPay" field="cid"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pricing">Pricing <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input :value="pricing" type="text" name="pricing" class="form-control" placeholder="0.00" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" :class="{ 'is-valid': formPay.errors.has('promotion') }">
                                                        <label>Do you want to add Promotion for this product ?</label>
                                                        <br>
                                                        <p-radio class="p-default p-round mr-4" name="promotion"
                                                        color="primary-o">Yes</p-radio>
                                                        <p-radio class="p-default p-round" name="promotion"
                                                        color="primary-o" checked>No</p-radio>
                                                        <has-error :form="formPay" field="pmid"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success" id="btnAddPromotion" data-toggle="modal" data-target="#addPromotion">Add Promotion <i class="fas fa-plus"></i></button>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group boxed">
                                                            <div class="input-group-prepend">
                                                                <input type="radio" name="proType" id="soldout" value="soldout" v-model="productStatus">
                                                                <label for="soldout">Sold Out</label>
                                                                <input type="radio" name="proType" id="block" value="block" v-model="productStatus">
                                                                <label for="block">Block</label>
                                                                
                                                            </div>
                                                        </div>
                                                        <label v-if="productStatus === 'block'">Time Period: {{new Date().getDate()}} + plus 1 week </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="productDes">Product Description</label>
                                                        <textarea v-model="formPay.productDes" name="productDes" class="form-control" rows="3" :class="{ 'is-invalid': formPay.errors.has('productDes') }" disabled></textarea>
                                                        <has-error :form="formPay" field="productDes"></has-error>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>Customer</strong>
                                                    <p>Add information to link to Customer</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="cid">Customer <span class="text-danger">*</span></label>
                                                        <select v-model="formPay.cid" name="cid" class="form-control" :class="{ 'is-valid': formPay.errors.has('cid') }">
                                                            <option value="">Please Select Customer</option>
                                                            <option :value="customer.id" v-for="customer in customers" :key="customer.id">
                                                                {{customer.firstname + ' ' + customer.lastname}}
                                                            </option>
                                                        </select>
                                                        <has-error :form="formPay" field="cid"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="custPhone">Personal Phone <span class="text-danger">*</span></label>
                                                        <input v-model="formPay.custPhone" type="text" name="custPhone" class="form-control" :class="{ 'is-invalid': formPay.errors.has('custPhone')}">
                                                        <has-error :form="formPay" field="custPhone"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="personalPhone">Email <span class="text-danger">*</span></label>
                                                        <input v-model="formPay.custEmail" type="text" name="custEmail" class="form-control" :class="{ 'is-invalid': formPay.errors.has('custEmail')}">
                                                        <has-error :form="formPay" field="custEmail"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="custRemark">Remark</label>
                                                        <textarea v-model="formPay.custRemark" name="custRemark" class="form-control" rows="3" :class="{ 'is-invalid': formPay.errors.has('custRemark') }"></textarea>
                                                        <has-error :form="formPay" field="custRemark"></has-error>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div v-if="formPay.loanType == 'pay'" class="col-md-12">
                                                    <strong>Detail</strong>
                                                    <p>Add information in here to create pay</p>
                                                </div>
                                                <div v-if="formPay.loanType == 'repayment'" class="col-md-12">
                                                    <strong>Detail</strong>
                                                    <p>Add information in here to create repayment</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="principalAmount">Principal Amount <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input v-model="formPay.principalAmount" type="text" name="principalAmount" class="form-control" placeholder="0.00"
                                                            :class="{ 'is-invalid': formPay.errors.has('principalAmount')}">
                                                            <has-error :form="formPay" field="principalAmount"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loanReleaseDate">Payment Date <span class="text-danger">*</span></label>
                                                        <input v-model="formPay.loanReleaseDate" type="date" name="loanReleaseDate" class="form-control" :class="{ 'is-invalid': formPay.errors.has('loanReleaseDate')}">
                                                        <has-error :form="formPay" field="loanReleaseDate"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="receivedBy">Repayment Method <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="" id="">
                                                            <option value="">Wing</option>
                                                            <option value="">ABA</option>
                                                            <option value="">Cash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="receivedBy">Sale Incharge <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="" id="">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pillRepayment" role="tabpanel" aria-labelledby="pillRepayment">
                                    <form>
                                        <div class="col-md-12">
                                            <strong>Detail</strong>
                                            <p>Add information to create sale</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product">Product Type<span class="text-danger">*</span></label>
                                                        <select name="" class="form-control">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                        </select>
                                                        <has-error :form="formPay" field="product"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pricing">Pricing <span class="text-danger">*</span></label>
                                                        <input v-model="formPay.pricing" type="text" name="pricing" class="form-control" :class="{ 'is-invalid': formPay.errors.has('pricing')}">
                                                        <has-error :form="formPay" field="pricing"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" :class="{ 'is-valid': formPay.errors.has('promotion') }">
                                                        <label>Do you want to add Promotion for this product ?</label>
                                                        <br>
                                                        <p-radio class="p-default p-round mr-4" v-model="formPay.promotion" name="promotion" value="yes" 
                                                        color="primary-o">Yes</p-radio>
                                                        <p-radio class="p-default p-round" v-model="formPay.promotion" name="promotion" value="no" 
                                                        color="primary-o">No</p-radio>
                                                        <has-error :form="formPay" field="promotion"></has-error>
                                                    </div>
                                                    <div class="form-group" v-if="formPay.promotion == 'yes'">
                                                        <button type="button" class="btn btn-success" id="btnAddPromotion" data-toggle="modal" data-target="#addPromotion">Add Promotion <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="productDes">Product Description</label>
                                                        <textarea v-model="formPay.productDes" name="productDes" class="form-control" rows="3" :class="{ 'is-invalid': formPay.errors.has('productDes') }"></textarea>
                                                        <has-error :form="formPay" field="productDes"></has-error>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    <strong>Customer</strong>
                                                    <p>Add information to link to Customer</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="cid">Customer <span class="text-danger">*</span></label>
                                                        <select name="" class="form-control">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                        </select>
                                                        <has-error :form="formPay" field="cid"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="custPhone">Personal Phone <span class="text-danger">*</span></label>
                                                        <input v-model="formPay.custPhone" type="text" name="custPhone" class="form-control" :class="{ 'is-invalid': formPay.errors.has('custPhone')}">
                                                        <has-error :form="formPay" field="custPhone"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="personalPhone">Email <span class="text-danger">*</span></label>
                                                        <input v-model="formPay.custEmail" type="text" name="custEmail" class="form-control" :class="{ 'is-invalid': formPay.errors.has('custEmail')}">
                                                        <has-error :form="formPay" field="custEmail"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="custRemark">Remark</label>
                                                        <textarea v-model="formPay.custRemark" name="custRemark" class="form-control" rows="3" :class="{ 'is-invalid': formPay.errors.has('custRemark') }"></textarea>
                                                        <has-error :form="formPay" field="custRemark"></has-error>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div v-if="formPay.loanType == 'pay'" class="col-md-12">
                                                    <strong>Detail</strong>
                                                    <p>Add information in here to create pay</p>
                                                </div>
                                                <div v-if="formPay.loanType == 'repayment'" class="col-md-12">
                                                    <strong>Detail</strong>
                                                    <p>Add information in here to create repayment</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="repaymentDate">Schedule Payment <span class="text-danger">*</span></label>
                                                        <input v-model="formRepayment.repaymentDate" type="date" name="repaymentDate" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('repaymentDate')}">
                                                        <has-error :form="formRepayment" field="repaymentDate"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="repaymentAmount">Amount <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                            </div>
                                                            <input v-model="formRepayment.repaymentAmount" type="text" name="repaymentAmount" class="form-control" placeholder="0.00"
                                                            :class="{ 'is-invalid': formRepayment.errors.has('repaymentAmount')}">
                                                            <has-error :form="formRepayment" field="repaymentAmount"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="receivedBy">Payment Cycle <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="" id="">
                                                            <option value="">Monthly</option>
                                                            <option value="">Quarterly</option>
                                                            <option value="">Yearly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="repaymentRemark">Remark</label>
                                                        <textarea v-model="formRepayment.repaymentRemark" name="repaymentRemark" class="form-control" rows="3" :class="{ 'is-invalid': formRepayment.errors.has('repaymentRemark') }"></textarea>
                                                        <has-error :form="formRepayment" field="repaymentRemark"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="receivedBy">Received By <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="" id="">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                        </select>
                                                        <!-- <input v-model="formRepayment.receivedBy" type="text" name="receivedBy" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('receivedBy')}">
                                                        <has-error :form="formRepayment" field="receivedBy"></has-error> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="receivedBy">Repayment Method <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="" id="">
                                                            <option value="">Wing</option>
                                                            <option value="">ABA</option>
                                                            <option value="">Cash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="receivedBy">Sale Incharge <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="" id="">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr>
                                <button type="reset" class="btn btn-danger">Clear</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
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
    export default {
        data() {
            return {
                customers: {},
                products: {},
                pricing: '',
                currentDate: '',
                productStatus: '',
                formPay: new Form({
                    typeid: '',
                    pmid: '',
                    cid: '',
                    loanType: 'pay',
                }),
                formRepayment: new Form({})
            }
        },
        methods: {
            loadCustomers(){
                axios.get("/api/getCustomers").then(({ data }) => (this.customers = data));
            },
            loadProducts(){
                axios.get("/api/getProducts").then(({ data }) => (this.products = data));
            },
            onChange(event){
            }

        },
        created(){
            this.loadProducts();
            this.loadCustomers();
        }
    }
</script>
