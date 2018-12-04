<template>
    <div>
        <div style="height: 25px;"></div>
        <div class="container align-items-center">
            <div class="row align-content-center">
                <div class="col-md-5 col-lg-5 col-sm-6 mx-auto">
                    <div class="card shadow-lg" style="border:none; border-radius: inherit;">
                        <div class="card-body" style="padding-bottom: 10px; padding-top: 10px">
                            <br><br>
                            <p align="center">
                                <img class="rounded" :src="product.image" :alt="product.name" style="width: 300px; height: 280px;">
                            </p>
                            <span align="center"><h3 v-html="product.name"></h3></span>

                            <p class="text-muted float-left">$ {{product.price}}</p>
                            <p class="text-muted float-right">Available Units: {{product.units}}</p>
                            <br>
                            <hr style="margin-bottom: 10px; margin-top: 10px">
                            <span style="padding: 5px">Quantity:   </span>
                                <input type="number" name="units" min="1" :max="product.units" v-model="quantity" @change="checkUnits">

                        </div>
                        <div class="card-header" style="border: none; padding-top: 1px">
                            <br>
                            <div>
                                <div v-if="!isLoggedIn">
                                    <h2>You need to login to continue</h2>
                                    <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                                    <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                                </div>
                                <div v-if="isLoggedIn">
                                    <div class="row">
                                        <label for="address" class="col-md-3 col-form-label">Delivery Address</label>
                                        <div class="col-md-9">
                                            <input id="address" type="text" class="form-control" v-model="address" required>
                                        </div>
                                    </div>

                                    <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="placeOrder">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    export default {
        name: "Checkout",
        props: ['pid'],
        data(){
            return {
                address : "",
                quantity : 1,
                isLoggedIn : null,
                product : []
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('Lara-Ecommerce.jwt') != null
        },
        beforeMount() {
            axios.get(`/api/products/${this.pid}`).then(response => this.product = response.data)
                .catch(error=>{
                    console.log(error, "Error inicio beforeMount")
                })

            if (localStorage.getItem('Lara-Ecommerce.jwt') != null) {
                this.user = JSON.parse(localStorage.getItem('Lara-Ecommerce.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('Lara-Ecommerce.jwt')
            }
        },
        methods : {
            login() {
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            },
            register() {
                this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
            },
            placeOrder(e) {
                e.preventDefault()

                let address = this.address
                let product_id = this.product.id
                let quantity = this.quantity

                // axios.post('api/orders/', {address, quantity, product_id})
                axios.post('api/orders/', {product_id, quantity})
                    .then(function (response) {
                        this.$router.push('/confirmation')
                    })
                    // .then(response => {this.$router.push('/confirmation')
                    // })
                    .catch(error =>{
                        console.log(error,"Error response ? placeOrder")
                    })
            },
            checkUnits(e) {
                if (this.quantity > this.product.units) {
                    this.quantity = this.product.units
                }
            }
        }

    }
</script>
