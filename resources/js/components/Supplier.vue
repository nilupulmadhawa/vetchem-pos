<template>
        <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product list</a></li>
                        <li class="breadcrumb-item active">Supplier List</li>
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
                    title: "Name",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Phone Number",
                    visible: true,
                    editable: false,
                },
                {
                    title: "Company",
                    visible: true,
                    editable: false,
                },
            ],
            values: [],
        };
    },
}
</script>