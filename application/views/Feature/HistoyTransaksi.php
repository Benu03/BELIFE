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




                    <?= $this->session->flashdata('message'); ?>

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-file-alt mr-1"></i>
                            List Data History Order
                        </h3>

                    </div>
                    <div class="card-body table-responsive pad">
                        <table id="tbhisorser" class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Order</th>
                                    <th>Status Order</th>
                                    <th>Date Proses</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($Historyorder as $hs) : ?>
                                    <tr>
                                        <td width="30px"><?= $i++; ?></td>
                                        <td><?= $hs['kode_order']; ?></td>
                                        <td width="250px" class="text-center">
                                            <?= $hs['status_order']; ?>
                                        </td>
                                        <td width="250px" class="text-center">
                                            <?= $hs['date_proses']; ?>
                                        </td>

                                        <td width="120px" class="text-center">
                                            <a class="btn btn-sm bg-warning" href="<?= base_url('Feature/DetailHistoryOrder'); ?>/<?= $hs['kode_order']; ?>"><i class="fas fa-inbox"></i> Detail History</a>
                                        </td>
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







</div>
</div>
</div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>