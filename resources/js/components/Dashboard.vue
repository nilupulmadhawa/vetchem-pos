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
                            <li class="breadcrumb-item active">Dashboard</li>
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
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ this.andata.day }}</h3>

                                        <p>Today Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ this.andata.month }}</h3>

                                        <p>Monthly Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ this.andata.year }}</h3>

                                        <p>Yearly Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.content-header -->
        <div class="row justify-content-center" v-if="this.is_admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ this.prdata.day }}</h3>

                                        <p>Today Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ this.prdata.month }}</h3>

                                        <p>Monthly Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ this.prdata.year }}</h3>

                                        <p>Yearly Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <apexchart
                    ref="chart1"
                    width="500"
                    type="bar"
                    :options="chartOptions"
                    :series="series"
                ></apexchart>
            </div>
        </div>
    </section>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        return {
            chartOptions: {
                chart: {
                    id: "chart1",
                },
                xaxis: {
                    categories: [],
                },
            },
            series: [
                {
                    name: "series-1",
                    data: [],
                },
            ],

            prdata: [],
            andata: [],
            chdata: [],
            is_admin: false,
        };
    },
    created: function () {},
    methods: {
        getUser() {
            this.values = [];
            axios
                .get("/api/user")
                .then((response) => {
                    console.log(response);
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getAnalytics() {
            this.values = [];
            axios
                .get("/api/analytics")
                .then((response) => {
                    this.andata = response.data;
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        getProfitanAlytics() {
            this.values = [];
            axios
                .get("/api/profitanalytics")
                .then((response) => {
                    this.prdata = response.data;
                })

                .catch((error) => {
                    console.log(error);
                });
        },
        uChart: function () {
            axios
                .get("/api/monthlyTotal")
                .then((response) => {
                    let data = [];
                    response.data.forEach((idata) => {
                        this.chartOptions.xaxis.categories.push(idata.month);
                        data.push(idata.total);
                    });
                    this.$refs.chart1.updateSeries([
                        {
                            name: "Sales",
                            data: data,
                        },
                    ]);
                    // console.log(this.chartOptions.xaxis.categories);
                })

                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getAnalytics();
        this.getProfitanAlytics();
        this.getUser();
        this.uChart();
    },
};
</script>
