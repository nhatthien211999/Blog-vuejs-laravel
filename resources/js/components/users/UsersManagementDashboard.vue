<template>
    <div>
        <div class="card mt-3" v-if="active.dashboard">
            <div class="card-body">
                <h3>Manage users 
                    <button class="btn btn-outline-success btn-sm float-right" @click.prevent="setActive('createUser')">
                        <i class="fas fa-plus"></i>
                    </button>
                </h3>

                <div class="alert alert-success" role="alert" v-if="success_message !== null">
                    {{success_message}}
                </div>

                <div class="alert alert-danger" role="alert" v-if="danger_message !== null">
                    {{danger_message}}
                </div>

                <pagination 
                    v-if="results !== null"
                    v-bind:results = 'results'
                    v-on:get-page = 'getPage'
                ></pagination>
                <paginationDetails
                    v-if="results !== null"
                    v-bind:results = 'results'>
                </paginationDetails>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Since</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody v-if="results !== null">
                        
                        <tr  v-for="(user, index) in results.data" :key="index">
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.user_since}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm"
                                    @click="viewUserLog(user)">
                                        <i class="fas fa-list-alt"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning"
                                    @click="editUser(user)">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-sm btn-secondary"
                                    @click="changePassword(user)">
                                        <i class="fas fa-key"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger"
                                    @click="deleteUser(user)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>    
                </table>
                <pagination 
                    v-if="results !== null"
                    v-bind:results = 'results'
                    v-on:get-page = 'getPage'
                ></pagination>
            </div>
        </div>
        <CreateUser
        v-if="active.createUser"
        v-on:view-dashboard="setActive('dashboard')"
        v-on:create-user="flashSucessAndReload($event)">
        </CreateUser>

        <UserLogs
        v-if="user !== null && active.userLogs"
        v-bind:user="user"
        v-on:view-dashboard="setActive('dashboard')">
        </UserLogs>

        <EditUser
        v-if="user !== null && active.editUser"
        v-bind:user="user"
        v-on:view-dashboard="setActive('dashboard')"
        v-on:update-user="flashSucessAndReload">

        </EditUser>

        <ChangeUserPassword
        v-if="user !== null && active.changePassword"
        v-bind:user="user"
        v-on:view-dashboard="setActive('dashboard')"
        v-on:update-password="flashSucessAndReload"
        v-on:sent-reset-link="flashSucessAndReload">
        </ChangeUserPassword>

    </div>
</template>

<script>
import Pagination from '../utilities/pafination/pagination.vue';
import paginationDetails from '../utilities/pafination/paginationDetails.vue';
import CreateUser from './CreateUser.vue';
import UserLogs from './logs/UserLogs.vue';
import EditUser from './EditUser.vue'
import ChangeUserPassword from './ChangeUserPassword.vue'

export default {
        components: {
            Pagination,
            paginationDetails,
            CreateUser,
            UserLogs,
            EditUser,
            ChangeUserPassword
        },
        data() {
            return{
                results: null,
                active:{
                    dashboard: true,
                    createUser: false,
                    userLogs: false,
                    editUser: false,
                    changePassword: false
                },
                params: {
                    page: 1
                },
                success_message: null,
                danger_message: null,
                user: null,
            }
        },
        methods: {
            getUsers: function() {
                axios.get('/data/users', {params: this.params}).then( response => {
                    this.results = response.data.results;
                } );
            },
            getPage: function(event){
                this.params.page = event;
                window.scrollTo(0, 0);
                this.getUsers();
            },
            setActive: function(component){
                Object.keys(this.active).forEach(key => this.active[key] = false)
                this.active[component] = true
            },
            flashSucessAndReload: function(event){
                this.setActive('dashboard');
                this.flashSucess(event);
                this.getUsers();
            },
            flashSucess: function(message){
                this.success_message = message;
                setTimeout(() => {
                    this.success_message = null; 
                }, 5000);
            },
            deleteUser: function(user){
                let message = confirm("Are you sure, you want to delete" + user.name + "from the system ?");
                if(message){
                    axios.post('/data/users/' + user.id, {_method: 'DELETE'} )
                        .then(response =>  {
                            this.flashSucess(response.data.message);
                            this.getUsers();
                        })
                        .catch(error => {
                            if(error.response.status === 403){
                                this.flashDanger('Unauthorized to access');
                            }
                        })
                        .catch(error => console.log(error));
                }
            },
            flashDanger: function(message){
                this.danger_message = message;
                setTimeout(() => {
                    this.danger_message = null; 
                }, 5000);
            },
            viewUserLog: function(user){
                this.user = user;
                this.setActive('userLogs');
            },
            editUser: function(user){
                this.user = user;
                this.setActive('editUser');
            },
            changePassword: function(user){
                this.user = user;
                this.setActive('changePassword');
            }
        },
        mounted(){
            this.getUsers();
        },
}
</script>
<style lang="">
    
</style>