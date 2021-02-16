<template lang="">
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button class="btn btn-outline-primary mr-3" @click.prevent="$emit('view-dashboard')">
                        <i class="fas fa-chevron-left"></i> Back
                    </button> 
                    Create new user
                </h3>
                <hr>

                <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>

                <form action="#">
                    <div class="form-group row">
                        <label for="" class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" v-model="data.name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-3">Email</label>
                        <div class="col-9">
                            <input type="email" class="form-control" v-model="data.email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-3">Role</label>
                        <div class="col-9">
                            <select class="form-control" v-model="data.role"> 
                                <option :value="'user'">User</option>
                                <option :value="'admin'">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-3">Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" v-model="data.password">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-3">Comfirm Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" v-model="data.comfirm_password">
                        </div>
                    </div>
                    <button class="btn btn-primary" 
                        @click.prevent="storeUSer">
                            Create user
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return{
            data: {
                name: '',
                email: '',
                role: 'user',
                password: '',
                comfirm_password: ''
            },
            errors: []

        }
    },
    methods: {
        storeUSer: function () {
            const instance = axios.create({
            baseURL: 'http://127.0.0.1:8000/',
            });
            instance.post('data/users', {
                name: this.data.name,
                email: this.data.email,
                role: this.data.role,
                password: this.data.password,
                comfirm_password: this.data.comfirm_password,
            })
            .then(response => {
                this.$emit('create-user', 'Successful created user ' + response.data.user.name + 
                '| Email ' + response.data.user.email);
            })
            .catch(error => {
                if (error.response.status === 422){
                    this.flashError(error.response.data.errors);
                    console.log(error.response);
                }
                if (error.response.status === 403){
                    this.errors = ['Bạn chưa tạo user']
                }
            });
        },
        flashError: function (errors) {
            for(const [key, value] of Object.entries(errors)){
                for(let item in value){
                    this.errors.push(value[item])
                }
            }
        },
    }
}
</script>
<style lang="">
    
</style>