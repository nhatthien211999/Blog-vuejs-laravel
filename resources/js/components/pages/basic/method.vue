<template lang="">
    <div>
        <h1>The number is: {{counter}}</h1>
        <button @click = "updateCounter(1)">Increase</button>
        <button @click = "updateCounter(-1)">Decrease</button>
        <br>
        <br>
        <div v-for="(blog, index) in blogs" :key="index">
            <p>{{blog.id}}</p>
            <h1>{{blog.title}}</h1>
            <h2>{{blog.content}}</h2>
        </div>
        <br>
        <br>
        <div>
            <h1 v-if="showItem">Show item: True</h1>
            <h1 v-else>Show item: False</h1>
        </div>
        <button @click="showItem = !showItem">Show</button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            counter: 0,
            blogs: [],
            showItem: false
        }
    },
    methods: {
        updateCounter( number ){
            this.counter += number;
        }
    },
    created() {
        let posts = [
            {id: 1, title: 'book 1', content: 'this is book 1'},
            {id: 2, title: 'book 2', content: 'this is book 2'},
            {id: 3, title: 'book 3', content: 'this is book 3'},
            {id: 4, title: 'book 4', content: 'this is book 4'},
            {id: 5, title: 'book 5', content: 'this is book 5'},

        ];
        this.blogs = posts;
    }   
}

</script>
<style lang="">
    
</style>