<template>
    <!-- Main content -->
    <section class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Billing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Billing</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

<div class="content" v-on:keyup="inputFocas($event)">
    <div class="row">
        <div class="col-md-9">
            <div class="card p-2 pt-4 d-flex flex-row justify-content-center">
                <div class="form-group d-flex flex-row col-md-4 align-items-center">
                    <label class="m-3">Barcode</label>
                    <input ref="barcodeInput" type="text" class="form-control" v-model="inputBarcode" autofocus v-on:change="selectByBarcode($event)">
                </div>
                <div class="form-group d-flex flex-row col-md-4 align-items-center">
                    <label class="m-3">Name</label>
                    <!-- <select class="select2" style="width: 100%;" @change="$emit('barcode', optionsArray)">
                        <option value="" disabled selected>Search By Name..</option>
                        <option v-for="product in products" v-bind:key="product.id" :value="product.barcodeid" @input="onSelect">{{product.productname}}</option>
                    </select> -->
                    <v-select class="vselect" :options="products" v-model="inputName" label="productname" @input="selectByName" :select-on-key-codes="[188, 13]"></v-select>
                </div>
            </div>
            <div class="card p-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">id</th>
                            <th width="20%">Name</th>
                            <th >Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Sale Price</th>
                            <th>Warranty</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
      
                </table>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <div class="form-group">
                    <label>Sub Total</label>
                    <input type="number" class="form-control"  v-model.number="subTotal" readonly>
                </div>
                <div class="form-group">
                    <label>Discount</label>
                    <input ref="discount" type="number" class="form-control" v-model.number="tDiscount"  min="0">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" class="form-control" value="0" readonly v-model.number="total">
                </div>
            </div>
            <div class="card p-3">
                <div class="form-group">
                    <label>Pay Amount</label>
                    <input type="number" class="form-control" v-model.number="payAmount" min="0">
                </div>
                <div class="form-group">
                    <label>Balance</label>
                    <input type="number" class="form-control" value="0" readonly v-model.number="balance" v-on:keyup="inputFocas">
                </div>
            </div>
            <button type="button" class="btn btn-block btn-primary" @click="save" @keyup.left="save">Submit</button>
        </div>
    </div>
</div>
        </section>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
    export default {
        components: { 
            vSelect 
        },
        name:'Invoiceform',
        data(){
            return{
                items:[],
                products:[],
                tDiscount:0,
                payAmount:0,
                inputName:[],
                inputBarcode:"",
            }
        },
        methods:{
            save() {
                let validated = true;    
                if (this.items.length>0) {                    
                    this.items.forEach(item => {
                       if (!(item.qty > 0) ) {
                            alert(item.name +' quantity must be greater than 1');
                            validated = false;
                       }else if(!(item.discount >= 0)){
                            alert(item.name +' discount must be greater than 0');
                            validated = false;
                       }
                   });

                    if (!(this.tDiscount>=0)) {
                        alert('Discount must be greater than 0');
                        validated = false;
                    }else if(!(this.payAmount>=0)){
                        alert('Pay Amount must be greater than 0');
                        validated = false;
                    }

                    if (validated) {   
                        axios.post('/api/saveinvoice',{
                            items:this.items,
                            subTotal:this.subTotal,
                            tDiscount:this.tDiscount,
                            total:this.total,
                            payAmount:this.payAmount,
                            balance:this.balance,
                            })
                        .then(response =>{
                            if (response.data.isAdded) {
                                // console.log( window.location.origin+"/invoice/"+response.data.id);
                                window.location.href = window.location.origin+"/invoice/"+response.data.id;
                                // location.reload();
                            }else{
                                alert(response.data.error)
                            }
                        })
                        .catch(error =>{
                            console.log(error);
                        })
                    }
                } else{
                    alert('No item found');
                }
            },
            getProducts() {
                axios.get('/api/products')
                .then(response =>{
                    
                    this.products =response.data;
                })
                .catch(error =>{
                    console.log(error);
                })
            },
            selectByName(value){
                if (this.isExist(value.id)) {
                    alert('Already added');
                    this.inputName=[];
                }else{
                    this.items.push({
                        id:value.id,
                        barcode:value.barcodeid,
                        name:value.productname,
                        price:value.salesprice,
                        qty:1.00,
                        discount:0.00,
                        salePrice:value.salesprice,
                        warranty:value.warranty,
                    });
                    this.inputName=[];
                }
                
            },
            selectByBarcode(event){
                var ob = this.products.filter(function(product){
                    if(product.barcodeid == event.target.value)
                     return product;
                });

                if(ob.length > 0){
                    if (this.isExist(ob[0].id)) {
                        alert('Already added');
                        this.inputBarcode="";
                    }else{
                        this.items.push({
                            id:ob[0].id,
                            barcode:ob[0].barcodeid,
                            name:ob[0].productname,
                            price:ob[0].salesprice,
                            qty:1.00,
                            discount:0.00,
                            salePrice:ob[0].salesprice,
                            warranty:ob[0].warranty,
                        });
                        this.inputBarcode="";
                        this.$refs.barcodeInput.focus();
                    }
                    
                }else{
                    alert('Barcode Not Valid');
                    this.inputBarcode="";
                }
            },
            deleteItem(id){
                this.items = this.items.filter((item)=>item.id !== id );
            },
            calSalePrice(index,qty){
                this.items[index].qty = qty;
                this.calAll(index);
            },
            calDiscountPrice(index,dis){
                this.items[index].discount = dis;
                this.calAll(index);
            },
            calAll(index){
                var tot = this.items[index].price*this.items[index].qty;
                this.items[index].salePrice = tot-this.items[index].discount;
            },
            isExist (p){
                 var ob = this.items.filter(function(item){
                    if(item.id == p)
                     return item;
                });

                if(ob.length > 0){
                    return true;
                }else{
                    return false;
                }
            },
            _keyListener(e) {
                // console.log(e.code);
                if (e.code == 'NumpadDivide') {
                    this.$refs.discount.select();
                } 
                if (e.code == 'Insert') {
                    this.save();
                }   
            // this.$refs.barcodeInput.focus();
            },
            inputFocas(e){
                    // console.log(e);
            }
        },
        mounted: function(){
            
            this.getProducts();
            
        },
        created: function () {
            window.addEventListener('keyup', this._keyListener)
    },
        computed: {
            total: function () {
                return this.subTotal-this.tDiscount;
            
            },
            subTotal: function () {
                return this.items.reduce((total, item) => {
                    return total + (item.qty * item.price)-item.discount;
                    }, 0);
            },
            balance: function () {
                return this.payAmount- this.total;
            
            },
        },
    }
</script>

<style>

.vselect {
  width: 100%;
}
</style>