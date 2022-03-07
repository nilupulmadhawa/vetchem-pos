<template>
    <tbody>
        <tr v-for="(item,index) in items" v-bind:key="item.id">
            <td>{{item.id}}</td>
            <td>{{item.name}}</td>
            <td><input type="text" class="form-control" :value='item.price' readonly ></td>
            <td><input type="number" class="form-control" :value="item.qty" v-on:keyup="calSalePrice(index,$event.target.value)" @change="calSalePrice(index,$event.target.value)" min="1"></td>
            <td><input type="number" class="form-control" :value="item.discount" v-on:keyup="calDiscountPrice(index,$event.target.value)" @change="calDiscountPrice(index,$event.target.value)"  min="0"></td>
            <td><input type="text" class="form-control" :value="item.salePrice" readonly></td>
            <td><input type="text" class="form-control" :value="item.warranty" readonly></td>
            <td><i class="fa fa-trash text-danger" @click="onDelete(item.id)"></i></td>
        </tr>
    </tbody>
</template>

<script>
export default{
    name:'Items',
    props:{
        items:Array
    },
    methods:{
        onDelete(id){
            this.$emit('delete-item', id)
        },
         calSalePrice(index, qty){
            this.$emit("cal-sale-price", index,qty);
         },
         calDiscountPrice(index,dis){
             this.$emit("cal-discount-price", index,dis);
         }
    },
    
}
</script>