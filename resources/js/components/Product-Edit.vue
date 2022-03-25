<template>
    <!-- Main content -->
    <section class="content">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product Edit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/dashboard" >Dashboard</router-link></li>
                            <li class="breadcrumb-item active">Product Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->
        <div class="row justify-content-center font-size">
            <div class="col-md-12">
                <div class="card p-3">
                    <form @submit.stop.prevent="submitForm" >
                        <div class="d-flex flex-row">
                        <div class="col-md-6">
                            
                            <div class="form-group d-flex">
                                <label for="categ" class="col-md-4">Category</label>
                                <div class="col-md-8 p-0 ">
                                    <select class="custom-select" id="categ" v-model="category" @click="getSubCategory" required>
                                        <option selected hidden>Choose...</option>
                                        <option  v-for="data in categoryData" v-bind:key="data.id" :value="data.id">{{data.name}}</option>
                                    </select>
                                    <a class="" href="#" role="button" v-b-modal.modal-category>Add Category</a>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <label for="scateg" class="col-md-4">Sub Category</label>
                                <div class="col-md-8 p-0">
                                    <select :disabled="removedis.scat == 1" class="custom-select" id="scateg" v-model="subCategory" required>
                                        <option selected hidden>Choose...</option>
                                        <option  v-for="data in subcategoryData" v-bind:key="data.id" :value="data.id">{{data.name}}</option>
                                    </select>
                                    <a v-if="removedis.seen" href="#" role="button" v-b-modal.modal-sub-category>Add Sub Category</a>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group d-flex">
                                <label for="Name" class="col-md-4">Product Name</label>
                                <input type="text" class="form-control col-md-8" id="Name" placeholder="Enter Name" v-model="name" name="name" required>
                            </div>
                            <div class="form-group d-flex">
                                <label for="Code" class="col-md-4">Code</label>
                                <input type="text" class="form-control col-md-8" id="Code" placeholder="Code" v-model="code" name="code" required>
                            </div>
                            <!-- <div class="form-group d-flex">
                                <label for="tags-basic" class="col-md-4">Barcode</label>
                                <div  class="col-md-8 p-0">
                                    <b-form-tags  input-id="tags-basic" v-model="barcode" required></b-form-tags>
                                    <a class="" href="#" role="button">Generate Barcode</a>
                                </div>
                            </div> -->
                            <hr>
                            <div class="form-group d-flex">
                                <label for="qtyT" class="col-md-4">Qty Type</label>
                                <div  class="col-md-8 p-0">
                                    <select class="custom-select" id="qtyT" v-model="qty_type" required>
                                        <option selected hidden>Choose...</option>
                                        <option  v-for="data in qty_typeData" v-bind:key="data.id" :value="data.name">{{data.name}}</option>
                                    </select>
                                    <a class="" href="#" role="button" v-b-modal.modal-qtyType>Add Type</a>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <label for="Name" class="col-md-4">Re-Order Level</label>
                                <input type="text" class="form-control col-md-8" id="Name" placeholder="Enter Name" v-model="orderLevel" name="name" required>
                            </div>
                            <div class="form-group d-flex">
                                <label for="Name" class="col-md-4">Re-Order Qty</label>
                                <input type="text" class="form-control col-md-8" id="Name" placeholder="Enter Name" v-model="orderQty" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <label for="brand" class="col-md-4">Brand</label>
                                <div  class="col-md-8 p-0">
                                    <select class="custom-select" id="brand" v-model="brand" required>
                                        <option selected hidden>Choose...</option>
                                        <option  v-for="data in brandData" v-bind:key="data.id" :value="data.id">{{data.name}}</option>
                                    </select>
                                    <a class="" href="#" role="button"  v-b-modal.modal-brand>Add Brand</a>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <label for="supp" class="col-md-4">Supplier</label>
                                <div  class="col-md-8 p-0">
                                    <select class="custom-select" id="supp" v-model="supplier" required>
                                        <option selected hidden>Choose...</option>
                                        <option  v-for="data in supplierData" v-bind:key="data.id" :value="data.id">{{data.name}}</option>
                                    </select>
                                    <a class="" href="#" role="button" v-b-modal.modal-supplier>Add Supplier</a>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group d-flex">
                                <label for="description"  class="col-md-4">description</label>
                                <textarea class="form-control col-md-8" id="description" rows="3" v-model="description" name="description" ></textarea>
                            </div>  
                            <div class="form-group d-flex">
                                <label for="Name" class="col-md-4">Status</label>
                                <select class="custom-select" id="supp" v-model="status">
                                        <option value="Acive" selected>Acive</option>
                                        <option value="Inacive">Inacive</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg-sm btn-block" name="submit" >Edit</button>
                        </div>
                    </form>
                </div>

                <div class="card p-3">
                 <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Qty</th>
                            <th scope="col">MFD</th>
                            <th scope="col">EXP</th>
                            <th scope="col">Cost</th>
                            <th scope="col">R_Price</th>
                            <th scope="col">W_Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in invoicepro" v-bind:key="item.id">
                                <td>{{item.initial_qty}}</td>
                                <td>{{item.mfd}}</td>
                                <td>{{item.exp}}</td>
                                <td>{{item.cost}}</td>
                                <td>{{item.r_price}}</td>
                                <td>{{item.ws_price}}</td>
                                <td><i class="fa fa-trash text-danger" @click="onDelete(item.id)"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <SubCategory  @getSubCategory="getSubCategory"  :catid="category"/>
        <Category @getCategory="getCategory"/>
        <Brand @getBrands="getBrands"/>
        <Supplier @getSuppliers="getSuppliers"/>
        <QtyType @getQtyType="getQtyType"/>
    </section>
