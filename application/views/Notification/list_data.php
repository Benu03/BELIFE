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
                        <div class="card-header">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item mr-2" role="presentation">
                                <button class="nav-link active" id="pills-pemberitahuan-tab" data-toggle="pill" data-target="#pills-pemberitahuan" type="button" role="tab" aria-controls="pills-pemberitahuan" aria-selected="true"><i class="fas fa-bell"></i> Pemberitahuan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-pesanan-tab" data-toggle="pill" data-target="#pills-pesanan" type="button" role="tab" aria-controls="pills-pesanan" aria-selected="false"><i class="fas fa-dolly-flatbed"></i> Status Pesanan</button>
                            </li>
                        
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                            <!-- begin pemberitahuan -->
                        <div class="tab-pane fade show active" id="pills-pemberitahuan" role="tabpanel" aria-labelledby="pills-pemberitahuan-tab">


                            <!-- <div class="list-group"> -->
                            <ul class="list-group list-group-unbordered mb-3">
                            
                            <?php foreach ($notif as $p) : ?>

                                <li class="list-group-item col-sm-6">
                                <a data-target="#message<?php echo $p['id']; ?>" data-toggle="modal" 
                                class="<?php if (($p['is_view'] == 0)){   echo "list-group-item list-group-item-action text-dark bg-info";
                                    } else { echo "list-group-item list-group-item-action text-dark bg-light"; }?>"
                                href="<?= base_url('Notification/isview_notif2'); ?>/<?= $p['id']; ?>"> 
                                <?php if (($p['is_view'] == 0)){   echo '<i class="fas fa-envelope mr-2"></i>';
                                    } else { echo '<i class="fas fa-envelope-open-text mr-2"></i>'; }?>                                
                                <?= $p['tag_notification']; ?>
                                <b class="float-right"><?= $p['date_notif']; ?></b> </a> 
                                </li>




                                <?php endforeach; ?>
                            <!-- </div> -->
                            </ul>


                        </div>
                        <!-- end pemberithauan -->
                        <!-- begin status pesanan -->
                        <div class="tab-pane fade" id="pills-pesanan" role="tabpanel" aria-labelledby="pills-pesanan-tab">



                            <!-- <div class="list-group"> -->
                            <ul class="list-group list-group-unbordered mb-3">
                            
                            <?php foreach ($notifpesanan as $np) : ?>

                                <li class="list-group-item col-sm-6">
                                <a data-target="#messagepesanan<?php echo $np['id']; ?>" data-toggle="modal" 
                                class="<?php if (($np['is_view'] == 0)){   echo "list-group-item list-group-item-action text-dark bg-info";
                                    } else { echo "list-group-item list-group-item-action text-dark bg-light"; }?>"
                                href="<?= base_url('Notification/isview_notif2'); ?>/<?= $np['id']; ?>"> 
                                <?php if (($np['is_view'] == 0)){   echo '<i class="fas fa-envelope mr-2"></i>';
                                    } else { echo '<i class="fas fa-envelope-open-text mr-2"></i>'; }?>                                
                                <?= $np['tag_notification']; ?>
                                <b class="float-right"><?= $np['date_notif']; ?></b> </a> 
                                </li>

                                <?php endforeach; ?>
                            <!-- </div> -->
                            </ul>

                        </div>
                        
                        </div>
                          <!-- end status pesanan -->







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


<?php foreach ($notifpesanan as $np) : ?>

<div class="modal fade" id="messagepesanan<?= $np['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Notification/isview_notif'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-bell mr-2 text-dark"></i> Detail Pemberitahan </h5>

                </div>
                <div class="modal-body">
                    <div class="form-group d-flex justify-content-md-center align-items-center">
                        <label for="value" class="col-sm-3 col-form-label">Tanggal</label>
                        <label for="value" class="col-sm-8 col-form-label"><?= $np['date_notif']; ?></label>
                    </div>
                    <div class="form-group d-flex justify-content-md-center align-items-center">
                        <label for="value" class="col-sm-3 col-form-label">Pesan</label>
                        <label for="value" class="col-sm-8 col-form-label"><?= $np['massage']; ?></label>
                    </div>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $np['id']; ?>">
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