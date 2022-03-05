<template>
    <!-- Main content -->
    <section class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                    <div class="input-group">
                        <button class="btn input-group-text" type="button"><font-awesome-icon icon="fa-solid fa-barcode" /></button>
                        <button class="btn input-group-text" type="button"><i class="fa fa-h-square" aria-hidden="true"></i></button>
                        <button class="btn input-group-text" type="button"><i class="fa fa-tag" aria-hidden="true"></i></button>
                        <div class="input-group-prepend">
                            <span class="input-group-text ml-3" id=""><i class="nav-icon fas fa-search"></i></span>
                            <v-select class="vselect" 
                                :options="products"
                                label="title"
                                :select-on-key-codes="[188, 13]">
                                </v-select>
                        </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import specific icons */
import { faUserSecret, faBarcode } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret,faBarcode)

export default {
    components:{
        'v-select':vSelect
    },
     data() {
            return{
            products: [
                {
                    title:"Id",
                    visible: true,
                    editable: false
                },
                {
                    title:"Sub total",
                    visible: true,
                    editable: false
                },
                {
                    title:"Discount",
                    visible: true,
                    editable: false,
                },
                {
                    title:"Total",
                    visible: true,
                    editable: false,
                },
                {
                    title:"Date",
                    visible: true,
                    editable: false
                }
            ],
            }
        },
};
</script>

<style>
#vselect{
    width: 100%;
}
</style>