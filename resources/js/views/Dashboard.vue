<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">

                <div class="card">
                    <div class="card-header bg-white">
                        <h3 class="card-title mb-0"><i class="nav-icon fas fa-clipboard-list"></i> Incoming Payment</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Loan Number</th>
                                    <th>Customer Code</th>
                                    <th>Customer Name</th>
                                    <th>Payment Due</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white">
                        <h3 class="card-title mb-0"><i class="nav-icon fas fa-clipboard"></i> Late Payment</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Loan Number</th>
                                    <th>Customer Code</th>
                                    <th>Customer Name</th>
                                    <th>Payment Due</th>
                                    <th>Amount</th>
                                    <th>Penalty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header bg-white">
                        <h3 class="card-title mb-0"><i class="nav-icon fas fa-sign-in-alt"></i> Other Income</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Income Type</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white">
                        <h3 class="card-title mb-0"><i class="nav-icon fas fa-sign-out-alt fa-rotate-180"></i> Other Expense</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Expense Type</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
