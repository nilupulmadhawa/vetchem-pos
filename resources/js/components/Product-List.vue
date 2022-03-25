<template>
    <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
            :default-order-column="columnToSortBy"
            :default-order-direction="false"
            :row-click-handler="handleRowFunction"
        >
        </vue-bootstrap-table>
    </div>
    <LotInfo :lotData="lotData" :productName="productName" :id="id" :code="code" @setLotInfo="setLotInfo"/>
    </section>
</template>

<script>
import VueBootstrapTable from "vue2-bootstrap-table2";
import LotInfo from './modals/LotInfo.vue';
export default {
    components: {
        VueBootstrapTable: VueBootstrapTable,
        LotInfo
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
            lotData: [],
            id:0,
            code:"0",
            productName:"0",
            columnToSortBy: "Id",
            handleRowFunction: this.handleRow,
        };
    },
    methods: {
        handleRow(event, entry) {
            this.id =entry["id"];
            this.code =entry["Code"];
            this.productName =entry["Product Name"];
            this.$bvModal.show('modal-lotInfo');
            
           this.setLotInfo()
        },
        setLotInfo(){
             axios
                .get("/api/product-info/" + this.id)
                .then((response) => {
                    this.lotData = response.data;
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
                .get("/api/product")
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
    },
    mounted: function () {
        this.getInvoice();
    },
};
</script>
