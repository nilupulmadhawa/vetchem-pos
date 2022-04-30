<template>
    <!-- Main content -->
    <section class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cash In/Out</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/dashboard"
                                    >Dashboard</router-link
                                >
                            </li>
                            <li class="breadcrumb-item active">Cash In/Out</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <form @submit.stop.prevent="submitForm">
                                <div class="row mb-3">
                                    <div class="d-flex justify-content-center">
                                        <input
                                            type="radio"
                                            class="btn-check"
                                            name="type"
                                            id="cashin"
                                            value="cashin"
                                            v-model="type"
                                            autocomplete="off"
                                            checked
                                        />
                                        <label
                                            class="btn btn-secondary m-2"
                                            for="cashin"
                                        >
                                            Add Cash +</label
                                        >

                                        <input
                                            type="radio"
                                            class="btn-check"
                                            name="type"
                                            id="cashout"
                                            value="cashout"
                                            v-model="type"
                                            autocomplete="off"
                                        />
                                        <label
                                            class="btn btn-secondary m-2"
                                            for="cashout"
                                        >
                                            Remove Cash -</label
                                        >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label
                                        for="amount"
                                        class="col-md-4 col-form-label text-md-end"
                                        >Amount</label
                                    >

                                    <div class="col-md-6">
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="amount"
                                            id="amount"
                                            v-model="amount"
                                            required
                                            autofocus
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label
                                        for="description"
                                        class="col-md-4 col-form-label text-md-end"
                                        >Description</label
                                    >

                                    <div class="col-md-6">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="description"
                                            v-model="description"
                                            id="description"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->
                <div class="card p-3">
                    <download-excel
                        :data="values"
                        :name="'CIO' + currentDateTime()"
                        class="btn btn-primary m-2 col-md-2"
                        type="button"
                    >
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Get Report
                    </download-excel>
                    <vue-bootstrap-table
                        :columns="columns"
                        :values="values"
                        :show-filter="true"
                        :show-column-picker="true"
                        :sortable="true"
                        :paginated="true"
                        :multi-column-sortable="true"
                        :default-order-direction="true"
                    >
                    </vue-bootstrap-table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";
import JsonExcel from "vue-json-excel";
export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
        downloadExcel: JsonExcel,
    },
    data() {
        return {
            type: "cashin",
            amount: "",
            description: "",
            columns: [
                {
                    title: "id",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Type",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Amount",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Description",
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
        };
    },
    methods: {
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
        getCashinout() {
            this.values = [];
            axios
                .get("/api/cashinout")
                .then((response) => {
                    response.data.forEach((idata) => {
                        let cash = "Cash Out";
                        if (idata.type == "cashin") {
                            cash = "Cash In";
                        }
                        this.values.push({
                            id: idata.id,
                            Type: cash,
                            Amount: idata.amount,
                            Description: idata.description,
                            Date: this.dataFormat(idata.created_at),
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        submitForm(e) {
            // console.log(e);
            axios
                .post("/api/cashinout", {
                    type: this.type,
                    amount: this.amount,
                    description: this.description,
                })
                .then((response) => {
                    // console.log(response.data);
                    if (response.data.isAdded) {
                        alert("Success.");
                        this.amount = "";
                        this.description = [];
                        this.getCashinout();
                    } else {
                        alert("Failed");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted: function () {
        this.getCashinout();
    },
};
</script>

<style>
.btn-check:checked + .btn-secondary,
.btn-check:active + .btn-secondary,
.btn-secondary:active,
.btn-secondary.active,
.show > .btn-secondary.dropdown-toggle {
    color: #fff;
    background-color: #0e0e0e;
    border-color: #0e0e0e;
}
</style>
