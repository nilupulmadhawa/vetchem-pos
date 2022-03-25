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
                    <input autofocus ref="barcodeInput" type="text" class="form-control" v-model="inputBarcode"  v-on:change="selectByBarcode($event)">
                </div>
                <!-- <div class="form-group d-flex flex-row col-md-4 align-items-center">
                    <label class="m-3">Code</label>
                    <input ref="codeInput" type="text" class="form-control" v-model="inputCode" v-on:change="selectByCode($event)">
                </div> -->
                <div class="form-group d-flex flex-row col-md-8 align-items-center">
                    <label class="m-3">Name</label>
                    <!-- <select class="select2" style="width: 100%;" @change="$emit('barcode', optionsArray)">
                        <option value="" disabled selected>Search By Name..</option>
                        <option v-for="product in products" v-bind:key="product.id" :value="product.barcodeid" @input="onSelect">{{product.productname}}</option>
                    </select> -->
                    <v-select  class="vselect" :options="products" v-model="inputName" label="name" @input="selectByName" :select-on-key-codes="[188, 13]"></v-select>
                </div>
            </div>
            <div class="card p-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">Code</th>
                            <th width="20%">Name</th>
                            <th >Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Sale Price</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                        <Items @delete-item="deleteItem" @cal-sale-price="calSalePrice" @cal-discount-price="calDiscountPrice" :items="items"/>
                </table>
            </div>
        </div>

        <div class="col-md-3 slabel">
            <div class="card p-3">
                <div class="form-group d-flex">
                    <label class="col-md-5">Sub Total</label>
                    <input type="number" class="form-control col-md-7"  v-model.number="subTotal" readonly>
                </div>
                <div class="form-group d-flex">
                    <label class="col-md-5">Discount</label>
                    <input ref="discount" type="number" class="form-control col-md-7" v-model.number="tDiscount"  min="0">
                </div>
                <div class="form-group d-flex">
                    <label class="col-md-5">Total</label>
                    <input type="number" class="form-control col-md-7" value="0" readonly v-model.number="total">
                </div>
            </div>
            <div class="card p-3">
                <div class="form-group d-flex">
                    <label class="col-md-5">Customer</label>
                    <v-select style="font-size:13px;" class="vselect" :options="customers" v-model="cusName" label="name"></v-select>
                </div>
                <a style="margin:-15px 0 10px 10px" href="#" role="button" v-b-modal.modal-customer>Add Customer</a>
                <div class="form-group d-flex">
                    <label class="col-md-5">Note</label>
                    <textarea name="note" v-model="cusDetails" rows="2" class="form-control col-md-7"></textarea>
                </div>
            </div>
             <div class="card p-3">
                <div class="form-check ml-3 mb-3">
                    <input class="form-check-input" type="radio" name="status" id="paid" checked v-model="status" value="Paid">
                    <label class="form-check-label col-md-5" for="paid">
                    Paid
                    </label>
                    <input class="form-check-input" type="radio" name="status" id="unpaid" v-model="status" value="Unpaid">
                    <label class="form-check-label col-md-5" for="unpaid">
                        Credit
                    </label>
                </div>
                <dir v-if="status === 'Paid'" class="p-0">
                    <div class="form-group d-flex">
                        <label class="col-md-5">Pay Amount</label>
                        <input type="number" class="form-control col-md-7" v-model.number="payAmount" min="0">
                    </div>
                    <div class="form-group d-flex">
                        <label class="col-md-5">Balance</label>
                        <input type="number" class="form-control col-md-7" value="0" readonly>
                    </div>
                </dir>
            </div>
            <button type="button" class="btn btn-block btn-primary" @click="save" @keyup.left="save">Submit</button>
        </div>
    </div>
</div>

<b-modal ref="invoice_pre" size="mg" ok-only no-stacking>
     <div class="card">
         <div class="card-header p-2">
            <h4 class="mb-0">Item Batch Select</h4>
         </div>
         <div class="card-body">
             <table class="table table-fixed table-condensed">
                     <thead>
                         <tr>
                             <th class="center">Id</th>
                             <th class="center">Expiry Data</th>
                             <th class="center">Qty</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr v-for="lot in lots" v-bind:key="lot.id" >
                             <td class="center">{{lot.id}}</td>
                             <td class="center">{{lot.exp}}</td>
                             <td class="center">{{lot.qty}}</td>
                             <td class="center">{{lot.s_price}}</td>
                             <td class="center"><button class="btn btn-primary"  :ref="'addBtn'+index"  v-on:click="addItem(lot.id)"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                         </tr>
                     </tbody>
                 </table>
         </div>
     </div>
    
  </b-modal>
  <Customer @getCustmers="getCustmers"/>
        </section>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Items from './billing/Items.vue';