</template>

<script>
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
import vSelect from 'vue-select';
import Category from './modals/Categorys.vue';
import SubCategory from './modals/SubCategory.vue';
import Brand from './modals/Brand.vue';
import Supplier from './modals/Supplier.vue';
import QtyType from './modals/QtyType.vue';
    export default {
        components: { 
            Category,
            SubCategory,
            Brand,
            Supplier,
            QtyType,
            vSelect
        },
        data(){
            return{
                name:"",
                id:"",
                code:"",
                barcode:[],
                qty_type:"",
                qty_typeData:[],
                description:"",
                category:0,
                categoryData:[],
                subCategory:"",
                subcategoryData:[],
                orderLevel:0,
                orderQty:0,
                brand:"",
                brandData:[],
                supplier:"",
                supplierData:[],
                status:"Acive",
                invoicepro:[],
                removedis:{
                    scat:0,
                    seen:true
                }

            }
        },

        methods:{
            submitForm(e){
                if(this.name != '' && this.code!='' ){
                    // console.log('aaa')
                // && this.barcode!='' && this.qty_type!='' && this.qty!=0 && this.min_qty!=0 && this.s_price!=0 && this.exp!=''
                    axios.post('/api/product/' + this.id, {
                        name: this.name,
                        code: this.code,
                        barcode: this.barcode,
                        qty_type: this.qty_type,
                        orderLevel: this.orderLevel,
                        orderQty: this.orderQty,
                        category: this.category,
                        subCategory: this.subCategory,
                        supplier: this.supplier,
                        brand:this.brand,
                        description: this.description,
                        status: this.status,
                        _method: 'patch'  
                    })
                        .then(response =>{
                            console.log(response.data);
                                if (response.data.isAdded) {
                                    alert('Product insertion success.');

                                }else{
                                    alert('Product instation failed');
                                }
                            })
                            .catch(error =>{
                                console.log(error);
                            })
                }
                else{
                    alert('Please enter all fileds!');
                }

            },
            getCategory(){
                axios.get('/api/category')
                .then(response =>{
                    this.categoryData =response.data;
                    // console.log(this.categoryData);       
                })
                .catch(error =>{
                console.log(error);
                })
            },
            getSubCategory(){
                this.subcategoryData= [];
                if (this.category != 0) {
                    axios.get('/api/subcategory/'+this.category)
                    .then(response =>{
                        this.subcategoryData =response.data;
                        this.removedis.scat = 0;
                        this.removedis.seen = true;
                    })
                    .catch(error =>{
                    console.log(error);
                    })
                }               
                
            },
            getBrands(){
                axios.get('/api/brand')
                .then(response =>{
                    this.brandData =response.data;     
                })
                .catch(error =>{
                console.log(error);
                })
            },
            getSuppliers(){
                axios.get('/api/supplier')
                .then(response =>{
                    this.supplierData =response.data;     
                })
                .catch(error =>{
                console.log(error);
                })
            },
            getProduct(){
                axios.get('/api/product/' +this.$route.params.id)
                .then(response =>{
                    this.id=response.data[0].id;
                    this.name = response.data[0].name;
                    this.code = response.data[0].code;
                    this.barcode = [];
                    this.qty_type = response.data[0].qty_type;
                    this.orderLevel = response.data[0].re_order_level;
                    this.orderQty = response.data[0].re_order_qty;
                    this.category = response.data[0].category_id;
                    this.getSubCategory();
                    this.subCategory = response.data[0].sub_category_id;
                    this.supplier = response.data[0].supplier_id;
                    this.brand = response.data[0].brand_id;
                    this.description = response.data[0].description;
                    this.status = response.data[0].status; 
                    
                })
                .catch(error =>{
                console.log(error);
                })
            },
            getLotInfo() {
               this.invoicepro= [];
                    axios
                .get("/api/product-info/" +this.$route.params.id)
                .then((response) => {
                    this.invoicepro = response.data;
                    console.log(this.invoicepro);   
                })
                .catch((error) => {
                    console.log(error);
                });
                           
            },
            onDelete(id){
                 if (confirm("Are you sure to delete?")) {
                     axios
                    .delete("/api/lot-info/" +id)
                    .then((response) => {
                        if (response.data) {
                            alert('Deleted Successful')
                            this.getLotInfo();
                        }else{
                             alert('Deleted Unsuccessful')
                        }
                    }).catch((error) => {
                        console.log(error);
                    });
                }
            },
            getQtyType(){
                axios.get('/api/qtytype')
                .then(response =>{
                    this.qty_typeData =response.data;     
                })
                .catch(error =>{
                console.log(error);
                })
            },
        },
        mounted: function(){
            this.getCategory();
            this.getBrands();
            this.getQtyType();
            this.getSuppliers();
            this.getProduct();
            this.getLotInfo();
            
                
        },
    }
</script>

<style >
.font-size{
    font-size: 15px;
}
.align-items-baseline {
    -webkit-align-items: baseline !important;
    -ms-flex-align: baseline !important;
    align-items: center !important;
    font-weight: normal;
    font-size: 16px;
    padding: 3px !important;
    /*font-family: Monospace;*/
    /*padding: 4px;*/
    margin-right: 4px;
}
.align-items-baseline span{
    padding: 0 5px 0 5px;
}


</style>
