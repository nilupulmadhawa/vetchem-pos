<template>
        <!-- Main content -->
    <section class="content">
         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/dashboard" >Dashboard</router-link></li>
                        <li class="breadcrumb-item active">Customer List</li>
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
            :default-order-direction="false"
            :row-click-handler="handleRowFunction"
        >
        </vue-bootstrap-table>
    </div>
    </section>
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
                    title: "Description",
                    visible: true,
                    editable: false,
                },
            ],
            values: [],
            sDetails:[],
            id:0
        };
    },
    methods:{
        getCustomers() {
            this.values=[];
            axios
                .get("/api/customer")
                .then((response) => {
                    response.data.forEach((idata) => {
                        this.values.push({
                            id: idata.id,
                            Name: idata.name,
                            "Phone Number": idata.phone_number,
                            Description: idata.description,
                        });
                    });
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        handleRowFunction(event, entry) {
            this.$router.push('customer/'+entry["id"]) 
            
        },
       
    },
    mounted: function () {
        this.getCustomers();
    },
}
</script>