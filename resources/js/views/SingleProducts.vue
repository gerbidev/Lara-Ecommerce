<template>
    <div class="container">
        <div style="height: 34px;"></div>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-8 col-sm-6">
                    <p align="center">
                        <img class="rounded" :src="product.image" :alt="product.name"><br>
                    </p>
                    <h3 class="title text-center" v-html="product.name"></h3>
                    <hr>
                    <p class="text-muted">{{product.description}}</p>

                </div>
                <!--<div class="col-md-2"></div>-->
                <div class="col-md-4 col-sm-6">
                    <div class="card card-body">
                        <h5 class="float-left"><strong>Order summary</strong></h5><br>
                        <h4>
                        <span class="small-text text-muted">$ {{product.price}}</span>

                        </h4>
                        <span class="small-text float-right">Available Quantity: {{product.units}}</span>
                        <hr>
                        <router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary">Buy Now</router-link>
                    </div>

                </div>
            </div>
        </div>
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
