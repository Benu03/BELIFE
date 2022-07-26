<?php $this->load->view('Templates/header'); ?>
<?php $this->load->view('Templates/navbar'); ?>
<?php $this->load->view('Templates/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                            Access Role
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-low-vision"></i>
                                Access for : <strong><?= $dtRole['role']; ?></strong>
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('User/UserRoles'); ?>'" type="button" class="btn btn-sm btn-default">
                                            <i class="fas fa-arrow-left"></i>
                                            Back
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body table-responsive pad">
                            <table id="tbroles" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Menu Title</th>
                                        <th>Menu Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($dtMenu as $m) : ?>
                                        <tr>
                                            <td width="30px"><?= $i++; ?></td>
                                            <td><?= $m['title']; ?></td>
                                            <td><?= $m['name']; ?></td>
                                            <td width="60px" class="text-center">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="form-check-input" type="checkbox" id="accessRole" <?= check_access($dtRole['id'], $m['id']); ?> data-role="<?= $dtRole['id']; ?>" data-menu="<?= $m['id']; ?>">
                                                        <label for="accessRole" class="form-check-label"></label>
                                                    </div>
                                                </div>
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

<?php $this->load->view('Templates/footer'); ?>