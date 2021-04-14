<template>
    <div>
        <form @submit.prevent="createItem">
            <div class="create-item-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newItemName" type="text" class="form-control" placeholder="Item Name" />
                
                <div class="input-group-prepend">
                    <span class="input-group-text">Category</span>
                </div>
                <select v-model="newItemCategoryId">
                    <option v-for="category in categories" v-bind:value="category.id">
                        {{ category.name }}
                    </option>
                </select>

                <div class="input-group-prepend">
                    <span class="input-group-text">Location</span>
                </div>
                <select v-model="newItemLocationId">
                    <option v-for="location in locations" v-bind:value="location.id">
                        {{ location.name }}
                    </option>
                </select>

                <div class="input-group-prepend">
                    <span class="input-group-text">Price</span>
                </div>
                <input v-model="newItemPrice" type="text" class="form-control" placeholder="Item Price" />

                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Location</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ categoryName(row.category_id) }}</td>
                    <td>{{ locationName(row.location_id) }}</td>
                    <td>{{ row.price }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            items: [],
            categories: [],
            locations: [],
            newItemName: '',
            newItemCategoryId: '',
            newItemLocationId: '',
            newItemPrice: ''
        };
    },
    mounted() {
        this.getItems();
        this.getCategories();
        this.getLocations();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                }).catch(console.error);
        },
        getLocations() {
            return axios.get('/api/locations')
                .then(response => {
                    this.locations = response.data;
                }).catch(console.error);
        },
        createItem() {
            return axios.post('/api/items', { 
                name: this.newItemName, 
                category_id: this.newItemCategoryId,
                location_id: this.newItemLocationId,
                price: this.newItemPrice
            })
                .then(this.getItems)
                .then(() => {
                    this.newItemName = ''
                    this.newItemCategoryId = ''
                    this.newItemLocationId = ''
                    this.newItemPrice = ''
                })
                .catch(console.error);
        },
        deleteItem(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        },
        categoryName(id) {
            if(id === null)
                return ""

            let category = _.find(this.categories, { id })
            if(category === undefined)
                return ""

            return category.name
        },
        locationName(id) {
            if(id === null)
                return ""

            let location = _.find(this.locations, { id })
            if(location === undefined)
                return ""

            return location.name
        }
    }
}
</script>

<style>
.create-item-form {
    margin-bottom: 10px;
}
</style>