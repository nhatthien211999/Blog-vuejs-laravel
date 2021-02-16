<template lang="">
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button class="btn btn-outline-primary mr-3" @click.prevent="$emit('view-dashboard')">
                        <i class="fas fa-chevron-left"></i> Back
                    </button> 
                    Edit User <small class='text-muted'>{{user.name}}</small>
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
                    <label for="" clas="col-3">Name</label>
                    <input type="text" class="form-control" v-model="data.name">
                </div>

                <div class="form-group row">
                    <label for="" clas="col-3">Email</label>
                    <input type="text" class="form-control" v-model="data.email">
                </div>

                <div class="form-group row">
                    <label for="" clas="col-3">Role</label>
                    <select class="form-control" v-model="data.role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button class="btn btn-primary" @click.prevent="updateUser">Update User</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.data = this.user; 
    },
    props: ['user'],
    data() {
        return {
            data: {
                name: '',
                email: '',
                role: ''
            },
            errors: []
        }
    },
    methods: {
        updateUser() {
            this.errors = [];
            axios.post('/data/users/' + this.user.id, {
                _method: 'PUT',
                name: this.data.name,
                email: this.data.email,
                role: this.data.role
            }).then((response) => {
                this.$emit('update-user', response.data.user.name + 'is has been profile updated');
            }).catch((errors) => {
                if (errors.response.status === 422){
                    this.flashError(errors.response.data.errors);
                    console.log(errors.response.data.errors);
                }
                if(errors.response.status === 500){
                    this.errors.push('This email address may already be taken. Please try another one')
                }
            })
        },
        assignUserToData: function(){
            Object.keys(this.data).forEach(key => this.data[key] = this.user[key]);
        },
        flashError: function (errors) {
            for(const [key, value] of Object.entries(errors)){
                for(let item in value){
                    this.errors.push(value[item])
                }
            }
        }
    },
    //theo giỏi và tính toán dữ liệu thay đổi
    watch: {
        user: function() {
            thiss.assignUserToData();
        }
    },

}
</script>
<style lang="">
    
</style>