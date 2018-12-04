<template>
    <div class="container">
        <div style="height: 44px;"></div>
        <!--<div class="jumbotron shadow-lg">-->
            <div class="row mx-auto">
                <div class="col-md-5 col-sm-6 offset-2">
                    <div class="card shadow-lg" style="border: none; border-radius: inherit">
                        <div class="card-body" style="
    padding-top: 40px;">
                            <p align="center">
                                <img class="rounded" :src="product.image" :alt="product.name" style="width: 200px; height: 230px;"><br>
                            </p>
                            <h3 class="title text-center" v-html="product.name"></h3>
                            <hr>
                            <p class="text-muted">{{product.description}}</p>
                        </div>
                    </div>

                </div>
                <!--<div class="col-md-2"></div>-->
                <div class="col-md-4 col-sm-6">
                    <div class="card card-body shadow-lg" style="border: none; ">
                        <h4 class="float-left"><strong>Order summary</strong></h4>
                        <hr>
                        <div class="d-flex bd-highlight mb-3">
                            <div class="mr-auto">
                                <h5>Price</h5>
                            </div>
                            <div class="ml-auto">
                                <h5>
                                    <span class="small-text text-muted">$ {{product.price}}</span>

                                </h5>
                            </div>
                        </div>

                        <span class="small-text float-right">Available Quantity: {{product.units}}</span>
                        <hr>
                        <router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary">Buy Now</router-link>
                    </div>

                </div>
            </div>
        <!--</div>-->
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "SingleProducts",
        data(){
            return {
                product: []
            }
        },
        beforeMount(){
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => this.product = response.data)
        }
    }
</script>
<style>
</style>
