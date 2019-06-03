<template>
    <form @submit.prevent="createSale()" @keydown="formPay.onKeydown($event)">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Sale Details</strong>
                        <p>Add information to create sale</p>
                        <div class="row">
                            <div class="col-md-12">
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
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pricing">Pricing <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                        </div>
                                        <input :value="pricing" type="text" name="pricing" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="productDes">Product Description</label>
                                    <textarea v-model="formPay.productDes" name="productDes" class="form-control" rows="3" :class="{ 'is-invalid': formPay.errors.has('productDes') }"></textarea>
                                    <has-error :form="formPay" field="productDes"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <strong>Customer</strong>
                        <p>Add information to link to Customer</p>
                        <div class="row">
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
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
                </div>
                <hr>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <strong>General</strong>
                        <p class="text-muted">Name the promotion and specify the dates for when it will apply</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Promotion Name <span class="text-danger">*</span></label>
                                    <input v-model="formPromotion.name" type="text" name="name" class="form-control"
                                        :class="{ 'is-invalid': formPromotion.errors.has('name') }">
                                    <has-error :form="formPromotion" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea v-model="formPromotion.description" name="description" id="description" class="form-control" rows="5" :class="{ 'is-invalid': formPromotion.errors.has('description') }"></textarea>
                                    <has-error :form="formPromotion" field="description"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-2">Preview</label>
                                <div class="border rounded p-4">
                                    <strong>{{ (formPromotion.name != '') ? formPromotion.name : 'Name of Promotion' }}</strong>
                                    <p>{{ (formPromotion.description != '') ? formPromotion.description : 'Description of Promotion' }}</p>
                                    <hr>
                                    <p class="text-muted">The name and description will be shown to both cashiers and customers, to identify and explain the promotion.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validFromDate">Valid From Date <span class="text-danger">*</span></label>
                                    <input v-model="formPromotion.validFromDate" type="date" name="validFromDate" class="form-control"
                                        :class="{ 'is-invalid': formPromotion.errors.has('validFromDate') }">
                                    <has-error :form="formPromotion" field="validFromDate"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validToDate">Valid To Date <span class="text-danger">*</span></label>
                                    <input v-model="formPromotion.validToDate" type="date" name="validToDate" class="form-control"
                                        :class="{ 'is-invalid': formPromotion.errors.has('validToDate') }">
                                    <has-error :form="formPromotion" field="validToDate"></has-error>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Type of Promotion</strong>
                            <p>Set up the type of promotion you would like to run.</p>
                            <div class="border p-4">
                                <div class="row">
                                    <div class="col-md-2 pt-5 pl-4">
                                        <Strong>GET</Strong>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="proType">Discount</label>
                                                <div class="input-group boxed">
                                                    <div class="input-group-prepend">
                                                        <input type="radio" name="proType" id="percent" value="percent" v-model="formPromotion.proType" :class="{ 'is-invalid': formPromotion.errors.has('proType') }">
                                                        <label for="percent">%</label>
                                                        <input type="radio" name="proType" id="cash" value="cash" v-model="formPromotion.proType" :class="{ 'is-invalid': formPromotion.errors.has('proType') }">
                                                        <label for="cash">$</label>
                                                        <has-error :form="formPromotion" field="proType"></has-error>
                                                    </div>
                                                    <input v-if="formPromotion.proType == 'percent'" type="text" name="proNumber" class="form-control" placeholder="00.00 %" v-model="formPromotion.proNumber" :class="{ 'is-invalid': formPromotion.errors.has('proNumber') }">
                                                    <input v-else-if="formPromotion.proType == 'cash'" type="text" name="proNumber" class="form-control" placeholder="00.00 $" v-model="formPromotion.proNumber" :class="{ 'is-invalid': formPromotion.errors.has('proNumber') }">
                                                    <has-error :form="formPromotion" field="proNumber"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6">
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
                                <option value="">Select an option</option>
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
                                <option value="">Select sale incharge</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>