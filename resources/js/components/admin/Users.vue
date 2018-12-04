<template>
    <div class="card shadow-lg">
        <div class="card-body" style="padding-top: 0px;">
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <td></td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Joined</td>
                    <td>Total Orders</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user,index) in users" @key="index">
                    <td>{{index+1}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at}}</td>
                    <td>{{user.orders.length}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    export default {
        name: "Users",
        data(){
            return{
                users:[]
            }
        },
        beforeMount() {
            axios.get('/api/users/').then(response=>this.users = response.data)
        }
    }
</script>

<style scoped>
    .card{
        border: none;
        border-radius: inherit;
    }

</style>
