<template>
        <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/customer" >Customer List</router-link></li>
                        <li class="breadcrumb-item active">Customer Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <div class="card p-3">
         <div class="form-group d-flex">
            <label for="name" class="col-md-4">Customer  Name</label>
            <input type="text" class="form-control col-md-8" id="name"  placeholder="Enter Name" v-model="cname"  readonly>
        </div>
        <div class="form-group d-flex">
            <label for="pnumber" class="col-md-4">Phone Number</label>
            <input type="text" class="form-control col-md-8" id="pnumber" placeholder="Phone Number" v-model="pnumber"  readonly>
        </div>
        <div class="form-group d-flex">
            <label for="des" class="col-md-4">Description</label>
            <input type="text" class="form-control col-md-8" id="des" placeholder="Description" v-model="des"  readonly>
        </div>
        <div class="form-group d-flex">
            <label class="col-md-4"></label>
        <a class="btn btn-primary" href="#" role="button" v-b-modal.modal-customer-edit>Edit</a>
        </div>
    </div>

    <!-- /.content-header -->
     <div class="card p-3">
            <vue-bootstrap-table
                :columns="columns"
                :values="values"
                :show-filter="true"
                :show-column-picker="false"
                :sortable="true"
                :paginated="true"
                :multi-column-sortable="true"
                :default-order-direction="false"
                :row-click-handler="handleRow"
            >
            </vue-bootstrap-table>
            <b-modal ref="invoice_pre" size="lg" ok-only no-stacking>
                <div class="card">
                    <div class="card-header p-4">
                        <div class="float-right">
                            <h3 class="mb-0">Invoice #{{ itemData.id }}</h3>
                            <span>{{ dataFormat(itemData.created_at) }}</span>
                            <br />
                            <span class="text-600 text-90">Status: </span
                            ><span
                                v-if="this.itemData.is_paid"
                                class="badge bg-success badge-pill px-25"
                                >Paid</span
                            ><span v-else class="badge bg-warning badge-pill px-25"
                                >Unpaid</span
                            >
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">Code</th>
                                    <th>Item Name</th>
                                    <th class="right">Price</th>
                                    <th class="center">Qty</th>
                                    <th class="center">Discount</th>
                                    <th class="center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in itemData.invoice_items"
                                    v-bind:key="item.id"
                                >
                                    <td class="center">{{ item.code }}</td>
                                    <td class="left strong">
                                        {{ item.name }}
                                    </td>
                                    <td class="left">{{ item.price }}</td>
                                    <td class="right">{{ item.qty }}</td>
                                    <td class="center">{{ item.discount }}</td>
                                    <td class="right">{{ item.sale_price }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-lg-4 col-sm-5"></div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark"
                                                    >Subtotal</strong
                                                >
                                            </td>
                                            <td class="right">
                                                {{ itemData.sub_total }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark"
                                                    >Discount</strong
                                                >
                                            </td>
                                            <td class="right">
                                                {{ itemData.discount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark"
                                                    >Total</strong
                                                >
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">{{
                                                    itemData.total
                                                }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark"
                                                    >Pay Amount</strong
                                                >
                                            </td>
                                            <td class="right">
                                                {{ itemData.pay_amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark"
                                                    >Balance</strong
                                                >
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">{{
                                                    itemData.balance
                                                }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a
                        :href="`/invoice/print/` + itemData.id"
                        rel="noopener"
                        target="_blank"
                        class="btn btn-secondary"
                        ><i class="fas fa-print text-white"></i> Print</a
                    >
                    <button v-if="!this.itemData.is_paid" class="btn btn-primary " style="width: 100px;" @click="setPayment">Pay</button>
                </div>
            </b-modal>
        </div>
        <CustomerEdit @getCustomer="getCustomer" @getInvoice="getInvoice"/>
    </section>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";
import CustomerEdit from './modals/Customer-Edit.vue';
export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
        CustomerEdit
    },
    data() {
        return {
            columns: [
                {
                    title: "Id",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Sub total",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Discount",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Total",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Date",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Is Paid",
                    visible: true,
                    editable: false,
                },
            ],
            values: [],            
            itemData: [],
            sDetails:[],
            cname:'',
            pnumber:'',
            des:''
        };
    },
    methods:{
        getCustomer() {
            this.values=[];
            axios
                .get("/api/customer/" +this.$route.params.id)
                .then((response) => {
                    this.cname = response.data[0].name;
                    this.pnumber = response.data[0].phone_number;
                    this.des = response.data[0].description;
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        handleRowFunction(event, entry) {
            this.$router.push('customer/'+entry["id"]) 
            
        },
         handleRow(event, entry) {
            
            axios
                .get("/api/invoiceItem/" + entry["Id"])
                .then((response) => {
                    this.itemData = response.data;
                    console.log(this.itemData);
                    this.$refs["invoice_pre"].show();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataFormat(gdate) {
            var date = new Date(gdate);
            var dateStr =
                date.getFullYear() +
                "/" +
                ("00" + (date.getMonth() + 1)).slice(-2) +
                "/" +
                ("00" + date.getDate()).slice(-2) +
                " " +
                ("00" + date.getHours()).slice(-2) +
                ":" +
                ("00" + date.getMinutes()).slice(-2) +
                ":" +
                ("00" + date.getSeconds()).slice(-2);
            return dateStr;
        },
        getInvoice() {
            this.values=[];
            axios
                .get("/api/cinvoice/"+this.$route.params.id)
                .then((response) => {
                    response.data.forEach((idata) => {
                        var date = new Date(idata.created_at);
                        var dateStr =
                            date.getFullYear() +
                            "/" +
                            ("00" + (date.getMonth() + 1)).slice(-2) +
                            "/" +
                            ("00" + date.getDate()).slice(-2) +
                            " " +
                            ("00" + date.getHours()).slice(-2) +
                            ":" +
                            ("00" + date.getMinutes()).slice(-2) +
                            ":" +
                            ("00" + date.getSeconds()).slice(-2);

                             let paid = "Unpaid";
                            if (idata.is_paid) {
                                paid= "Paid"
                            }
                        this.values.push({
                            Id: idata.id,
                            "Sub total": idata.sub_total,
                            Discount: idata.discount,
                            Total: idata.total,
                            Date: dateStr,
                            "Is Paid": paid,
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        setPayment(){
             axios
                .get("/api/cinvoice-payment/" + this.itemData.id)
                .then((response) => {
                    if(response.data){
                        alert("Paid Successful");
                        this.getInvoice();
                        this.$nextTick(() => {
                            this.$refs["invoice_pre"].hide();
                        })
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
       
    },
    mounted: function () {
        this.getInvoice();
        this.getCustomer();
        
    },
}
</script>