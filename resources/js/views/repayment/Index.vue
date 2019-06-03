<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title m-0">Repayment</h3>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Detail</strong>
                                    <p>Add information to create repayment</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="loanNumber">Loan Number <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.loanNumber" type="text" name="loanNumber" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('loanNumber')}">
                                                <has-error :form="formRepayment" field="loanNumber"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="repaymentSchedule">Payment Schedule <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.repaymentSchedule" type="text" name="repaymentSchedule" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('repaymentSchedule')}">
                                                <has-error :form="formRepayment" field="repaymentSchedule"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="loanAmount">Amount <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.loanAmount" type="text" name="loanAmount" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('loanAmount')}">
                                                <has-error :form="formRepayment" field="loanAmount"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="loanRemark">Remark</label>
                                                <textarea v-model="formRepayment.loanRemark" name="loanRemark" class="form-control" rows="3" :class="{ 'is-invalid': formRepayment.errors.has('loanRemark') }"></textarea>
                                                <has-error :form="formRepayment" field="loanRemark"></has-error>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <strong>Repayment</strong>
                                    <p>Add information to link to create repayment</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="repaymentDate">Repayment Date <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.repaymentDate" type="text" name="repaymentDate" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('repaymentDate')}">
                                                <has-error :form="formRepayment" field="repaymentDate"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="repaymentAmount">Amount <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.repaymentAmount" type="text" name="repaymentAmount" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('repaymentAmount')}">
                                                <has-error :form="formRepayment" field="repaymentAmount"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="repaymentPenalty">Penalty <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.repaymentPenalty" type="text" name="repaymentPenalty" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('repaymentPenalty')}">
                                                <has-error :form="formRepayment" field="repaymentPenalty"></has-error>
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
                                                <input v-model="formRepayment.receivedBy" type="text" name="receivedBy" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('receivedBy')}">
                                                <has-error :form="formRepayment" field="receivedBy"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="otherCharge">Other Charge <span class="text-danger">*</span></label>
                                                <input v-model="formRepayment.otherCharge" type="text" name="otherCharge" class="form-control" :class="{ 'is-invalid': formRepayment.errors.has('otherCharge')}">
                                                <has-error :form="formRepayment" field="otherCharge"></has-error>
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
                formRepayment: new Form({
                    
                })
            }
        },
    }
</script>
