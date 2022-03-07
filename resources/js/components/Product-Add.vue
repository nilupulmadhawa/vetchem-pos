<template>
    <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Add</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-2">
                <form >
                    <div class="d-flex">
                    <div class="form-group col-md-6">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" placeholder="Enter Name" v-model="name" name="name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Code">Code</label>
                        <input type="text" class="form-control" id="Code" placeholder="Code" v-model="code" name="code" required>
                    </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col-md-12">
                            <label for="tags-basic">Barcode</label>
                            <b-form-tags input-id="tags-basic" v-model="barcode" required></b-form-tags>
                            <a class="btn btn-primary btn-sm mt-1" href="#" role="button">Generate Barcode</a>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label for="Quantity" >Quantity</label>
                            <div class="input-group col-md-12 p-0">
                                <div class="input-group-prepend col-md-12 p-0">
                                    <select class="form-control col-md-2 btn btn-outline-primary" v-model="qty_type">
                                        <option class="dropdown-item" value="kg">Kg</option>
                                        <option class="dropdown-item" value="pcs">Pcs</option>
                                    </select>
                                <input type="number" class="form-control col-md-10" aria-label="Text input with dropdown button" id="Quantity" placeholder="Enter Quantity" v-model="qty" name="qty" required>
                            </div>
                        </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="MinimumQuantity" >Minimum Quantity</label>
                            <div class="input-group col-md-12 p-0">
                                <input type="number" class="form-control" id="MinimumQuantity" placeholder="Enter Quantity" v-model="min_qty" name="min_qty" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                        <label for="Cost" class="col-md-12 p-0">Cost</label>
                        <div class="input-group mb-3 col-md-12 p-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rs:</span>
                            </div>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="Cost" v-model="cost" name="cost" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="SalePrice" class="col-md-12 p-0">Sale Price</label>
                        <div class="input-group mb-3 col-md-12 p-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rs:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="SalePrice" v-model="s_price" name="sprice" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label for="ExpireDate">Expire Date</label>
                            <input type="date" class="form-control" id="ExpireDate" placeholder="Expire Date" v-model="exp" name="exp" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ManufactureDate">Manufacture Date</label>
                            <input type="date" class="form-control" id="ManufactureDate" placeholder="Enter Sale Price" v-model="mfd" name="mfd" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea class="form-control" id="description" rows="3" v-model="description" name="description" required></textarea>
                    </div>
                </form>
                <div>
                    <button type="button" class="btn btn-primary btn-lg-sm btn-block" name="submit" @click='submitForm();'>Submit</button>
                </div>
        </div>
    </div>

    </div>

    </section>
</template>

<script>
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
    export default {

        data(){
            return{
                name:"",
                code:"",
                barcode:"",
                qty_type:"",
                qty:0,
                min_qty:0,
                cost:0,
                s_price:0,
                exp:"",
                mfd:"",
                description:"",
            }
        },

        methods:{
            submitForm(){
                console.log("test");
                // console.log(this.name);
                // console.log(this.qty_type, this.qty);
                // let validated = true;

                if(this.name != '' && this.code!='' && this.barcode!='' && this.qty_type!='' && this.qty!=0 && this.min_qty!=0 && this.s_price!=0 && this.exp!=''){
                    axios.post('api/product',{
                        name:this.name,
                        code:this.code,
                        barcode:this.barcode,
                        qty_type:this.qty_type,
                        qty:this.qty,
                        min_qty:this.min_qty,
                        cost:this.cost,
                        s_price:this.s_price,
                        exp:this.exp,
                        mfd:this.mfd,
                        description:this.description

                            .then(response =>{
                                if (response.data.isAdded) {
                                    alert('Product insertion success.');
                                        name="",
                                        code="",
                                        barcode="",
                                        qty_type="",
                                        qty=0,
                                        min_qty=0,
                                        cost=0,
                                        s_price=0,
                                        exp="",
                                        mfd="",
                                        description=""

                                }else{
                                    alert('Product instation failed');
                                }
                            })
                            .catch(error =>{
                                console.log(error);
                            })

                    })
                }
                else{
                    alert('Please enter all fileds!');
                }

            },
        },
    }
</script>

<style >
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
