<?php $this->load->view('Templates/header'); ?>
<?php $this->load->view('Templates/navbar'); ?>
<?php $this->load->view('Templates/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                <?= $this->uri->segment(1); ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= $title; ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <section class="content">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->
                            <div class="row">

                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3><?= count_shipping_waiting(); ?></h3>

                                            <p>Waiting Prosess</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-refresh"></i>
                                        </div>
                                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('Utilities/WaitingPODO'); ?>'" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3><?= count_shipping(); ?></h3>

                                            <p>Shipping Prosess</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-plane"></i>
                                        </div>
                                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('Utilities/Shipping'); ?>'" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3><?= count_delivery(); ?></h3>

                                            <p>Delivery Process</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('Utilities/Delivery'); ?>'" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->

                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3><?= count_productlow(); ?> <sup style="font-size: 20px">Product</sup></h3>

                                            <p>low stock</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                            <!-- Main row -->
                            <div class="row">
                                <!-- Left col -->
                                <section class="col-lg-6 connectedSortable ui-sortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <!-- BAR CHART -->
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Bar Chart</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart">
                                                <canvas id="barchart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->





                                </section>
                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-6 connectedSortable ui-sortable">


                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Pie Chart</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="piechart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>




                                    <!-- /.card -->
                                </section>
                                <!-- right col -->
                            </div>
                            <!-- /.row (main row) -->
                        </div><!-- /.container-fluid -->
                    </section>










                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>