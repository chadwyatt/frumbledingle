<template>
    <div>
        <form @submit.prevent="getReport">
            <div class="create-item-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Price &gt;=</span>
                </div>
                <input v-model="itemPrice" type="text" class="form-control" placeholder="Item Price" />

                <div class="input-group-append">
                    <button class="btn btn-primary">Update Report</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Location</th>
                <th>Parent Category</th>
                <th>Category</th>
                <th>Count</th>
            </thead>
            <tbody>
                <tr v-for="row in report" :key="row.id">
                    <td>{{ row.location }}</td>
                    <td>{{ row.parentCategory }}</td>
                    <td>{{ row.category }}</td>
                    <th>{{ row.count }}</th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            report: [],
            itemPrice: ''
        };
    },
    mounted() {
        this.getReport()
    },
    methods: {
        getReport() {
            return axios.get('/api/report?price='+this.itemPrice)
                .then(response => {
                    this.report = response.data;
                }).catch(console.error);
        }
    }
}
</script>

<style>
.create-item-form {
    margin-bottom: 10px;
}
</style>