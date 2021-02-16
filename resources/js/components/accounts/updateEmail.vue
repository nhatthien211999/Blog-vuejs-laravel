<template lang="">
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button class="btn btn-outline-primary mr-3" @click.prevent="$emit('view-dashboard')">
                        <i class="fas fa-chevron-left"></i> Back
                    </button> 
                    Edit Email <small class='text-muted'>{{user.name}}</small>
                </h3>

                <hr>

                <div class="alert alert-warning" role='alert' v-if="errors.length > 0">
                    <ul>
                        <li v-for="err in errors">
                            {{err}}
                        </li>
                    </ul>
                </div>

                <div class="form-group row">
                    <label for="" clas="col-3">New Email</label>
                    <input type="text" class="form-control" v-model="data.email">
                </div>

                <div class="form-group row">
                    <label for="" clas="col-3">Enter password to confirm</label>
                    <input type="password" class="form-control" v-model="data.password">
                </div>

                <button class="btn btn-primary" @click.prevent="updateEmail">Update User</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.data.email = this.user.email
    },
    props: ['user'],
    data(){
        return {
            data: {
                email: '',
                password: '',
            },
            errors: [],
        } 
    },
    methods: {
        updateEmail: function(){
            this.errors = [];
            axios.post('/data/accounts/updates/email/' + this.user.id, {
                _method: 'PUT',
                email: this.data.email,
                password: this.data.password
            }).then((response) => {
                console.log(response.data);
                this.$emit('updated-email', response.data.user.name + ' is has been Email updated');
            }).catch((errors) => {
                if(errors.response.status === 403){
                    this.errors.push('Not authorized to change this data. Please verify your password is correct')
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