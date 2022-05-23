<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>

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
             <?= $this->session->flashdata('message'); ?>
            <?= form_error('tenor', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
            <?= form_error('rate', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
            <?= form_error('description', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
            <div class="row">
           
                <div class="col-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Update Data</h3>
                        </div>
                        <form action="<?= base_url('DataMaster/EditTenor/'. Encrypt_url($tenor['ID'])); ?>" method="POST" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tenor" class="col-sm-3 col-form-label">Tenor</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="tenor" name="tenor"  value="<?= $tenor['tenor']; ?>"  onkeypress="return hanyaAngka(event)" requied>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="rate" class="col-sm-3 col-form-label">Rate %</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="rate" name="rate"  value="<?= $tenor['rate']; ?>"   onkeypress="return hanyaAngka(event)" requied>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Deskipsi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="description"  name="description"  value="<?= $tenor['description']; ?>" requied>
                                    </div>
                                </div>
                               




                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('DataMaster/TenorSetting'); ?>'" class="btn btn-sm btn-default">Cancel</a>
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

<?php $this->load->view('templates/footer'); ?>