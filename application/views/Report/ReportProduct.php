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

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-file-alt mr-1"></i>

                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">

                                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('Report/GenerateReportProduct'); ?>'" class="btn btn-sm btn-primary">
                                            <i class="far fa-file-excel"></i>
                                            Generate Data </a>


                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body table-responsive pad">

                            <table id="tbrptproduct" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kode Product</th>
                                        <th>Nama Product</th>
                                        <th>Kategori Product</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>

                                        <th>Jumalh Stok</th>
                                        <!-- <th>user_create</th>
                                        <th>date_create</th>
                                        <th>user_update</th>
                                        <th>date_update</th> -->

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($product as $p) : ?>
                                        <tr>

                                            <td class="text-left" style="vertical-align:middle"><?= $p['kode_product']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['nama_product']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['category_name']; ?></td>
                                            <td class="text-left" style="vertical-align:middle">Rp. <?= number_format($p['harga_beli'], 0, ',', '.'); ?></td>
                                            <td class="text-left" style="vertical-align:middle">Rp. <?= number_format((($p['harga_beli'] * $spread['value']) / 100) + $p['harga_beli'], 0, ',', '.'); ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['jumlah_stok']; ?></td>
                                            <!-- <td class="text-left" style="vertical-align:middle"><?= $p['user_create']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['date_create']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['user_update']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['date_update']; ?></td> -->



                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>




                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>