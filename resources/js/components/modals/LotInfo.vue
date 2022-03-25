<template>
    <div>
        <b-modal
            id="modal-lotInfo"
            ref="lotInfo"
            :title=" this.code+'-'+this.productName "
            ok-only
        >  
        <div v-if="seen.table">   
          <button class="btn btn-secondary  btn-sm" @click="newLot">Add New Lot</button>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Qty</th>
                <th scope="col">EXP</th>
                <th scope="col">Retail Price</th>
                <th scope="col">Wholesale Price</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="data in lotData" v-bind:key="data.id">
                <th scope="row">1</th>
                <td>{{data.qty}}</td>
                <td>{{data.exp}}</td>
                <td>{{data.r_price}}</td>
                <td>{{data.ws_price}}</td>
              </tr>
            </tbody>
          </table>
        </div>  
        <div v-if="seen.form">
          <button class="btn btn-secondary  btn-sm" @click="lotList">Lot details </button>
          <form ref="form" @submit.stop.prevent="handleSubmit">
            <div class="form-group d-flex">
              <label for="supp" class="col-md-4">Quantity</label>
              <div  class="col-md-8 p-0">
                  <input type="number" class="form-control" id="Name" placeholder="Enter Quantity" v-model="qty" name="name" required>
              </div>
            </div> 
            <div class="form-group d-flex">
              <label for="supp" class="col-md-4">MFD</label>
              <div  class="col-md-8 p-0">
                  <input type="date" class="form-control" id="Name" placeholder="Enter MFD" v-model="mfd" name="name" required>
              </div>
            </div>
            <div class="form-group d-flex">
              <label for="supp" class="col-md-4">EXP</label>
              <div  class="col-md-8 p-0">
                  <input type="date" class="form-control" id="Name" placeholder="Enter EXP" v-model="exp" name="name" required>
              </div>
            </div>  
            <div class="form-group d-flex">
              <label for="supp" class="col-md-4">Cost</label>
              <div  class="col-md-8 p-0">
                  <input type="number" class="form-control" id="Name" placeholder="Enter Cost" v-model="cost" name="name" required>
              </div>
            </div>
            <div class="form-group d-flex">
              <label for="supp" class="col-md-4">Retail Price</label>
              <div  class="col-md-8 p-0">
                  <input type="number" class="form-control" id="Name" placeholder="Enter Retail Price" v-model="rprice" name="name" required>
              </div>
            </div>
            <div class="form-group d-flex">
              <label for="wp" class="col-md-4">Wholesale Price</label>
              <div  class="col-md-8 p-0">
                  <input type="number" class="form-control" id="wp" placeholder="Enter Wholesale Price" v-model="wprice" name="name" required>
              </div>
            </div>
            <div class="form-group d-flex">
               <label for="supp" class="col-md-4"></label>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
        <router-link :to="'/edit-product/' + id" >Edit Product</router-link>
    </b-modal>
    </div>
</template>
<script>
export default {
    name:'LotInfo',
    data() {
      return {
        qty: '',
        mfd: '',
        exp: '',
        cost: '',
        rprice: '',
        wprice: '',
        data: [],
        seen:{
          table:true,
          form:false
        }
      }
    },
    props:{
        lotData:Array,
        code:String,
        id:Number,
        productName:String,
    },
    methods: {
      newLot() {
        this.seen.table = false;
        this.seen.form = true;
      },
      lotList() {
        this.seen.table = true;
        this.seen.form = false;
      },
      handleSubmit() {

         
        axios.post('/api/lot-info', {
                qty: this.qty,
                mfd: this.mfd,
                exp: this.exp,
                cost: this.cost,
                rprice: this.rprice,
                wprice: this.wprice,
                id: this.id,
            })
            .then(response =>{
                this.$emit('setLotInfo')  
                this.qty=''
                this.mfd=''
                this.exp=''
                this.cost=''
                this.rprice=''
                this.wprice=''
                this.id=''
                this.lotList()          
            })
            .catch(error =>{
              console.log(error);
            })
      }
      
    }
  }
</script>