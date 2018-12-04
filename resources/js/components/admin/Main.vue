<template>
    <div class="row">
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <div class="card">
                <div class="card-body">
                    <a href='/admin/orders'>Orders ({{orders.length}})</a>
                </div>
            </div>

        </div>
        <hr>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <div class="card">
                <div class="card-body">
                    <a href='/admin/products'>Products ({{products.length}})</a>
                </div>
            </div>

        </div>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <div class="card">
                <div class="card-body">
                    <a href='/admin/users'>Users ({{users.length}})</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Main",
        data(){
            return{
                user : null,
                orders : [],
                products : [],
                users : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get('/api/orders/').then(response => this.orders = response.data)
        }
    }
</script>

<style scoped>

</style>
