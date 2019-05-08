<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title m-0"><small>Income & Expense</small></h3>
                        <div class="btn-toolbar ml-auto mb-2 mb-md-0">
                            <div class="btn-group mr-2 nav nav-pills">
                                <button type="button" class="btn btn-outline-secondary active" id="tabExpense" data-toggle="pill" href="#pillExpense" role="tab" aria-controls="pillExpense" aria-selected="true">Expense</button>
                                <button type="button" class="btn btn-outline-secondary" id="tabIncome" data-toggle="pill" href="#pillIncome" role="tab" aria-controls="pillIncome" aria-selected="false">Income</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pillOptions">
                            
                            <div class="tab-pane fade active show" id="pillExpense" role="tabpanel" aria-labelledby="tabExpense">
                                <h5 class="pb-3 mb-4">Expense</h5>
                            
                                <form id="formExpense" class="needs-validation" novalidate="">
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                        <div class="col-sm-3">
                                            <select class="custom-select mr-sm-2 d-block w-100 typeSelection" name="type" required=""><option value="">Select an option</option><option value="7">Equipment</option><option value="6">Depreciation</option><option value="5">Utilities</option><option value="4">Rent</option><option value="3">Salaries</option><option value="2">Cost of Goods Sold</option><option value="1">Total Revenue</option></select>
                                            <div class="invalid-feedback">
                                            Please select a type of expense.
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-success" id="btnCreateType" data-toggle="modal" data-target="#createType">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus" style="width:20px;height:20px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="date" name="date" style="width:100%">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-2 col-form-label">Amount <span class="text-danger">*</span></label>
                                        <div class="input-group col-sm-3">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                            </div>
                                            <input class="form-control" type="type" name="amount" placeholder="0.00" required="">
                                            <div class="invalid-feedback">
                                            Please input an amount of expense.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                                        <div class="col-sm-3">
                                            <textarea class="form-control" placeholder="Description" rows="4" name="note"></textarea>
                                        </div>
                                    </div>
                                    <hr class="mt-5">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pillIncome" role="tabpanel" aria-labelledby="tabIncome">
                                <h5 class="pb-3 mb-4">Income</h5>
                                <form id="formIncome" class="needs-validation" novalidate="">
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                        <div class="col-sm-3">
                                            <select class="custom-select mr-sm-2 d-block w-100 typeSelection" name="type" required=""><option value="">Select an Option</option><option value="7">Equipment</option><option value="6">Depreciation</option><option value="5">Utilities</option><option value="4">Rent</option><option value="3">Salaries</option><option value="2">Cost of Goods Sold</option><option value="1">Total Revenue</option></select>
                                            <div class="invalid-feedback">
                                            Please select a type of income.
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-success" id="btnCreateType" data-toggle="modal" data-target="#createType">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus" style="width:20px;height:20px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="date" id="date" name="date" style="width:100%">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-2 col-form-label">Amount <span class="text-danger">*</span></label>
                                        <div class="input-group col-sm-3">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                            </div>
                                            <input class="form-control" type="type" name="amount" value="" placeholder="0.00" required="">
                                            <div class="invalid-feedback">
                                            Please type an amount of income.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                                        <div class="col-sm-3">
                                            <textarea class="form-control" placeholder="Description" name="note" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <hr class="mt-5">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
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
