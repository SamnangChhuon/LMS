<template>
    <div>
        <div class="inline field">
            <label>Gender: </label>
            <span>{{rowData.sex}}</span>
        </div>
        <div class="inline field">
            <label>Company Name: </label>
            <span> {{rowData.companyname}}</span>
        </div>
        <div class="inline field">
            <label>Email: </label>
            <span> {{rowData.email}}</span>
        </div>
        <div class="inline field">
            <label>Line: </label>
            <span> {{rowData.line}}</span>
        </div>
        <div class="inline field">
            <label>Website: </label>
            <span> {{rowData.website}}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        rowData: {
            type: Object,
            required: true
        },
        rowIndex: {
            type: Number
        }
    },
}
</script>
