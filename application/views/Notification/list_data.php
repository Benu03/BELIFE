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

                    <div class="card card-success card-outline">

                        <div class="card-body table-responsive pad">


                            <div class="list-group">
                                <?php foreach ($notif as $p) : ?>

                                    <a data-target="#message<?php echo $p['id']; ?>" data-toggle="modal" class="list-group-item list-group-item-action" href="<?= base_url('Notification/isview_notif2'); ?>/<?= $p['id']; ?>"><?= $p['massage']; ?></a>

                                <?php endforeach; ?>
                            </div>




                        </div>

                    </div>






                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php foreach ($notif as $p) : ?>

    <div class="modal fade" id="message<?= $p['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('Notification/isview_notif'); ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-bell mr-2 text-dark"></i> Detail Pemberitahan </h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-group d-flex justify-content-md-center align-items-center">
                            <label for="value" class="col-sm-3 col-form-label">Tanggal</label>
                            <label for="value" class="col-sm-8 col-form-label"><?= $p['date_notif']; ?></label>
                        </div>
                        <div class="form-group d-flex justify-content-md-center align-items-center">
                            <label for="value" class="col-sm-3 col-form-label">Pesan</label>
                            <label for="value" class="col-sm-8 col-form-label"><?= $p['massage']; ?></label>
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $p['id']; ?>">
                    </div>
                    <div class="modal-footer ">

                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


<?php endforeach;  ?>


<?php $this->load->view('Templates/footer'); ?>