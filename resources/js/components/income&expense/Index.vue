<template>
    <div class="container-fluid">
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
                <div class="tab-content" id="pillOptions">
                    <div class="tab-pane fade active show" id="pillIncome" role="tabpanel" aria-labelledby="tabIncome">
                        <Income></Income>
                    </div>
                    <div class="tab-pane fade" id="pillExpense" role="tabpanel" aria-labelledby="tabExpense">
                        <!-- <Expense></Expense> -->
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</template>

<script>
    import Income from './income/Income.vue'
    import Expense from './expense/Expense.vue'
    export default {
        components:{
            Income,
            Expense
        },
        data() {
            return {
                type: 'income',
            }
        },
        methods: {
            
        },
        created() {
            this.$Progress.start();
        },
        mounted() {
            this.$Progress.finish();
        },
    }
</script>
