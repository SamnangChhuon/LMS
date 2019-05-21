<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Customers Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="addNewCustomer() , collapseToggle()">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="form-inline">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Search: </span>
                                        </div>
                                        <input class="form-control" v-model="searchFor" @keyup.enter="setFilter">
                                    </div>
                                    <button class="btn btn-primary mb-2 mr-sm-2" @click="setFilter">Go</button>
                                    <button class="btn btn-secondary mb-2" @click="resetFilter">Reset</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fa-pull-right">
                                    <button class="btn btn-light" id="settingsBtn" @click="showSettingsModal">
                                    <i class="fas fa-cog"></i> Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive pb-3 border-top">

                            <vuetable ref="vuetable"
                            class="table table-hover"
                            api-url="http://127.0.0.1:8000/api/customer"
                            :fields="fields"
                            pagination-path="pagination"
                            :css="css.table"
                            :sort-order="sortOrder"
                            :multi-sort="multiSort"
                            :per-page="perPage"
                            :append-params="moreParams"
                            detail-row-component="my-detail-row"
                            detail-row-transition="expand"
                            :row-class="rowClassCB"
                            @vuetable:pagination-data="onPaginationData"
                            @vuetable:load-success="onLoadSuccess"
                            @vuetable:loading="showLoader"
                            @vuetable:loaded="hideLoader"
                            @vuetable:cell-clicked="onCellClicked"
                            @vuetable:data-reset="onDataReset"
                            ></vuetable>
                            <div class="p-2 vuetable-pagination">
                                <vuetable-pagination-info ref="paginationInfo"
                                info-class="pagination-info"
                                    :info-template="paginationInfoTemplate"
                                ></vuetable-pagination-info>
                                <component :is="paginationComponent" ref="pagination"
                                :css="css.pagination"
                                    @vuetable-pagination:change-page="onChangePage"
                                ></component>
                            </div>
                            <settings-modal ref="settingsModal"
                                :vuetable-fields="vuetableFields"
                            ></settings-modal>

                            <!-- <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>CID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Type</th>
                                        <th>Business Phone</th>
                                        <th>Personal Phone</th>
                                        <th>Registered At</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr v-for="customer in customers.data" :key="customer.id">
                                        <td><router-link :to="{name: 'Viewcustomer', params: {id: customer.id}}">{{ customer.id }}</router-link></td>
                                        <td>{{ customer.firstname }}</td>
                                        <td>{{ customer.lastname }}</td>
                                        <td>{{ customer.type | upText }}</td>
                                        <td>{{ customer.businessphone }}</td>
                                        <td>{{ customer.personalphone }}</td>
                                        <td>{{ customer.created_at | myDate }}</td>
                                        <td>
                                            <a href="#" @click="editCustomer(customer)" title="Edit"><i class="fas fa-edit text-info"></i></a>
                                            |
                                            <a href="#" @click="deleteCustomer(customer.id)" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <!-- <pagination :data="customers" @pagination-change-page="getAllCustomer"></pagination> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewCustomer" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-show="!editMode" id="addNewCustomer">Add New Customer</h4>
                        <h4 class="modal-title" v-show="editMode" id="addNewCustomer">Update Customer's Info</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateCustomer() : createCustomer()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <strong>Detail</strong>
                            <p class="text-muted">Add information to create a customer</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name <span class="text-danger">*</span></label>
                                        <input v-model="form.firstname" type="text" name="firstname" class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('firstname')}">
                                        <has-error :form="form" field="firstname"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                        <input v-model="form.lastname" type="text" name="lastname" class="form-control"
                                         :class="{'is-invalid': form.errors.has('lastname')}">
                                        <has-error :form="form" field="lastname"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyname">Company Name</label>
                                        <input v-model="form.companyname" type="text" name="companyname" class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('companyname') }">
                                        <has-error :form="form" field="companyname"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Customer Type</label>
                                        <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-valid': form.errors.has('type') }">
                                            <option value="">Select an option</option>
                                            <option value="acquired">Acquired</option>
                                            <option value="active">Active</option>
                                            <option value="marketFailed">Market Failed</option>
                                            <option value="projectCancelled">Project Cancelled</option>
                                            <option value="shutdown">Shutdown</option>
                                        </select>
                                        <has-error :form="form" field="type"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input v-model="form.dob" type="text" name="dob" class="form-control" v-mask="{mask: '99/99/9999', greedy: true, alias:'mm/dd/yyyy'}" :class="{ 'is-invalid': form.errors.has('dob') }"/>
                                        <has-error :form="form" field="dob"></has-error>
                                    </div>
                                    <div class="form-group" :class="{ 'is-valid': form.errors.has('sex') }">
                                        <br>
                                        <p-radio class="p-default p-round" v-model="form.sex" name="sex" value="male" 
                                        color="primary-o">Male</p-radio>
                                        <p-radio class="p-default p-round" v-model="form.sex" name="sex" value="female" 
                                        color="primary-o">Female</p-radio>
                                        <has-error :form="form" field="sex"></has-error>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a class="text-primary" data-toggle="collapse" href="#contactInformation" role="button" aria-expanded="false" aria-controls="contactInformation"><strong>Contact Information</strong> <i class="fas fa-angle-double-right"></i></a>
                            <div class="collapse" id="contactInformation" v-bind:class="{show:editMode}">
                                <p class="text-muted">Add information to create a contact</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="businessphone">Business Phone</label>
                                            <input v-model="form.businessphone" type="businessphone"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('businessphone') }">
                                            <has-error :form="form" field="businessphone"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="personalphone">Personal Phone</label>
                                            <input v-model="form.personalphone" type="personalphone" name="personalphone"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('personalphone') }">
                                            <has-error :form="form" field="personalphone"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input v-model="form.fax" type="fax" name="fax"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('fax') }">
                                            <has-error :form="form" field="fax"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input v-model="form.email" type="email" name="email"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input v-model="form.website" type="website" name="website"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('website') }">
                                            <has-error :form="form" field="website"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input v-model="form.twitter" type="twitter" name="twitter"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('twitter') }">
                                            <has-error :form="form" field="twitter"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="line">Line</label>
                                            <input v-model="form.line" type="line" name="line"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('line') }">
                                            <has-error :form="form" field="line"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="remarkcontact">Remark</label>
                                            <textarea v-model="form.remarkcontact" name="remarkcontact" id="remarkcontact"
                                            class="form-control" rows="1" :class="{ 'is-invalid': form.errors.has('remarkcontact') }"></textarea>
                                            <has-error :form="form" field="remarkcontact"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a class="text-primary" data-toggle="collapse" href="#addressInformation" role="button" aria-expanded="false" aria-controls="addressInformation"><strong>Physical Address Information</strong> <i class="fas fa-angle-double-right"></i></a>
                            <div class="collapse" id="addressInformation" v-bind:class="{show:editMode}">
                                <p class="text-muted">Add information to create a physical address</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postalcode">Postal Code</label>
                                            <input v-model="form.postalcode" type="postalcode" name="postalcode"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('postalcode') }">
                                            <has-error :form="form" field="postalcode"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <textarea v-model="form.street" name="street" id="street"
                                            class="form-control" rows="2" :class="{ 'is-invalid': form.errors.has('street') }"></textarea>
                                            <has-error :form="form" field="street"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input v-model="form.city" type="city" name="city"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                            <has-error :form="form" field="city"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input v-model="form.country" type="country" name="country"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                            <has-error :form="form" field="country"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="remarkaddress">Remark</label>
                                            <textarea v-model="form.remarkaddress" name="remarkaddress" id="remarkaddress" class="form-control" rows="2" :class="{ 'is-invalid': form.errors.has('remarkaddress') }"></textarea>
                                            <has-error :form="form" field="remarkaddress"></has-error>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update <i class="fas fa-pencil-alt fa-fw"></i></button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Save <i class="fas fa-plus fa-fw"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
    export default {
        data() {
            return {
                editMode: false,
                customers: {},
                form: new Form({
                    id: '',
                    firstname: '',
                    lastname: '',
                    sex: 'male',
                    companyname: '',
                    dob: '',
                    type: '',
                    businessphone: '',
                    personalphone: '',
                    fax: '',
                    email: '',
                    website: '',
                    twitter: '',
                    line: '',
                    remarkcontact: '',
                    postalcode: '',
                    street: '',
                    city: '',
                    country: '',
                    remarkaddress: ''
                }),

                loading: '',
                searchFor: '',
                moreParams: { aa: 1111, bb: 222 },
                fields: tableColumns,
                vuetableFields: false,
                sortOrder: [
                    { field: 'id', direction: 'asc'},
                ],
                multiSort: true,
                paginationComponent: 'vuetable-pagination',
                perPage: 10,
                paginationInfoTemplate: 'Showing record: {from} to {to} from {total} item(s)',
                lang: lang,
                css: {
                    table: {
                        tableClass: 'table table-bordered table-striped table-hover',
                        ascendingIcon: 'fas fa-chevron-up',
                        descendingIcon: 'fas fa-chevron-down'
                    },
                    pagination: {
                        wrapperClass: 'pagination',
                        activeClass: 'active',
                        disabledClass: 'disabled',
                        pageClass: 'page',
                        linkClass: 'link',
                        icons: {
                            first: 'fas fa-angle-double-left',
                            prev: 'fas fa-angle-left',
                            next: 'fas fa-angle-right',
                            last: 'fas fa-angle-double-right',
                        },
                    },
                    icons: {
                        first: 'fas fa-step-backward',
                        prev: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        last: 'fas fa-step-forward',
                    },
                },
            }
        },
        methods: {
            collapseToggle: function(){
                $('#contactInformation').removeClass('show');
                $('#addressInformation').removeClass('show');
            },
            getAllCustomer(page = 1) {
                axios.get('api/customer?page=' + page)
                    .then(response => {
                        this.customers = response.data;
                    });
            },

            loadCustomers() {
                axios.get("api/customer").then(({ data }) => (this.customers = data));
            },

            createCustomer() {
                this.$Progress.start();
                this.form.post('api/customer')
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Customer\'s name already existed',
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
            editCustomer(customer) {
                this.editMode = true;
                $('#warningAlert').hide(); // Hide the Warning Alert
                this.form.reset(); // Reset the modal
                this.form.clear();
                $('#addNew').modal('show');
                this.form.fill(customer); // Pass the data to the modal
            },
            updateCustomer(){
                this.$Progress.start();
                this.form.put('api/customer/' + this.form.id)
                .then((response) => {
                    if (response.data.existed) {
                        this.$Progress.fail();
                        Swal.fire({
                            title: 'Duplicate Data!!!',
                            text: 'Customer\'s name already existed',
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
            deleteCustomer(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // Send requesst to the server
                    if (result.value) {
                        this.form.delete('api/customer/' + id).then(() => {
                            Swal.fire(
                                'Deleted!',
                                'Customer\'s information has been deleted.',
                                'success'
                            )
                            Fire.$emit('reloadData'); // Register new event "reloadData"
                        }).catch(() => {
                            Swal.fire("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            addNewCustomer() {
                this.editMode = false; // Reset Edit Mode
                $('#warningAlert').hide(); // Hide the Warning Alert
                this.form.clear(); // Clear Errors Form
                this.form.reset();  // Clear Input Form
                $('#addNew').modal('show');
            },

            // Datatable
            transform (data) {
                let transformed = {}
                transformed.pagination = {
                    total: data.total,
                    per_page: data.per_page,
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    from: data.from,
                    to: data.to
                }

                transformed.data = []
                data = data.data
                for (let i = 0; i < data.length; i++) {
                    transformed['data'].push({
                        id: data[i].id,
                        firstname: data[i].firstname,
                        lastname: data[i].lastname,
                        sex: data[i].sex,
                        companyname: data[i].companyname,
                        email: data[i].email,
                        line: data[i].line,
                        website: data[i].website,
                        type: data[i].type,
                        businessphone: data[i].businessphone,
                        personalphone: data[i].personalphone,
                        created_at: data[i].created_at,
                    })
                }

                return transformed
            },
            showSettingsModal () {
                let self = this
                $('#settingsModal').modal({
                    detachable: true,
                    onVisible () {
                        $('.ui.checkbox').checkbox()
                    }
                }).modal('show')
            },
            showLoader () {
                this.loading = 'loading'
            },
            hideLoader () {
                this.loading = ''
            },
            allCap (value) {
                if (value != null) {
                    return value.charAt(0).toUpperCase() + value.slice(1);
                }
            },
            formatDate(value){
                return moment(value).format('MMMM Do YYYY');
            },
            setFilter () {
                this.moreParams['filter'] = this.searchFor
                this.$nextTick(function() {
                    this.$refs.vuetable.refresh()
                })
            },
            resetFilter () {
                this.searchFor = ''
                this.setFilter()
            },
            preg_quote ( str ) {
            // http://kevin.vanzonneveld.net
            // +   original by: booeyOH
            // +   improved by: Ates Goral (http://magnetiq.com)
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   bugfixed by: Onno Marsman
            // *     example 1: preg_quote("$40");
            // *     returns 1: '\$40'
            // *     example 2: preg_quote("*RRRING* Hello?");
            // *     returns 2: '\*RRRING\* Hello\?'
            // *     example 3: preg_quote("\\.+*?[^]$(){}=!<>|:");
            // *     returns 3: '\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:'
                return (str+'').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
            },
            highlight (needle, haystack) {
                return haystack.replace(
                    new RegExp('(' + this.preg_quote(needle) + ')', 'ig'),
                    '<span class="highlight">$1</span>'
                )
            },
            rowClassCB (data, index) {
                return (index % 2) === 0 ? 'odd' : 'even'
            },
            onCellClicked (data, field, event) {
                if (field.name !== '__actions') {
                    this.$refs.vuetable.toggleDetailRow(data.id)
                }
            },
            onCellDoubleClicked (data, field, event) {
                console.log('cellDoubleClicked:', field.name)
            },
            onCellRightClicked (data, field, event) {
                console.log('cellRightClicked:', field.name)
            },
            onLoadSuccess (response) {
                // set pagination data to pagination-info component
                this.$refs.paginationInfo.setPaginationData(response.data)

                let data = response.data.data
                if (this.searchFor !== '') {
                    for (let n in data) {
                    data[n].name = this.highlight(this.searchFor, data[n].name)
                    data[n].email = this.highlight(this.searchFor, data[n].email)
                    }
                }
            },
            onLoadError (response) {
                if (response.status == 400) {
                    sweetAlert('Something\'s Wrong!', response.data.message, 'error')
                } else {
                    sweetAlert('Oops', E_SERVER_ERROR, 'error')
                }
            },
            onPaginationData (tablePagination) {
                this.$refs.paginationInfo.setPaginationData(tablePagination)
                this.$refs.pagination.setPaginationData(tablePagination)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            onDataReset () {
                console.log('onDataReset')
                this.$refs.paginationInfo.resetData()
                this.$refs.pagination.resetData()
            },
        },
        watch: {
            'perPage' (val, oldVal) {
                this.$nextTick(function() {
                    this.$refs.vuetable.refresh()
                })
            },
            'paginationComponent' (val, oldVal) {
                this.$nextTick(function() {
                    this.$refs.pagination.setPaginationData(this.$refs.vuetable.tablePagination)
                })
            }
        },
        events: {
            'filter-set' (filterText) {
                this.moreParams = {
                    filter: filterText
                }
                Vue.nextTick( () => this.$refs.vuetable.refresh() )
            },
            'filter-reset' () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.vuetable.refresh() )
            }
        },
        created() {
            this.$Progress.start();
            this.loadCustomers();
            this.$Progress.finish();
            
            Fire.$on('reloadData', () => {
                this.loadCustomers();
            }); // using event AfterCreate
        },
    }

    let lang = {
        'firstname': 'First Name',
        'lastname': 'Last Name',
    }

    let tableColumns = [
        {
            name: '__component:customer-detail',
            title: 'Details',
            titleClass: 'text-center',
            dataClass: 'text-center',
            width: '80px'
        },
        {
            name: 'id',
            title: 'CID',
            sortField: 'id',
            width: '80px'
        },
        {
            name: 'firstname',
            title: 'First Name',
            sortField: 'firstname',
        },
        {
            name: 'lastname',
            title: 'Last Name',
            sortField: 'lastname',
        },
        {
            name: 'type',
            title: 'Type',
            sortField: 'type',
            callback: 'allCap'
        },
        {
            name: 'businessphone',
            title: 'Business Phone',
            sortField: 'businessphone',
        },
        {
            name: 'personalphone',
            title: 'Personal Phone',
            sortField: 'personalphone',
        },
        {
            name: 'created_at',
            title: 'Registered At',
            sortField: 'created_at',
            titleClass: 'text-center',
            dataClass: 'text-center',
            callback: 'formatDate'
        },
        {
            name: '__component:custom-actions',
            title: 'Modify',
            titleClass: 'text-center',
            dataClass: 'text-center',
        },
    ]
</script>

<style>
    .table{margin: 0;}
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
</style>
