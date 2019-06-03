<template>
    <div class="container-fluid">
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
                <div class="tab-content" id="pillOptions">
                    <div class="tab-pane fade active show" id="pillPay" role="tabpanel" aria-labelledby="pillPay">
                        <sale></sale>
                    </div>
                    <div class="tab-pane fade" id="pillRepayment" role="tabpanel" aria-labelledby="pillRepayment">
                        <repayment></repayment>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import sale from './Pay.vue'
    import repayment from './Repayment.vue'
    export default {
        component:{
            sale,
            repayment
        },
        created() {
            this.$progress.start();
        },
        mounted() {
            this.$progress.finish();
        },
       
    }
</script>