import Customer from './modals/Customer.vue';
    export default {
        components: { 
            vSelect,
            Items,
            Customer
        },
        name:'Billing',
        data(){
            return{
                items:[],
                products:[],
                customers:[],
                temp:[],
                tDiscount:0,
                payAmount:0,
                inputName:[],
                lots:[],
                inputBarcode:"",
                inputCode:"",
                status:"Paid",
                cusName:{
                        description: "",
                        id: 1,
                        name: "New Customer"},
            }
        },
        props: {
         index: {
             type: Number,
             required: false,
             default: 1
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
                    }else if(this.cusName.id == 1 && this.status != "Paid"){
                        alert('Please select customer');
                        validated = false;
                    }
                    var is_paid = 0;
                    if (this.status == "Paid") {
                        is_paid = 1; 
                    }

                    if (validated) {   
                        
                        axios.post('/api/invoice',{
                            items:this.items,
                            subTotal:this.subTotal,
                            tDiscount:this.tDiscount,
                            total:this.total,
                            payAmount:this.payAmount,
                            balance:this.balance,
                            is_paid:is_paid,
                            cusid:this.cusName.id,
                            })
                        .then(response =>{
                            if (response.data.isAdded) {
                                // console.log( window.location.origin+"/invoice/"+response.data.id);
                                window.location.href = window.location.origin+"/invoice/print/"+response.data.id;
                                // location.reload();
                                this.items=[]
                            }else{
                                alert(response.data.error);
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
                axios.get('/api/product')
                .then(response =>{
                    response.data.forEach(prdetails => {
                        this.products.push({
                                id :prdetails.id,
                                name :prdetails.code+' - '+prdetails.name,
                                 code :prdetails.code,
                            });
                    });                    
                })
                .catch(error =>{
                    console.log(error);
                })
            },
            getCustmers() {
                axios.get('/api/customer')
                .then(response =>{
                    this.customers = response.data                   
                })
                .catch(error =>{
                    console.log(error);
                })
            },
            addItem(id) {
                axios.get('/api/lot-info/'+id)
                .then(response =>{                   
                        if (this.isExist(response.data.product_id)) {
                            alert('Already added');
                            this.inputBarcode="";
                        }else{
                             var ob = this.products.filter(function(product){
                                if(product.id ==response.data.product_id){
                                return product;
                                }
                            });
                            this.items.push({
                                id:ob[0].id,
                                code:ob[0].code,
                                name:ob[0].name,
                                price:response.data.r_price,
                                lotId:id,
                                qty:1.00,
                                discount:0.00,
                                salePrice:response.data.r_price,
                            });
                           this.lots=[];
                        }
                    this.inputName=[];
                    this.$refs['invoice_pre'].hide();
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
                    axios.get('/api/product-info/'+value.id)
                    .then(response =>{
                        console.log(response.data);
                        this.lots = response.data;
                        this.$refs['invoice_pre'].show();
                        this.inputName=[];
                    })
                    .catch(error =>{
                        console.log(error);
                    })
                   
                    
                }
                
            },
            selectByCode(event){
                var ob = this.products.filter(function(product){
                    if(product.code == event.target.value)
                     return product;
                });

                if(ob.length > 0){
                    if (this.isExist(ob[0].id)) {
                        alert('Already added');
                        this.inputCode="";
                    }else{
                        axios.get('/api/product-info/'+ob[0].id)
                        .then(response =>{
                            // this.lots = response.data;
                            this.$refs['invoice_pre'].show();
                            this.inputCode="";
                        })
                        .catch(error =>{
                            console.log(error);
                        })
                    }
                    
                }else{
                    alert('Code Not Valid');
                    this.inputCode="";
                }
            },
            selectByBarcode(event){
               var ob = this.products.filter(function(product){
                    if(product.code == event.target.value)
                     return product;
                });

                if(ob.length > 0){
                    if (this.isExist(ob[0].id)) {
                        alert('Already added');
                        this.inputBarcode="";
                    }else{
                        axios.get('/api/product-info/'+ob[0].id)
                        .then(response =>{
                            this.lots = response.data;
                            this.$refs['invoice_pre'].show();
                            this.inputBarcode="";
                        })
                        .catch(error =>{
                            console.log(error);
                        })
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
            this.getCustmers();
            
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
            cusDetails: function () {
                 return this.cusName.description;
            },
        },
    }
</script>

<style>

.vselect {
  width: 100%;
}

.modal-backdrop{
    opacity: 0.5;
}

.slabel label{
    font-size: 16px;
}
</style>