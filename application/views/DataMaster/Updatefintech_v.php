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
                            Update Data
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Update Data</h3>
                        </div>
                        <form action="<?= base_url('DataMaster/Editfintech/' . Encrypt_url($fintech['id'])); ?>" method="POST" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="fintech_name" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="fintech_name" name="fintech_name" placeholder="Insert Organization Name" value="<?= $fintech['fintech_name']; ?>" requied>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_active" class="col-sm-3 col-form-label">Is Active?</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio">
                                            <?php if ($fintech['is_active'] == '1') : ?>
                                                <input class="custom-control-input" type="radio" id="is_active1" name="is_active" value="1" checked>
                                            <?php else : ?>
                                                <input class="custom-control-input" type="radio" id="is_active1" name="is_active" value="1">
                                            <?php endif; ?>
                                            <label for="is_active1" class="custom-control-label">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <?php if ($fintech['is_active'] == '0') : ?>
                                                <input class="custom-control-input" type="radio" id="is_active2" name="is_active" value="0" checked>
                                            <?php else : ?>
                                                <input class="custom-control-input" type="radio" id="is_active2" name="is_active" value="0">
                                            <?php endif; ?>
                                            <label for="is_active2" class="custom-control-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('DataMaster/Fintech'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-info float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>