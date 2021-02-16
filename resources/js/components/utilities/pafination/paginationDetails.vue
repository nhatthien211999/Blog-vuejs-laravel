<template lang="">
    <div>
        <h5>Show {{results.from}} to {{results.to}} of {{results.total}} | Page {{results.current_page}} of {{results.last_page}}</h5>
    </div>
</template>
<script>
export default {
    mounted() {

    },
    props: ['results']
}
</script>
<style lang="">
    
</style>