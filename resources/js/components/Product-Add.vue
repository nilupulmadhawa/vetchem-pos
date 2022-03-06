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
                        <input type="text" class="form-control" id="Name" placeholder="Enter Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Code">Code</label>
                        <input type="text" class="form-control" id="Code" placeholder="Code">
                    </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-12">
                            <label for="tags-basic">Barcode</label>
                            <b-form-tags input-id="tags-basic" v-model="values"></b-form-tags>
                            <a class="btn btn-primary btn-sm mt-1" href="#" role="button">Generate Barcode</a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label for="Quantity">Quantity</label>
                            <input type="number" class="form-control" id="Quantity" min="0" placeholder="Enter Quantity">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="LowQuantity">Minimum Quantity</label>
                            <input type="number" class="form-control" id="LowQuantity" placeholder="Enter Minimum Quantity Limit">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                        <label for="Cost" class="col-md-12">Cost</label>
                        <div class="input-group mb-3 col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rs:</span>
                            </div>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="Cost">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="SalePrice" class="col-md-12">Sale Price</label>
                        <div class="input-group mb-3 col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rs:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="SalePrice">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label for="ExpireDate">Expire Date</label>
                            <input type="date" class="form-control" id="ExpireDate" placeholder="Expire Date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ManufactureDate">Manufacture Date</label>
                            <input type="date" class="form-control" id="ManufactureDate" placeholder="Enter Sale Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </form>
                <div>
                    <button type="button" class="btn btn-primary btn-lg-sm btn-block">Submit</button>
                </div>
        </div>
    </div>

    </div>

    </section>
</template>

<script >
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
    export default {
        data() {
            return {
                values: []
            }
        }
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
