<template lang="">
    <div>
        <h1>hooks</h1>
        <p>{{name}}</p>
    </div>
</template>
<script>
export default {
    data() {
        return{
            name: 'hooks test'
        }
    },
    beforeCreate() {

    },
    created() {
        //call mostly initial data from it ...
        //call API, Ajax
    },
    beforeMount() {
        
    },
    mounted() {
        //Toàn bộ cấu trúc DOM mới hiểu thị ra html
        //đến hàm này mới có thể thêm và sử dụng các thư viện như jquery
        //Nếu muốn truy xuất Jquery -> chỉ truy xuất trong hàm mounted
    },
    beforeUpdate() {

    },
    updated() {
        //update xong làm gì đó???, thay đổi data xong làm gì đó, ...
    },
    beforeDestroy() {
        //Xóa thư viện của bên thứ 3
    },
    destroyed() {

    }
}
</script>
<style lang="">
    
</style>