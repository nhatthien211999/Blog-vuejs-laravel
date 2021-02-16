<template lang="">
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button class="btn btn-outline-primary mr-3" @click.prevent="$emit('view-dashboard')">
                        <i class="fas fa-chevron-left"></i> Back
                    </button> 
                    Change User Password 
                    <small class='text-muted'>{{user.name}}</small>
                    <button class="btn btn-sm btn-outline-primary" @click.prevent="sendResetLink">
                        Send Reset Link
                    </button> 
                </h3>

                <div class="alert alert-warning" role="alert" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors">
                            {{error}}
                        </li>
                    </ul>
                </div>

                <div class="form-group row">
                    <label for="" clas="col-3">Password</label>
                    <input type="password" class="form-control" v-model="data.password">     
                </div>

                <div class="form-group row">
                    <label for="" clas="col-3">Confirm Password</label>
                    <input type="password" class="form-control" v-model="data.confirm_password">
                </div>

                <button class="btn btn-primary" @click.prevent="updatePassword">Update Password</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['user'],
    data () {
        return {
            data: {
                password: '',
                confirm_password: ''
            },
            errors: []
        }
    },
    methods: {
        sendResetLink: function(){
            axios.post('/data/users/updates/sent-reset-link/'+this.user.id,{
                _method: 'POST'
            })
            .then( response => {
                this.$emit('sent-reset-link', 'Successfully sent reset link to ' + this.user.name)
            } )
        },
        updatePassword: function(){
            this.errors = [];
            axios.post('/data/users/updates/password/'+ this.user.id,{
                _method: 'PUT',
                password: this.data.password,
                confirm_password: this.data.confirm_password
            }).then(response => {
                this.$emit('update-password', 'successfully updated password for '+ this.user.name);
            }).catch(errors => {
                if(errors.response.status === 422){
                    this.flashError(errors.response.data.errors);
                }
                if(errors.response.status === 403){
                    this.errors.push('Not authoried to change this user password');
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