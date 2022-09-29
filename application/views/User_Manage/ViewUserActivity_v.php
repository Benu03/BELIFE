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
                        <li class="breadcrumb-item active">
                            View Data
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">View Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9"><?= $dtActivity['username']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="activities" class="col-sm-3 col-form-label">Activities</label>
                                <div class="col-sm-9"><?= $dtActivity['activities']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="object" class="col-sm-3 col-form-label">Object</label>
                                <div class="col-sm-9"><?= $dtActivity['object']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="url" class="col-sm-3 col-form-label">URL</label>
                                <div class="col-sm-9"><?= $dtActivity['url']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="ipdevice" class="col-sm-3 col-form-label">IP Device</label>
                                <div class="col-sm-9"><?= $dtActivity['ipdevice']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="id_org" class="col-sm-3 col-form-label">At Time</label>
                                <div class="col-sm-9"><?= date("d-m-Y | H:i:s", strtotime($dtActivity['at_time'])); ?></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" onclick="location.href='<?= base_url('User/UserActivity'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>