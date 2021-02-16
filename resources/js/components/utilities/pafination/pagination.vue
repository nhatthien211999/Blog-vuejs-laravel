<template lang="">
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- After number -->
                <li class="page-item"
                 v-if="results.current_page > 1 ">
                    <a class="page-link" href="#" @click.prevent="$emit('get-page', 1)">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>

                <li class="page-item"
                v-if="results.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="$emit('get-page', results.current_page - 1)">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>

                <!-- Number -->
                <li class="page-item"
                v-if="results.current_page > 5">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item"
                v-for="num in results.last_page">
                    <a class="page-link" href="#" 
                    @click.prevent="$emit('get-page', num)"
                    v-if="num > results.current_page - 5 && num < results.current_page + 5"
                    :class="{active: num === results.current_page}">
                        {{num}}
                    </a>
                </li>
                <li class="page-item"
                v-if="results.current_page < results.last_page - 5">
                    <span class="page-link">...</span>
                </li>
                <!-- Before number -->
                <li class="page-item"
                v-if="results.current_page < results.last_page">
                    <a class="page-link" href="#" @click.prevent="$emit('get-page', results.current_page + 1)">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>

                <li class="page-item"
                 v-if="results.current_page < results.last_page">
                    <a class="page-link" :href="results.last_page_url" @click.prevent="$emit('get-page', results.last_page)">
                        <i class="fas fa-chevron-right"></i>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    mounted(){
    },
    props: ['results']
}
</script>