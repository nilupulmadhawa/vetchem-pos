<template>
        <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/supplier" >Supplier List</router-link></li>
                        <li class="breadcrumb-item active">Supplier Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

     <!-- /.content-header -->
    <div class="card p-3">
        <div class="form-group d-flex">
            <label for="name" class="col-md-4">Product Name</label>
            <input type="text" class="form-control col-md-8" id="name"  placeholder="Enter Name" v-model="sDetails[0].name"  readonly>
        </div>
        <div class="form-group d-flex">
            <label for="company" class="col-md-4">Company</label>
            <input type="text" class="form-control col-md-8" id="company" placeholder="company" v-model="sDetails[0].company"  readonly>
        </div>
        <div class="form-group d-flex">
            <label for="phone_number" class="col-md-4">Phone Number</label>
            <input type="text" class="form-control col-md-8" id="phone_number" placeholder="phone_number" v-model="sDetails[0].phone_number"  readonly>
        </div>
        <div class="form-group d-flex">
            <label class="col-md-4"></label>
        <a class="btn btn-primary" href="#" role="button" v-b-modal.modal-supplier-d>Edit</a>
        </div>
    </div>

    <!-- /.content-header -->
    <div class="card p-3">
        <div class="btn-group btn-group-toggle" data-toggle="buttons" width="200">
            <label class="btn btn-secondary active" >
                <input type="radio" name="options" id="option1" autocomplete="off" checked v-model="seen" value="one"> Product List
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off"  v-model="seen" value="two"> Invoice List
            </label>
        </div>
        
        <div  v-show="seen === 'one'">
            <h4>Product List</h4>
            <vue-bootstrap-table
                :columns="columns"
                :values="values"
                :show-filter="true"
                :show-column-picker="false"
                :sortable="true"
                :paginated="true"
                :multi-column-sortable="true"
                :default-order-direction="false"
                :row-click-handler="handleRowFunction"
            >
            </vue-bootstrap-table>
        </div>
        <div  v-show="seen === 'two'">
            <div class="d-flex justify-content-between mt-2">
                <h4>Invoice List</h4>
                <a class="btn btn-primary" href="#" role="button" v-b-modal.modal-add-sup-invoice>Add Invoice</a>
            </div>
            <vue-bootstrap-table
                :columns="invoiceColumns"
                :values="invoiceValues"
                :show-filter="true"
                :show-column-picker="false"
                :sortable="true"
                :paginated="true"
                :multi-column-sortable="true"
                :default-order-direction="false"
                :row-click-handler="handleRowFunction"
            >
            </vue-bootstrap-table>
        </div>
    </div>
    <SupplierEdit @getSupplier="getSupplierdet" />
    <LotInfo :lotData="lotData" :productName="productName" :id="tid" :code="code" @setLotInfo="setLotInfo"/>
    <AddSupplierInvoice @getProductSupply="getProductSupply"  @getSupplyInvoice="getSupplyInvoice"/>
    </section>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";
import SupplierEdit from './modals/Supplier-Edit.vue';
import LotInfo from './modals/LotInfo.vue';
import AddSupplierInvoice from './modals/Add-Supplier-Invoice.vue';
export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
        SupplierEdit,
        LotInfo,
        AddSupplierInvoice
    },
    data() {
        return {
            columns: [
                {
                    title: "id",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Code",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Product Name",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Category",
                    visible: true,
                    editable: false,
                },
            ],
            values: [],
            invoiceColumns: [
                {
                    title: "id",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Invoice No",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Note",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Total",
                    visible: true,
                    editable: false,
                },
                {
                    title: "is_paid",
                    visible: true,
                    editable: false,
                },
                {
                    title: "issue_at",
                    visible: true,
                    editable: false,
                },
            ],
            invoiceValues:[],
            sDetails:[],
            lotData:[],
            id:0,
            tid:0,
            code:"0",
            productName:"0",
            seen: "one"
        };
    },
    methods:{
        getProductSupply() {
            axios
                .get("/api/productsupply/" +this.$route.params.id)
                .then((response) => {
                    response.data.forEach((idata) => {
                        this.values.push({
                            id: idata.id,
                            Code: idata.code,
                            "Product Name": idata.name,
                            Category: idata.category['name']+ "/"+idata.sub_category['name'],
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getSupplyInvoice() {
            axios
                .get("/api/supplyinvoice/" +this.$route.params.id)
                .then((response) => {
                    response.data.forEach((idata) => {
                        this.invoiceValues.push({
                            id: idata.id,
                            "Invoice No": idata.s_invoice_no,
                            "Note": idata.note,
                            "Total": idata.total,
                            "is_paid": idata.is_paid,
                            "issue_at": idata.issue_at,
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        handleRowFunction(event, entry) {
            this.tid =entry["id"];
            this.code =entry["Code"];
            this.productName =entry["Product Name"];
            this.setLotInfo()
            this.$bvModal.show('modal-lotInfo');
            
           
        },
        setLotInfo(){
             axios
                .get("/api/product-info/" + this.tid)
                .then((response) => {
                    this.lotData = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
         getSupplierdet() {
            axios
                .get("/api/supplier/"+this.$route.params.id)
                .then((response) => {
                    this.sDetails = response.data;
                })

                .catch((error) => {
                    console.log(error);
                });
        },
       
    },
    mounted: function () {
        this.getProductSupply();
        this.getSupplierdet();
        this.getSupplyInvoice();
    },
}
</script>