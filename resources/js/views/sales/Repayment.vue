<template>
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
                        <label for="repayment_method">Repayment Method <span class="text-danger">*</span></label>
                        <select class="form-control" name="repayment_method">
                            <option value="" selected>Select an option</option>
                            <option value="1">Wing</option>
                            <option value="2">ABA</option>
                            <option value="3">Cash</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sale_incharge">Sale Incharge <span class="text-danger">*</span></label>
                        <select class="form-control" name="sale_incharge">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>