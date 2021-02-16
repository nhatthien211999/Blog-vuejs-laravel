<template lang="">
    <div>
        <div class="card mt-3" v-if="active.dashboard">
            <div class="card-body">
                <h3>User Account Setting</h3>

                <div class="alert alert-success" role="alert" v-if="success_message !== null">
                    {{success_message}}
                </div>

                <hr>

                <div class="alert alert-warning" role='alert' v-if="errors.length > 0">
                    <ul>
                        <li v-for="err in errors">
                            {{err}}
                        </li>
                    </ul>
                </div>

                <table class="table table-hover table-borderless">
                    <tbody v-if="user !== null">
                        <tr>
                            <th>Name</th>
                            <td v-if="!active.editName">{{user.name}} <span class="mt-3 badge badge-primary" 
                                @click.prevent="active.editName = true"
                                 style="cursor: pointer">Edit</span></td>
                            <td v-if="active.editName">
                                <div class="form-group form-inline">
                                    <input type="text" class="form-control form-control-sm" v-model="data.name">
                                    <button class="btn btn-primary btn-sm ml-2" @click.prevent="updateName">Update</button>
                                    <button class="btn btn-danger btn-sm ml-2" @click.prevent="active.editName = false">Cancel</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{user.email}} <span class="mt-3 badge badge-primary" 
                                @click.prevent="setActive('updateEmail')"
                                style="cursor: pointer">Edit</span></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{user.role}}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>********** <span class="mt-3 badge badge-primary">Send reset Link</span></td>
                        </tr>
                        <tr>
                            <th>User Since</th>
                            <td>{{user.user_since}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <UpdateEmail
        v-if="active.updateEmail && user !== null"
        v-bind:user="user"
        v-on:view-dashboard="setActive('dashboard')"
        v-on:updated-email="flashSuccessAndReload">
        </UpdateEmail>
    </div>
</template>
<script>
import UpdateEmail from './updateEmail.vue'

export default {
    components: {
        UpdateEmail
    },
    mounted() {
        
        this.getUser();
    },
    data() {
        return {
            user: null,
            active: {
                dashboard: true,
                updateEmail: false,
                editName: false,
            },
            success_message: null,
            data: {
                name: '',
            },
            errors: []
        }
    },
    methods: {
        getUser() {
            axios.get('/data/accounts/user',{
                _method: 'GET'
            })
            .then(response => {
                this.user = response.data.user;
                this.data.name = this.user.name;
            })
        },
        setActive(component){
            Object.keys(this.active).forEach(key => this.active[key] = false)
            this.active[component] = true
        },
        flashSuccessAndReload: function(event){
            this.setActive('dashboard');
            this.flashSucess(event);
            this.getUser();
        },
        flashSucess: function(message){
            this.success_message = message;
            setTimeout(() => {
            this.success_message = null; 
            }, 5000);
        },
        updateName: function(){
            this.errors = [];
            axios.post('/data/accounts/updates/name/' + this.user.id, {
                _method: 'PUT',
                name: this.data.name
            }).then(
                response => {
                    this.flashSuccessAndReload('Successfully updated name');
                }
            ).catch(errors => {
                if (errors.response.status === 403){
                    this.errors.push('You are not authorized to change name');
                }
                if (errors.response.status === 422){
                    this.flashError(errors.response.data.errors);
                }
            })
        },
        flashError: function (errors) {
            for(const [key, value] of Object.entries(errors)){
                for(let item in value){
                    this.errors.push(value[item])
                }
            }
        }
    }
}
</script>
<style lang="">
    
</style>