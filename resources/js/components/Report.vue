<template>
    <!-- Main content -->
    <section class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Report</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Report</li>
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
            <h4>Product</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex">
                    <span class="m-2 col-md-2">All Product</span>
                    <download-excel
                        :data="allqty"
                        :name="'ALLP' + currentDateTime()"
                    >
                        <button class="btn btn-primary m-2" type="button">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Get Report
                        </button>
                    </download-excel>
                </li>
                <li class="list-group-item d-flex">
                    <span class="m-2 col-md-2">Available Product</span>
                    <download-excel
                        :data="avqty"
                        :name="'AVP' + currentDateTime()"
                    >
                        <button class="btn btn-primary m-2" type="button">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Get Report
                        </button>
                    </download-excel>
                </li>
                <li class="list-group-item d-flex">
                    <span class="m-2 col-md-2">Low Quantity</span>
                    <download-excel
                        :data="lowqty"
                        :name="'LQ' + currentDateTime()"
                    >
                        <button class="btn btn-primary m-2" type="button">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Get Report
                        </button>
                    </download-excel>
                </li>
            </ul>
        </div>
        <div class="card p-3">
            <h4>Sales</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex aline-center">
                    <span class="m-2 d-flex">Sales report</span>

                    <input
                        type="datetime-local"
                        class="form-control m-2"
                        style="width: 200px"
                        v-model="ssdate"
                    />
                    <span class="m-2 d-flex">-</span>
                    <input
                        type="datetime-local"
                        class="form-control m-2"
                        style="width: 200px"
                        v-model="sedate"
                    />
                    <download-excel
                        :fetch="getSalesReport"
                        :name="'SP' + currentDateTime()"
                        class="btn btn-primary m-2"
                        type="button"
                    >
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Get Report
                    </download-excel>
                </li>
            </ul>
        </div>
        <div class="card p-3">
            <h4>GRN</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex aline-center">
                    <span class="m-2 d-flex">GRN Report</span>

                    <input
                        type="datetime-local"
                        class="form-control m-2"
                        style="width: 200px"
                        v-model="grnsdate"
                    />
                    <span class="m-2 d-flex">-</span>
                    <input
                        type="datetime-local"
                        class="form-control m-2"
                        style="width: 200px"
                        v-model="grnedate"
                    />
                    <download-excel
                        :fetch="getGrnReport"
                        :name="'GRN' + currentDateTime()"
                        class="btn btn-primary m-2"
                        type="button"
                    >
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Get Report
                    </download-excel>
                </li>
            </ul>
        </div>

        <div class="card p-3">
            <h4>Cash In/Out</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex aline-center">
                    <span class="m-2 d-flex">Cash In/Out Report</span>

                    <input
                        type="datetime-local"
                        class="form-control m-2"
                        style="width: 200px"
                        v-model="csdate"
                    />
                    <span class="m-2 d-flex">-</span>
                    <input
                        type="datetime-local"
                        class="form-control m-2"
                        style="width: 200px"
                        v-model="cedate"
                    />
                    <download-excel
                        :fetch="getCIOReport"
                        :name="'CIO' + currentDateTime()"
                        class="btn btn-primary m-2"
                        type="button"
                    >
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Get Report
                    </download-excel>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";
