<template lang="">
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <h3>
                    <button class="btn btn-outline-primary mr-3" @click.prevent="$emit('view-dashboard')">
                        <i class="fas fa-chevron-left"></i> Back
                    </button> 
                    User Logs 
                    <small class="text-muted">
                    {{user.name}}
                    </small>
                </h3>
            </div>

                <pagination 
                    v-if="results !== null"
                    v-bind:results = 'results'
                ></pagination>

                <paginationDetails
                    v-if="results !== null"
                    v-bind:results = 'results'>
                </paginationDetails>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Log type</th>
                        <th>Message</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody v-if="results != null">
                    <tr v-for="(log, index) in results.data" :key="index">
                        <td>{{log.slug}}</td>
                        <td>{{log.message}}</td>
                        <td>{{log.pretty_date}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import Pagination from '../../utilities/pafination/pagination.vue';
import paginationDetails from '../../utilities/pafination/paginationDetails.vue';

export default {
    components: {
            Pagination,
            paginationDetails,
        },
    mounted(){
        this.getLogs();
    },
    props: ['user'],
    data(){
        return {
            results: null,
            params: {
                page: 1
            }
        }
    },
    methods: {
        getLogs: function () {
            axios.get('/data/users/logs/' + this.user.id, {params: this.params})
            .then( response => {
                this.results = response.data.results;
            } )
            .catch( error => console.log(error.data))
        }
    }
}
</script>
<style lang="">
    
</style>