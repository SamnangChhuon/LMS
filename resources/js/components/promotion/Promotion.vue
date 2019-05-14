<style>
.boxed label {
  display: inline-block;
  width: auto;
  padding: 6px 12px;
  border: solid 1px #ccc;
  transition: all 0.3s;
  cursor: pointer;
}

.boxed input[type="radio"] {
  display: none;
}

.boxed input[type="radio"]:checked + label {
  border: solid 1px #ccc;
  background-color: #3c8dbc;
  color: #fff;
}
.boxed label[for="cash"]{
    margin-right: 0px;
    padding: 6px 15px;
    margin-left: -1px;
}
</style>

<template>
    <form @submit.prevent="editMode ? updatePromotion() : createPromotion()" @keydown="form.onKeydown($event)">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
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
                            <div class="col-md-12">
                                <hr>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="proProduct">Product</label>
                                                        <div class="input-group boxed">
                                                            <div class="input-group-prepend">
                                                                <input type="radio" name="proProduct" id="all" value="all" v-model="formPromotion.proProduct" :class="{ 'is-invalid': formPromotion.errors.has('proProduct') }">
                                                                <label for="all">All</label>
                                                                <input type="radio" name="proProduct" id="specific" value="specific" v-model="formPromotion.proProduct" :class="{ 'is-invalid': formPromotion.errors.has('proProduct') }">
                                                                <label for="specific">Specific</label>
                                                                <has-error :form="formPromotion" field="proProduct"></has-error>
                                                            </div>
                                                            <select name="pid" v-model="formPromotion.pid" class="form-control" :class="{ 'is-valid': formPromotion.errors.has('pid') }">
                                                                <option value="">Select an option</option>
                                                                <option :value="product.id" v-for="product in proProducts.data" :key="product.id">{{ product.name }}</option>
                                                            </select>
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
                </div>
            </div>
            <div class="modal-footer d-block">
                <div class="float-left">
                    <button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
                </div>
                <div class="float-right">
                    <button type="button" @click="resetPromotionForm()" class="btn btn-danger">Clear</button>
                    <button v-show="editModePromotion" type="submit" class="btn btn-success">Update <i class="fas fa-pencil-alt fa-fw"></i></button>
                    <button v-show="!editModePromotion" type="submit" class="btn btn-primary">Save <i class="fas fa-plus fa-fw"></i></button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                editModePromotion: false,
                formPromotion: new Form({
                    name: '',
                    description: '',
                    validFromDate: '',
                    validToDate: '',
                    proType: '',
                    proNumber: '',
                    proProduct: '',
                }),
                proProducts: {},
            }
        },
        methods: {
            resetPromotionForm() {
                this.formPromotion.reset();
                this.formPromotion.clear();
            },

            createPromotion() {
                this.$Progress.start();
                this.form.post('/api/promotion')
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Promotion\'s name already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=firstname]').addClass('is-invalid');
                        $('input[name=lastname]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=firstname]').removeClass('is-invalid');
                            $('input[name=lastname]').removeClass('is-invalid');
                        }, 5000);
                    } else {
                        Fire.$emit('reloadData');
                        $('#addNew').modal('hide');
                        toast.fire({
                            type: 'success',
                            title: 'Customer added in successfully'
                        })
                        this.$Progress.finish();
                    }
                })
                .catch((error) => {
                    this.$Progress.fail();
                    Swal.fire({
                        title: 'Data error!!!',
                        text: error,
                        type: 'error',
                        confirmButtonText: 'Close',
                    });
                });
            },
            updatePromotion(){
                this.$Progress.start();
                this.form.put('/api/promotion/' + this.form.id)
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Promotion\'s name already existed',
                            type: 'error',
                            confirmButtonText: 'Close',
                        })
                        $('input[name=firstname]').addClass('is-invalid');
                        $('input[name=lastname]').addClass('is-invalid');
                        setTimeout(function () { 
                            $('input[name=firstname]').removeClass('is-invalid');
                            $('input[name=lastname]').removeClass('is-invalid');
                        }, 4000);
                    } else {
                        Fire.$emit('reloadData'); 
                        $('#addNew').modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Customer\'s information has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },

            loadProduct(){
                axios.get("/api/product").then(({ data }) => (this.proProducts = data));
            }
        },
        created() {
            this.loadProduct();
        },
    }
</script>