import LotInfo from "./modals/LotInfo.vue";
import Vue from "vue";
import JsonExcel from "vue-json-excel";
export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
        downloadExcel: JsonExcel,
        LotInfo,
    },
    data() {
        return {
            lowqty: [],
            avqty: [],
            allqty: [],
            ssdate: [],
            sedate: [],
            grnsdate: [],
            grnedate: [],
            csdate: [],
            cedate: [],
        };
    },
    methods: {
        async getCIOReport() {
            if (this.csdate == "" && this.cedate == "") {
                alert("please fill all required fields");
            } else {
                let report = [];
                const response = await axios.post("/api/cioreport", {
                    csdate: this.csdate,
                    cedate: this.cedate,
                });

                // console.log(response);
                response.data.forEach((idata) => {
                    let cash = "Cash Out";
                    if (idata.type == "cashin") {
                        cash = "Cash In";
                    }
                    report.push({
                        id: idata.id,
                        Type: cash,
                        Amount: idata.amount,
                        Description: idata.description,
                        Date: this.dataFormat(idata.created_at),
                    });
                });
                return report;
            }
            // return grnReport;
        },
        async getSalesReport() {
            if (this.ssdate == "" && this.sedate == "") {
                alert("please fill all required fields");
            } else {
                let report = [];
                const response = await axios.post("/api/salesReport", {
                    ssdate: this.ssdate,
                    sedate: this.sedate,
                });

                // console.log(response);
                response.data.forEach((idata) => {
                    let paid = "Unpaid";
                    if (idata.is_paid) {
                        paid = "Paid";
                    }
                    report.push({
                        "Invoice No": idata.id,
                        "Customer Name": idata.customer["name"],
                        Total: idata.total,
                        is_paid: paid,
                        "Create Date": this.dataFormat(idata.created_at),
                        "Update Date": this.dataFormat(idata.updated_at),
                    });
                });
                return report;
            }
            // return grnReport;
        },
        async getGrnReport() {
            if (this.grnsdate == "" && this.grnedate == "") {
                alert("please fill all required fields");
            } else {
                let grnReport = [];
                const response = await axios.post("/api/grnReport", {
                    grnsdate: this.grnsdate,
                    grnedate: this.grnedate,
                });

                // console.log(response);
                response.data.forEach((idata) => {
                    let paid = "Unpaid";
                    if (idata.is_paid) {
                        paid = "Paid";
                    }
                    grnReport.push({
                        "GRN No": idata.id,
                        "Supplier Invoice No": idata.s_invoice_no,
                        "Company Name": idata.supplier["company"],
                        Note: idata.note,
                        Total: idata.total,
                        is_paid: paid,
                        issue_at: idata.issue_at,
                        "Create Date": this.dataFormat(idata.created_at),
                        "Update Date": this.dataFormat(idata.updated_at),
                    });
                });
                return grnReport;
            }
            // return grnReport;
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
        currentDateTime() {
            const current = new Date();
            const date =
                current.getFullYear() +
                "-" +
                (current.getMonth() + 1) +
                "-" +
                current.getDate();
            const time =
                current.getHours() +
                ":" +
                current.getMinutes() +
                ":" +
                current.getSeconds();
            const dateTime = date + " " + time;

            return dateTime;
        },
        getlowProduct() {
            this.lowqty = [];
            axios
                .get("/api/lowproduct")
                .then((response) => {
                    response.data.forEach((idata) => {
                        let tqty = 0.0;
                        idata.lot_infos.forEach((lotdata) => {
                            tqty = tqty + parseFloat(lotdata.qty);
                        });
                        if (tqty <= idata.re_order_level) {
                            this.lowqty.push({
                                Code: idata.code,
                                "Product Name": idata.name,
                                Quantity: tqty.toFixed(3),
                                Company: idata.supplier["company"],
                                Category: idata.category["name"],
                                "Sub Category": idata.sub_category["name"],
                            });
                        }
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getAvProduct() {
            this.avqty = [];
            axios
                .get("/api/lowproduct")
                .then((response) => {
                    response.data.forEach((idata) => {
                        let tqty = 0.0;
                        idata.lot_infos.forEach((lotdata) => {
                            tqty = tqty + parseFloat(lotdata.qty);
                        });
                        if (tqty > 0) {
                            this.avqty.push({
                                Code: idata.code,
                                "Product Name": idata.name,
                                Quantity: tqty.toFixed(3),
                                Company: idata.supplier["company"],
                                Category: idata.category["name"],
                                "Sub Category": idata.sub_category["name"],
                            });
                        }
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getAllProduct() {
            this.avqty = [];
            axios
                .get("/api/lowproduct")
                .then((response) => {
                    response.data.forEach((idata) => {
                        let tqty = 0.0;
                        idata.lot_infos.forEach((lotdata) => {
                            tqty = tqty + parseFloat(lotdata.qty);
                        });
                        this.allqty.push({
                            Code: idata.code,
                            "Product Name": idata.name,
                            Quantity: tqty.toFixed(3),
                            Company: idata.supplier["company"],
                            Category: idata.category["name"],
                            "Sub Category": idata.sub_category["name"],
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted: function () {
        this.getlowProduct();
        this.getAvProduct();
        this.getAllProduct();
    },
};
</script>
