<template>
    <div>
        <div style="height: 35px;"></div>
        <div class="container-fluid d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Admin Dashboard</h2>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="border: none;">
                        <div class="card-body">
                            <ul style="list-style-type:none">
                                <li class="active l">
                                    <button class="btn btn-outline-secondary col-lg-10" @click="setComponent('main')">Dashboard</button>
                                </li>
                                <li class="nav-item l">
                                    <button class="btn btn-outline-secondary col-lg-10" @click="setComponent('orders')">Orders</button>
                                </li>
                                <li class="nav-item l">
                                    <button class="btn btn-outline-secondary col-lg-10" @click="setComponent('products')">Products</button>
                                </li>
                                <li class="nav-item l">
                                    <button class="btn btn-outline-secondary col-lg-10" @click="setComponent('users')">Users</button>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <component :is="activeComponent"></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Products from '../components/admin/Products'
    import Orders from '../components/admin/Orders'

    export default {
        name: "Admin",
        data(){
            return{
                user: null,
                activeComponent: null,
            }
        },
        components: {
            Main, Users, Products, Orders
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('Lara-Ecommerce.user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('Lara-Ecommerce.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
</script>


<style scoped>
    .l{
        padding-bottom: 7px;
    }
    .btn {
        border-color: gray;
        border-radius: 3px;

    }

</style>
