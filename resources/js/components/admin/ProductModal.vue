<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="card col-md-5 col-sm-5 mx-auto shadow-lg" style="border: none; border-radius: inherit">
                <!--<div class="modal-header">-->
                    <!--<slot name="header" v-html="data.name"></slot>-->
                <!--</div>-->
                <div class="card-body" style="padding-bottom: 5px;">

                        <label>Name: </label>
                        <input class="form-control" type="text" v-model="data.name" placeholder="Input Name">
                        <div class="row">
                            <div class="col">
                                <label>Units: </label>
                                <input class="form-control" type="text" v-model="data.units" placeholder="Input Units">

                            </div>
                            <div class="col">
                                <label>Price: </label>
                                <input class="form-control" type="text" v-model="data.price" placeholder="Input Price">
                            </div>
                        </div>

                        <label>Description: </label>
                        <textarea class="form-control" rows="3" v-model="data.description" placeholder="Description"></textarea>

                        <p align="center" style="padding-top: 10px;">
                            <img class="rounded" :src="data.image" v-show="data.image != null" style="width: 250px; height: 250px;">
                        </p><br>


                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" @change="attachFile">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                    <!--<input class="btn btn-info" type="file" id="file" @change="attachFile">-->

                </div>
                <hr style="padding: 0px;margin-bottom: 3px;margin-top: 10px;">
                <div class="card-footer" style="border: none; border-radius: inherit; background-color: #fff;">
                    <!--<slot name="footer">-->
                        <button type="button" class="btn btn-success" @click="uploadFile">
                            Save
                        </button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <!--</slot>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "ProductModal",
        props: ['product'],
        data() {
            return {
                attachment: null,
            }
        },
        computed: {
            data: function() {
                if (this.product != null) {
                    return this.product
                }
                return {
                    name: "",
                    units: "",
                    price: "",
                    description: "",
                    image: false
                }
            }
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            uploadFile(event) {
                if (this.attachment != null) {
                    var formData = new FormData();
                    formData.append("image", this.attachment)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file", formData, {headers}).then(response => {
                        this.product.image = response.data
                        this.$emit('close', this.product)
                    })
                } else {
                    this.$emit('close', this.product)
                }
            }
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .3);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 500px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
        margin-top: 1px;
        margin-bottom: 1px;
    }
    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>
