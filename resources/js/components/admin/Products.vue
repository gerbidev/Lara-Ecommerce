<template>
    <div class="card shadow-lg">
        <div class="card-header" style="border: none;">
            <button class="btn btn-primary" @click="newProduct">Add New Product</button>
        </div>
        <div class="card-body" style="padding-top: 0px;">
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <td></td>
                    <td>Product</td>
                    <td>Units</td>
                    <td>Price</td>
                    <td>Description</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product">
                    <td>{{index+1}}</td>
                    <td v-html="product.name"></td>
                    <td v-model="product.units">{{product.units}}</td>
                    <td v-model="product.price">{{product.price}}</td>
                    <td v-model="product.price">{{product.description}}</td>
                </tr>
                </tbody>
            </table>
            <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
            <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
            <br>

        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    import Modal from './ProductModal'
    export default {
        name: "Products",
        data() {
            return {
                products: [],
                editingItem: null,
                addingProduct: null
            }
        },
        components: {
            Modal
        },
        beforeMount() {
            axios.get('/api/products/').then(response => this.products = response.data)
        },
        methods: {
            newProduct() {
                this.addingProduct = {
                    name: null,
                    units: null,
                    price: null,
                    image: null,
                    description: null,
                }
            },
            endEditing(product) {
                this.editingItem = null

                let index = this.products.indexOf(product)
                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description

                axios.put(`/api/products/${product.id}`, {name, units, price, description})
                    .then(response => this.products[index] = product)
            },
            addProduct(product) {
                this.addingProduct = null

                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let image = product.image

                axios.post("/api/products/", {name, units, price, description, image})
                    .then(response => this.products.push(product))
            }
        }
    }
</script>

<style scoped>
    .card{
        border: none;
        border-radius: inherit;
    }


</style>
