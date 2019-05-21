<template>
    <router-link :to="{name: 'Viewcustomer', params: {id: rowData.id}}" title="Show More Details"><i class="fas fa-user-edit"></i></router-link>
</template>

<script>
export default {
    props: {
        rowData: {
            type: Object,
            required: true
        },
    },
}
</script>