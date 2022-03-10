<template>
    <div class="card p-3">
        <vue-bootstrap-table
            :columns="columns"
            :values="values"
            :show-filter="true"
            :show-column-picker="false"
            :sortable="true"
            :paginated="true"
            :multi-column-sortable="true"
            :default-order-column="columnToSortBy"
            :default-order-direction="false"
            :row-click-handler="handleRowFunction"
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
            <a
                :href="`/invoice/print/` + itemData.id"
                rel="noopener"
                target="_blank"
                class="btn btn-secondary"
                ><i class="fas fa-print text-white"></i> Print</a
            >
        </b-modal>
    </div>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";

export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
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
            ],
            values: [],
            itemData: [],
            columnToSortBy: "Id",
            handleRowFunction: this.handleRow,
        };
    },
    methods: {
        handleRow(event, entry) {
            this.$refs["invoice_pre"].show();
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
            axios
                .get("/api/invoice")
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
                        this.values.push({
                            Id: idata.id,
                            "Sub total": idata.sub_total,
                            Discount: idata.discount,
                            Total: idata.total,
                            Date: dateStr,
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted: function () {
        this.getInvoice();
    },
};
</script>
