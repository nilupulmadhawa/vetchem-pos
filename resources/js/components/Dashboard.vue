<template>
    <!-- Main content -->
    <section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                                <h3>{{this.andata.day}}</h3>

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
                                <h3>{{this.andata.month}}</sup></h3>

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
                                <h3>{{this.andata.yearb}}</h3>

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

    </section>
</template>

<script>
    export default {
        data() {
            return {
                andata:[]
            }
        },
        methods:{
            getAnalytics() {
                this.values=[];
                axios
                    .get("/api/analytics")
                    .then((response) => {
                        this.andata = response.data
                    })

                    .catch((error) => {
                        console.log(error);
                    });
            },
        },
    mounted() {
            this.getAnalytics()
        },
    }
</script>
