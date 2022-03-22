<template>
    <div>
        <b-modal
            id="modal-add-sup-invoice"
            ref="modal"
            title="Add Invoice"
            size="xl"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleSubmit"
        >       
            <form ref="form" @submit.stop.prevent="handleSubmit">
              <div class="d-flex">
              <div class="col-md-6">
                <div class="form-group d-flex">
                  <label for="invoiceid" class="col-md-2">Invoice_No</label>
                  <input class="form-control" v-model="inviceId" type="text">
                </div>
                <div class="form-group d-flex">
                  <label for="invoiceid" class="col-md-2">Date</label>
                  <input class="form-control" v-model="date" type="date">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group d-flex">
                  <label for="invoiceid" class="col-md-2">Note</label>
                  <input class="form-control" v-model="note" type="text">
                </div>
                <div class="form-group d-flex">
                  <label for="invoiceid" class="col-md-2">Total</label>
                  <input class="form-control" v-model="total" type="text">
                </div>
                <div class="form-check ml-3 mb-3">
                    <input class="form-check-input" type="radio" name="status" id="paid" checked v-model="is_paid" value="1">
                    <label class="form-check-label col-md-5" for="paid">
                    Paid
                    </label>
                    <input class="form-check-input" type="radio" name="status" id="unpaid" v-model="is_paid" value="0">
                    <label class="form-check-label col-md-5" for="unpaid">
                        Credit
                    </label>
                </div>
              </div>
              </div>
              <hr>
              <div class="form-group d-flex">
                  <label for="invoiceid" class="col-md-2">Total</label>
                  <v-select  class="vselect" :options="products" label="name" @input="selectByName" v-model="inputName"></v-select>
              </div>
              <hr>
              <div>
                <table class="table">
                   <thead>
                      <tr>
                        <th scope="col">code</th>
                        <th scope="col">name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">MFD</th>
                        <th scope="col">EXP</th>
                        <th scope="col">Cost</th>
                        <th scope="col">R_Price</th>
                        <th scope="col">W_Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in items" v-bind:key="item.id">
                        <th scope="row">{{item.code}}</th>
                        <td>{{item.name}}</td>
                        <td><input type="number" class="form-control" v-model="item.qty" ></td>
                        <td><input type="date" class="form-control" v-model="item.mfd"  ></td>
                        <td><input type="date" class="form-control" v-model="item.exp"  ></td>
                        <td><input type="number" class="form-control" v-model="item.cost" ></td>
                        <td><input type="number" class="form-control" v-model="item.rprice" ></td>
                        <td><input type="number" class="form-control" v-model="item.wprice" ></td>
                        <td><i class="fa fa-trash text-danger" @click="deleteItem(item.id)"></i></td>
                      </tr>
                    </tbody>
                </table>
              </div>
            </form>
    </b-modal>
    </div>
</template>
<script>
import vSelect from 'vue-select'
export default {
    name:'AddSupplierInvoice',
    components: { 
            vSelect
        },
    data() {
      return {
        items:[],
        products:[],
        inviceId:'',
        date:'',
        note:'',
        total:'',
        inputName:'',
        is_paid:'1'
      }
    },
    methods: {
      getProducts() {
        axios.get('/api/productsupply/' +this.$route.params.id)
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
      selectByName(value){
        if (this.isExist(value.id)) {
            alert('Already added');
            this.inputName=[];
        }else{
            axios.get('/api/product/'+value.id)
            .then(response =>{
              // console.log( response.data[0].id);
                  this.items.push({
                        id :response.data[0].id,
                        code :response.data[0].code,
                        name :response.data[0].name,
                        qty:'',
                        mfd:'',
                        exp:'',
                        cost:'',
                        rprice:'',
                        wprice:'',
                        
                    });
                // this.$refs['invoice_pre'].show();
                this.inputName=[];
            })
            .catch(error =>{
                console.log(error);
            })
            
            
        }
          
      },
      isExist(p){
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
      deleteItem(id){
        this.items = this.items.filter((item)=>item.id !== id );
      },
      checkFormValidity() {
        const valid = true
        this.nameState = valid
        return valid
      },
      resetModal() {
        this.name = ''
        this.nameState = null
      },
      handleSubmit() {
        axios.post('/api/supplier-invoice', {
                supId: this.$route.params.id,
                items:this.items,
                inviceId:this.inviceId,
                date:this.date,
                note:this.note,
                is_paid:this.is_paid,
                total:this.total,
            })
            .then(response =>{
              console.log(response.data);
                 this.items=[];
                this.inviceId='';
                this.date='';
                this.note='';
                this.total='';
                this.$emit('getProductSupply')                
                this.$emit('getSupplyInvoice')                
            })
            .catch(error =>{
            console.log(error);
            })
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the name to submitted names
        
        this.submittedNames.push(this.name)
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-add-sup-invoice')
        })
      }
      
    },
    mounted: function(){            
            this.getProducts();
            
      },
  }
</script>