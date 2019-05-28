<template>
    <div>
        <a href="#" @click="editCustomer(rowData)" title="Edit"><i class="fas fa-edit text-info"></i></a>
        |
        <a href="#" @click="deleteCustomer(rowData.id)" title="Delete"><i class="fas fa-trash text-danger"></i></a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editMode: false,
            customers: {},
            form: new Form(),
        }
    },
    props: {
        rowData: {
            type: Object,
            required: true
        },
        rowIndex: {
            type: Number
        },
        options: {
            type: Object,
        }
    },
    methods: {
        editCustomer() {
            this.editMode = true;
            $('#warningAlert').hide(); // Hide the Warning Alert
            this.form.reset(); // Reset the modal
            this.form.clear();
            $('#addNew').modal('show');
            this.form.fill('/api/customer/' + id); // Pass the data to the modal
        },
        updateCustomer(){
            this.$Progress.start();
            this.form.put('/api/customer/' + this.form.id)
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
                    this.form.delete('/api/customer/' + id).then(() => {
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
        loadCustomers() {
            axios.get("/api/customer").then(({ data }) => (this.customers = data));
        },
    },
    created() {
        Fire.$on('reloadData', () => {
            this.loadCustomers();
        }); // using event AfterCreate
    },
}
</script>

<style>
    .custom-actions button.ui.button {
        padding: 8px 8px;
    }
    .custom-actions button.ui.button > i.icon {
        margin: auto !important;
    }
</style>