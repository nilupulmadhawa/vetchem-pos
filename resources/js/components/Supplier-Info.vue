<template>
    <!-- Main content -->
    <section class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Supplier Info</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/supplier"
                                    >Supplier List</router-link
                                >
                            </li>
                            <li class="breadcrumb-item active">
                                Supplier Info
                            </li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- /.content-header -->
        <div class="card p-3">
            <div class="form-group d-flex">
                <label for="name" class="col-md-4">Product Name</label>
                <input
                    type="text"
                    class="form-control col-md-8"
                    id="name"
                    placeholder="Enter Name"
                    v-model="sDetails.name"
                    readonly
                />
            </div>
            <div class="form-group d-flex">
                <label for="company" class="col-md-4">Company</label>
                <input
                    type="text"
                    class="form-control col-md-8"
                    id="company"
                    placeholder="company"
                    v-model="sDetails.company"
                    readonly
                />
            </div>
            <div class="form-group d-flex">
                <label for="phone_number" class="col-md-4">Phone Number</label>
                <input
                    type="text"
                    class="form-control col-md-8"
                    id="phone_number"
                    placeholder="phone_number"
                    v-model="sDetails.phone_number"
                    readonly
                />
            </div>
            <div class="form-group d-flex">
                <label class="col-md-4"></label>
                <a
                    class="btn btn-primary"
                    href="#"
                    role="button"
                    v-b-modal.modal-supplier-d
                    >Edit</a
                >
            </div>
        </div>

        <!-- /.content-header -->
        <div class="card p-3">
            <div
                class="btn-group btn-group-toggle"
                data-toggle="buttons"
                width="200"
            >
                <label class="btn btn-secondary active">
                    <input
                        type="radio"
                        name="options"
                        id="option3"
                        autocomplete="off"
                        v-model="seen"
                        value="inlist"
                        checked
                    />
                    Goods Received Note
                </label>
                <label class="btn btn-secondary">
                    <input
                        type="radio"
                        name="options"
                        id="option1"
                        autocomplete="off"
                        v-model="seen"
                        value="lqty"
                    />
                    Low Quantity
                </label>
                <label class="btn btn-secondary">
                    <input
                        type="radio"
                        name="options"
                        id="option2"
                        autocomplete="off"
                        v-model="seen"
                        value="plist"
                    />
                    Product List
                </label>
            </div>

            <div v-show="seen === 'plist'">
                <h4 class="mt-2">Product List</h4>
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
            <div v-show="seen === 'inlist'">
                <div class="d-flex justify-content-between mt-2">
                    <h4>Goods Received Note</h4>
                    <a
                        class="btn btn-primary"
                        href="#"
                        role="button"
                        v-b-modal.modal-add-sup-invoice
                        >Add GRN</a
                    >
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
                    :row-click-handler="handleRowFunction2"
                >
                </vue-bootstrap-table>
            </div>
            <div v-show="seen === 'lqty'">
                <h4 class="mt-2">Low Quantity</h4>
                <vue-bootstrap-table
                    :columns="lowcolumns"
                    :values="lowqtyvalues"
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
        <b-modal
            id="modal-supplier-in"
            ref="modal"
            size="lg"
            title="Supplier Invoice"
        >
            <div>
                <div class="d-flex flex-column">
                    <p class="mb-1">
                        Invoice ID : {{ this.invoiceDetails["s_invoice_no"] }}
                    </p>
                    <p class="mb-1">Note : {{ this.invoiceDetails["note"] }}</p>
                    <p class="mb-1">
                        Issued at: {{ this.invoiceDetails["issue_at"] }}
                    </p>
                    <p class="mb-1">
                        Status:
                        <span
                            v-if="this.invoiceDetails['is_paid']"
                            class="badge bg-success badge-pill px-25"
                            >Paid</span
                        >
                        <span v-else class="badge bg-warning badge-pill px-25"
                            >Unpaid</span
                        >
                    </p>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Product Name</th>
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
                                <td>{{ item.product.code }}</td>
                                <td>{{ item.product.name }}</td>
                                <td>{{ item.initial_qty }}</td>
                                <td>{{ item.mfd }}</td>
                                <td>{{ item.exp }}</td>
                                <td>{{ item.cost }}</td>
                                <td>{{ item.r_price }}</td>
                                <td>{{ item.ws_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <p class="mb-1 text-end mr-5">
                        Total :
                        <strong>{{ this.invoiceDetails["total"] }}</strong>
                    </p>
                    <button
                        v-if="!this.invoiceDetails['is_paid']"
                        class="btn btn-primary"
                        style="width: 100px"
                        @click="setPayment"
                    >
                        Pay
                    </button>
                </div>
            </div>
        </b-modal>
        <SupplierEdit @getSupplier="getSupplier" />
        <LotInfo
            :lotData="lotData"
            :productName="productName"
            :id="tid"
            :code="code"
            @setLotInfo="setLotInfo"
        />
        <AddSupplierInvoice
            @getProductSupply="getProductSupply"
            @getSupplyInvoice="getSupplyInvoice"
        />
    </section>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";
import SupplierEdit from "./modals/Supplier-Edit.vue";
import LotInfo from "./modals/LotInfo.vue";
import AddSupplierInvoice from "./modals/Add-Supplier-Invoice.vue";
export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
        SupplierEdit,
        LotInfo,
        AddSupplierInvoice,
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
            lowcolumns: [
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
                    title: "Quantity",
                    visible: true,
                    editable: false,
                },
            ],
            invoiceColumns: [
                {
                    title: "GRN No",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Supplier Invoice No",
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
            lowqtyvalues: [],
            values: [],
            invoiceValues: [],
            sDetails: [],
            lotData: [],
            lotData: [],
            id: 0,
            tid: 0,
            code: "0",
            productName: "0",
            seen: "inlist",
            invoiceDetails: [],
            invoicepro: [],
        };
    },
    methods: {
        getlowProductSupply() {
            this.values = [];
            axios
                .get("/api/lowproduct/" + this.$route.params.id)
                .then((response) => {
                    response.data.forEach((idata) => {
                        let tqty = 0.0;
                        idata.lot_infos.forEach((lotdata) => {
                            tqty = tqty + parseFloat(lotdata.qty);
                        });
                        if (tqty <= idata.re_order_level) {
                            this.lowqtyvalues.push({
                                id: idata.id,
                                Code: idata.code,
                                "Product Name": idata.name,
                                Quantity: tqty.toFixed(3),
                            });
                        }
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getProductSupply() {
            this.values = [];
            axios
                .get("/api/productsupply/" + this.$route.params.id)
                .then((response) => {
                    response.data.forEach((idata) => {
                        this.values.push({
                            id: idata.id,
                            Code: idata.code,
                            "Product Name": idata.name,
                            Category:
                                idata.category["name"] +
                                "/" +
                                idata.sub_category["name"],
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getSupplyInvoice() {
            this.invoiceValues = [];
            axios
                .get("/api/supplyinvoice/" + this.$route.params.id)
                .then((response) => {
                    response.data.forEach((idata) => {
                        let paid = "Unpaid";
                        if (idata.is_paid) {
                            paid = "Paid";
                        }
                        this.invoiceValues.push({
                            "GRN No": idata.id,
                            "Supplier Invoice No": idata.s_invoice_no,
                            Note: idata.note,
                            Total: idata.total,
                            is_paid: paid,
                            issue_at: idata.issue_at,
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        handleRowFunction(event, entry) {
            this.tid = entry["id"];
            this.code = entry["Code"];
            this.productName = entry["Product Name"];
            this.setLotInfo();
            this.$bvModal.show("modal-lotInfo");
        },
        handleRowFunction2(event, entry) {
            axios
                .get("/api/supplier-invoice/" + entry["GRN No"])
                .then((response) => {
                    this.invoiceDetails = response.data;
                    axios
                        .get("/api/supplylot/" + response.data.id)
                        .then((response) => {
                            this.invoicepro = response.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                })
                .catch((error) => {
                    console.log(error);
                });

            this.$bvModal.show("modal-supplier-in");
        },
        setPayment() {
            axios
                .get("/api/invoice-payment/" + this.invoiceDetails["id"])
                .then((response) => {
                    if (response.data) {
                        alert("Paid Successful");
                        this.getSupplyInvoice();
                        this.$nextTick(() => {
                            this.$bvModal.hide("modal-supplier-in");
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setLotInfo() {
            axios
                .get("/api/product-info/" + this.tid)
                .then((response) => {
                    this.lotData = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getSupplier() {
            axios
                .get("/api/supplier/" + this.$route.params.id)
                .then((response) => {
                    this.sDetails.name = response.data[0].name;
                    this.sDetails.company = response.data[0].company;
                    this.sDetails.phone_number = response.data[0].phone_number;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted: function () {
        this.getProductSupply();
        this.getSupplier();
        this.getSupplyInvoice();
        this.getlowProductSupply();
    },
};
</script>
