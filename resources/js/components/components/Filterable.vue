<template>
    <div class="filterable">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">
                    <span>{{this.$route.name}} match</span>
                    <label for="">
                        <select class="custom-select custom-select-sm form-control form-control-sm" v-model="query.filter_match">
                            <option value="and">All</option>
                            <option value="or">Any</option>
                        </select>
                    </label>
                    <span>of the following:</span>
                </div>
                <div class="card-tools mt-1">
                    <button class="btn btn-success" @click="addNewCustomer() , collapseToggle()">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="filter">
                    <div class="row filter-item" v-for="(f, i) in filterCandidates">
                        <div class="col-md-3">
                            <div class="filter-column">
                                <div class="form-group">
                                    <select class="custom-select form-control" @input="selectColumn(f, i, $event)">
                                        <option value="">Select a filter</option>
                                        <optgroup v-for="group in filterGroups" :label="group.name">
                                            <option v-for="x in group.filters"
                                                :value="JSON.stringify(x)"
                                                :selected="f.column && x.name === f.column.name"
                                                >
                                                    {{x.title}}
                                                </option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 filter-operator" v-if="f.column">
                            <div class="form-group">
                                <select class="custom-select form-control" @input="selectOperator(f, i, $event)">
                                    <option v-for="y in fetchOperators(f)"
                                        :value="JSON.stringify(y)"
                                        :selected="f.operator && y.name === f.operator.name"
                                        >
                                            {{y.title}}
                                        </option>
                                </select>
                            </div>
                        </div>
                        <template class="col-md-8" v-if="f.column && f.operator">
                            <div class="col-md-3 filter-full" v-if="f.operator.component === 'single'">
                                <input type="text" class="form-control" v-model="f.query_1">
                            </div>
                            <template  v-if="f.operator.component === 'double'">
                                <div class="col-md-3 filter-query_1">
                                    <input type="text" class="form-control" v-model="f.query_1">
                                </div>
                                <div class="col-md-3 filter-query_2">
                                    <input type="text" class="form-control" v-model="f.query_2">
                                </div>
                            </template>
                            <template v-if="f.operator.component === 'datetime_1'">
                                <div class="col-md-3 filter-query_1">
                                    <input type="text" class="form-control" v-model="f.query_1">
                                </div>
                                <div class="col-md-3 filter-query_2">
                                    <select class="form-control" v-model="f.query_2">
                                        <option>hours</option>
                                        <option>days</option>
                                        <option>months</option>
                                        <option>years</option>
                                    </select>
                                </div>
                            </template>
                            <template v-if="f.operator.component === 'datetime_2'">
                                <div class="col-md-3 filter-query_2">
                                    <select class="form-control" v-model="f.query_1">
                                        <option value="yesterday">yesterday</option>
                                        <option value="today">today</option>
                                        <option value="tomorrow">tomorrow</option>
                                        <option value="last_month">last month</option>
                                        <option value="this_month">this month</option>
                                        <option value="next_month">next month</option>
                                        <option value="last_year">last year</option>
                                        <option value="this_year">this year</option>
                                        <option value="next_year">next year</option>
                                    </select>
                                </div>
                            </template>
                        </template>
                        <div class="col-md-1">
                            <div class="filter-remove" v-if="f">
                                <button class="btn btn-link" @click="removeFilter(f, i)"><i class="fas fa-trash text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="filter-controls">
                        <button class="btn btn-success" @click="addFilter"><i class="fas fa-plus"></i></button>
                        <button class="btn btn-secondary" @click="resetFilter"
                            v-if="this.appliedFilters.length > 0"
                            >
                                Reset
                            </button>
                        <button class="btn btn-primary" @click="applyFilter">Apply Filter</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card card-info card-outline">
            <div class="card-header p-0">
                <div class="row filterable-export p-2">
                    <div class="col-md-6">
                        <button class="btn btn-light text-dark" @click="exportToCSV()"><i class="fa fa-print"></i> Export</button>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inline">
                            <div class="form-group mb-2 ml-sm-auto">
                                <label>Order by: </label>
                                <select class="form-control mx-sm-2" :disabled="loading" @input="updateOrderColumn">
                                    <option v-for="column in orderables"
                                        :value="column.name"
                                        :selected="column && column.name == query.order_column"
                                        >
                                            {{column.title}}
                                        </option>
                                </select>
                                <div @click="updateOrderDirection">
                                    <button class="btn btn-link" v-if="query.order_direction === 'asc'"><i class="fas fa-sort-amount-up fa-rotate-180"></i></button>
                                    <button class="btn btn-link" v-else><i class="fas fa-sort-amount-down"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover">
                    <slot name="thead"></slot>
                    <tbody>
                        <slot v-if="collection.data && collection.data.length"
                            v-for="item in collection.data"
                            :item="item"
                            ></slot>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <label class="mr-2 mb-2">
                                <select class="custom-select custom-select-sm form-control form-control-sm" v-model="query.limit" :disabled="loading" @change="updateLimit">
                                    <option>10</option>
                                    <option>15</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </label>
                            <p class="pt-2 m-0"> Showing {{collection.from}} - {{collection.to}} of {{collection.total}} entries.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fa-pull-right">
                            <button class="btn btn-primary" :disabled="!collection.prev_page_url || loading"
                                @click="prevPage"><i class="fas fa-angle-double-left"></i> Prev</button>
                            <button class="btn btn-primary" :disabled="!collection.next_page_url || loading"
                                @click="nextPage">Next <i class="fas fa-angle-double-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import axios from 'axios'

    export default {
        props: {
            url: String,
            filterGroups: Array,
            orderables: Array
        },
        data() {
            return {
                loading: true,
                appliedFilters: [],
                filterCandidates: [],
                query: {
                    order_column: 'created_at',
                    order_direction: 'desc',
                    filter_match: 'and',
                    limit: 10,
                    page: 1
                },
                collection: {
                    data: []
                }
            }
        },
        computed: {
            fetchOperators() {
                return (f) => {
                    return this.availableOperators().filter((operator) => {
                        if(f.column && operator.parent.includes(f.column.type)) {
                            return operator
                        }
                    })
                }
            },
        },
        mounted() {
            this.fetch()
            this.addFilter()
        },
        methods: {
            updateOrderDirection() {
                if(this.query.order_direction === 'desc') {
                    this.query.order_direction = 'asc'
                } else {
                    this.query.order_direction = 'desc'
                }
                this.applyChange()
            },
            updateOrderColumn(e) {
                const value = e.target.value
                Vue.set(this.query, 'order_column', value)
                this.applyChange()
            },
            exportToCSV() {
                // next video
            },
            resetFilter() {
                this.appliedFilters.splice(0)
                this.filterCandidates.splice(0)
                this.addFilter()
                this.query.page = 1
                this.applyChange()
            },
            applyFilter() {
                Vue.set(this.$data, 'appliedFilters',
                    JSON.parse(JSON.stringify(this.filterCandidates))
                )
                this.query.page = 1;
                this.applyChange()
            },
            removeFilter(f, i) {
                this.filterCandidates.splice(i, 1)
            },
            selectOperator(f, i, e) {
                let value = e.target.value
                if(value.length === 0) {
                    Vue.set(this.filterCandidates[i], 'operator', value)
                    return
                }

                let obj = JSON.parse(value)

                Vue.set(this.filterCandidates[i], 'operator', obj)

                this.filterCandidates[i].query_1 = null
                this.filterCandidates[i].query_2 = null

                // set default query

                switch(obj.name) {
                    case 'in_the_past':
                    case 'in_the_next':
                        this.filterCandidates[i].query_1 = 28
                        this.filterCandidates[i].query_2 = 'days'
                        break;
                    case 'in_the_peroid':
                        this.filterCandidates[i].query_1 = 'today'
                        break;
                }
            },
            selectColumn(f, i, e) {
                let value = e.target.value
                if(value.length === 0) {
                    Vue.set(this.filterCandidates[i], 'column', value)
                    return
                }

                let obj = JSON.parse(value)

                Vue.set(this.filterCandidates[i], 'column', obj)

                // set default operator: todo
                switch(obj.type) {
                    case 'numeric':
                        this.filterCandidates[i].operator = this.availableOperators()[4]
                        this.filterCandidates[i].query_1 = null
                        this.filterCandidates[i].query_2 = null
                        break;
                    case 'string':
                        this.filterCandidates[i].operator = this.availableOperators()[6]
                        this.filterCandidates[i].query_1 = null
                        this.filterCandidates[i].query_2 = null
                        break;
                    case 'datetime':
                        this.filterCandidates[i].operator = this.availableOperators()[9]
                        this.filterCandidates[i].query_1 = 28
                        this.filterCandidates[i].query_2 = 'days'
                        break;
                    case 'counter':
                        this.filterCandidates[i].operator = this.availableOperators()[14]
                        this.filterCandidates[i].query_1 = null
                        this.filterCandidates[i].query_2 = null
                        break;
                }
            },
            addFilter() {
                this.filterCandidates.push({
                    column: '',
                    operator: '',
                    query_1: null,
                    query_2: null
                })
            },
            applyChange() {
                this.fetch()
            },
            updateLimit() {
                this.query.page = 1
                this.applyChange()
            },
            prevPage() {
                if(this.collection.prev_page_url) {
                    this.query.page = Number(this.query.page) - 1
                    this.applyChange()
                }
            },
            nextPage() {
                if(this.collection.next_page_url) {
                    this.query.page = Number(this.query.page) + 1
                    this.applyChange()
                }
            },
            getFilters() {
                const f = {}

                this.appliedFilters.forEach((filter, i) => {
                    f[`f[${i}][column]`] = filter.column.name
                    f[`f[${i}][operator]`] = filter.operator.name
                    f[`f[${i}][query_1]`] = filter.query_1
                    f[`f[${i}][query_2]`] = filter.query_2
                })

                return f
            },
            fetch() {
                this.loading = true
                const filters = this.getFilters()

                const params = {
                    ...filters,
                    ...this.query
                }
                axios.get(this.url, {params: params})
                    .then((res) => {
                        Vue.set(this.$data, 'collection', res.data.collection)
                        this.query.page = res.data.collection.current_page
                    })
                    .catch((error) => {

                    })
                    .finally(() => {
                        this.loading = false
                    })
            },
            availableOperators() {
                return [
                    {title: 'equal to', name: 'equal_to', parent: ['numeric', 'string'], component: 'single'},
                    {title: 'not equal to', name: 'not_equal_to', parent: ['numeric', 'string'], component: 'single'},
                    {title: 'less than', name: 'less_than', parent: ['numeric'], component: 'single'},
                    {title: 'greater than', name: 'greater_than', parent: ['numeric'], component: 'single'},

                    {title: 'between', name: 'between', parent: ['numeric'], component: 'double'},
                    {title: 'not between', name: 'not_between', parent: ['numeric'], component: 'double'},

                    {title: 'contains', name: 'contains', parent: ['string'], component: 'single'},
                    {title: 'starts with', name: 'starts_with', parent: ['string'], component: 'single'},
                    {title: 'ends with', name: 'ends_with', parent: ['string'], component: 'single'},

                    {title: 'in the past', name: 'in_the_past', parent: ['datetime'], component: 'datetime_1'},
                    {title: 'in the next', name: 'in_the_next', parent: ['datetime'], component: 'datetime_1'},
                    {title: 'in the peroid', name: 'in_the_peroid', parent: ['datetime'], component: 'datetime_2'},

                    {title: 'equal to', name: 'equal_to_count', parent: ['counter'], component: 'single'},
                    {title: 'not equal to', name: 'not_equal_to_count', parent: ['counter'], component: 'single'},
                    {title: 'less than', name: 'less_than_count', parent: ['counter'], component: 'single'},
                    {title: 'greater than', name: 'greater_than_count', parent: ['counter'], component: 'single'},
                ]
            }
        }
    }
</script>
