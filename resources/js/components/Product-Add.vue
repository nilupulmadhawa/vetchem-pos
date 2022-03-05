<template>
    <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                        <label for="Barcode">Code</label>
                        <input type="text" class="form-control" id="Barcode" placeholder="Barcode">
                    </div>
                    </div>
                    <div class="form-group ">
                        <label for="GenerateBarcode">Barcode</label>
                        <div class="d-flex">
                        <input type="text" class="form-control col-md-10" id="GenerateBarcode" placeholder="Barcode">
                        <a class="btn btn-primary col-md-2 ml-1" href="#" role="button">Generate Barcode</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </form>
        </div>
    </div>

    </div>

    </section>
</template>

<script>
    export default {

    }
</script>
