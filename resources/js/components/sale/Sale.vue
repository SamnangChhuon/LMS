<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title m-0">Sale</h3>
                        <!-- <div class="card-tools">
                            <router-link :to="{name:'Sale'}" class="btn btn-dark btn-sm" title="Back to Products Table"><i class="fas fa-long-arrow-alt-right"></i></router-link>
                        </div> -->
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Detail</strong>
                                    <p>Add information to create sale</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="saleDate">Sale Date <span class="text-danger">*</span></label>
                                                <input v-model="formSale.saleDate" type="text" name="saleDate" class="form-control" :class="{ 'is-invalid': formSale.errors.has('saleDate')}">
                                                <has-error :form="formSale" field="saleDate"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product">Product <span class="text-danger">*</span></label>
                                                <input v-model="formSale.product" type="text" name="product" class="form-control" :class="{ 'is-invalid': formSale.errors.has('product')}">
                                                <has-error :form="formSale" field="product"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pricing">Pricing <span class="text-danger">*</span></label>
                                                <input v-model="formSale.pricing" type="text" name="pricing" class="form-control" :class="{ 'is-invalid': formSale.errors.has('pricing')}">
                                                <has-error :form="formSale" field="pricing"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="productDes">Product Description</label>
                                                <textarea v-model="formSale.productDes" name="productDes" class="form-control" rows="3" :class="{ 'is-invalid': formSale.errors.has('productDes') }"></textarea>
                                                <has-error :form="formSale" field="productDes"></has-error>
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
                                                <input v-model="formSale.cid" type="text" name="cid" class="form-control" :class="{ 'is-invalid': formSale.errors.has('cid')}">
                                                <has-error :form="formSale" field="cid"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="custPhone">Personal Phone <span class="text-danger">*</span></label>
                                                <input v-model="formSale.custPhone" type="text" name="custPhone" class="form-control" :class="{ 'is-invalid': formSale.errors.has('custPhone')}">
                                                <has-error :form="formSale" field="custPhone"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="personalPhone">Email <span class="text-danger">*</span></label>
                                                <input v-model="formSale.custEmail" type="text" name="custEmail" class="form-control" :class="{ 'is-invalid': formSale.errors.has('custEmail')}">
                                                <has-error :form="formSale" field="custEmail"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="custRemark">Remark</label>
                                                <textarea v-model="formSale.custRemark" name="custRemark" class="form-control" rows="3" :class="{ 'is-invalid': formSale.errors.has('custRemark') }"></textarea>
                                                <has-error :form="formSale" field="custRemark"></has-error>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Loan</strong>
                                            <p>Add information in here to create loan repayment</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" :class="{ 'is-valid': formSale.errors.has('loanType') }">
                                                <br>
                                                <p-radio class="p-default p-round" v-model="formSale.loanType" name="loanType" value="pay" 
                                                color="primary-o">Pay</p-radio>
                                                <p-radio class="p-default p-round" v-model="formSale.loanType" name="loanType" value="repayment" 
                                                color="primary-o">Repayment</p-radio>
                                                <has-error :form="formSale" field="loanType"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Principal</strong>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="loadDisburse">Disbursed By <span class="text-danger">*</span></label>
                                                        <input v-model="formSale.loadDisburse" type="text" name="loadDisburse" class="form-control" :class="{ 'is-invalid': formSale.errors.has('loadDisburse')}">
                                                        <has-error :form="formSale" field="loadDisburse"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="principalAmount">Principal Amount <span class="text-danger">*</span></label>
                                                        <input v-model="formSale.principalAmount" type="text" name="principalAmount" class="form-control" :class="{ 'is-invalid': formSale.errors.has('principalAmount')}">
                                                        <has-error :form="formSale" field="principalAmount"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loanReleaseDate">Loan Release Date <span class="text-danger">*</span></label>
                                                        <input v-model="formSale.loanReleaseDate" type="text" name="loanReleaseDate" class="form-control" :class="{ 'is-invalid': formSale.errors.has('loanReleaseDate')}">
                                                        <has-error :form="formSale" field="loanReleaseDate"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Interest</strong>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="interestMethod">Interest Method <span class="text-danger">*</span></label>
                                                        <input v-model="formSale.interestMethod" type="text" name="interestMethod" class="form-control" :class="{ 'is-invalid': formSale.errors.has('interestMethod')}">
                                                        <has-error :form="formSale" field="interestMethod"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>Interest Type</p>
                                                    <div class="form-group" :class="{ 'is-valid': formSale.errors.has('interestType') }">
                                                        <br>
                                                        <p-radio class="p-default p-round" v-model="formSale.interestType" name="interestType" value="percentage" 
                                                        color="primary-o">I want interest to be percentage & base</p-radio>
                                                        <p-radio class="p-default p-round" v-model="formSale.interestType" name="interestType" value="fixed" 
                                                        color="primary-o">I want interest to be fixed amount per cycle</p-radio>
                                                        <has-error :form="formSale" field="interestType"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loanInterestAmount">Loan Interest Amount <span class="text-danger">*</span></label>
                                                        <input v-model="formSale.loanInterestAmount" type="text" name="loanInterestAmount" class="form-control" :class="{ 'is-invalid': formSale.errors.has('loanInterestAmount')}">
                                                        <has-error :form="formSale" field="loanInterestAmount"></has-error>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loanPeriod">Loan Interest Amount <span class="text-danger">*</span></label>
                                                        <select name="loanPeriod" v-model="formSale.loanPeriod" class="form-control" :class="{ 'is-valid': formSale.errors.has('loanPeriod') }">
                                                            <option value="">Select an option</option>
                                                            <option value="day">Per Day</option>
                                                            <option value="week">Per Week</option>
                                                            <option value="month">Per Month</option>
                                                            <option value="year">Per Year</option>
                                                        </select>
                                                        <has-error :form="formSale" field="loanPeriod"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Repayment</strong>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="repaymentCycle">Repayment Cycle <span class="text-danger">*</span></label>
                                                        <select name="repaymentCycle" v-model="formSale.repaymentCycle" class="form-control" :class="{ 'is-valid': formSale.errors.has('repaymentCycle') }">
                                                            <option value="">Select an option</option>
                                                            <option value="monthly">Monthly</option>
                                                            <option value="quaterly">Quarterly</option>
                                                            <option value="yearly">Yearly</option>
                                                        </select>
                                                        <has-error :form="formSale" field="repaymentCycle"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Collateral Register</strong>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="collateralType">Collateral Type <span class="text-danger">*</span></label>
                                                        <select name="collateralType" v-model="formSale.collateralType" class="form-control" :class="{ 'is-valid': formSale.errors.has('collateralType') }">
                                                            <option value="">Select an option</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                        <has-error :form="formSale" field="collateralType"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <button type="reset" class="btn btn-danger">Clear</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
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
                formSale: new Form({
                    
                })
            }
        },
    }
</script>
