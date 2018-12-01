<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Welcome to the Store</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-lg-3 el-col-xs-12" v-for="(product,index) in products" @key="index">
                            <div class="card mb-3 shadow-lg p-3 align-content-center" style="border: none; border-radius: inherit" >
                                <div class="card-body" style="padding: 0px;">
                                    <router-link :to="{ path: '/products/'+product.id}">
                                        <p align="center">
                                            <img class="rounded" :src="product.image" :alt="product.name" style="width: 183px; height: 250px;">
                                        </p>
                                        <h6 align="center"><span v-html="product.name"></span></h6>
                                        <h5>
                                            <span class="text-muted float-left">$ {{product.price}}</span>
                                        </h5>
                                        <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                                    </router-link>
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
        name: "Home",
        data(){
            return{
                products : []
            }
        },
        mounted() {
            axios.get("api/products/").then(response=> this.products = response.data)
        }
    }
</script>

<style scoped>
    .product-box {
        border:  none;
        padding: 10px 15px;
    }
    .hero-section {
        height: 15vh;
        background: #fff;
        align-items: center;
        /*margin-bottom: 20px;*/
        /*margin-top: 10px;*/
    }
    .title {
        font-size: 40px;
        color: gray;
    }
    .btn{
        border: none;
        border-radius: inherit;
    }
</style>
