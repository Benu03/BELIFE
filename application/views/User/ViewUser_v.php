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
                </div><!-- /.col -->
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

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">View Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">username</label>
                                <div class="col-sm-9"><?= $dtUser['username']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9"><?= $dtUser['name']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9"><?= $dtUser['email']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="id_role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9"><?= $dtUser['role']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="id_loc" class="col-sm-3 col-form-label">Work Location</label>
                                <div class="col-sm-9"><?= $dtUser['location_name']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="id_org" class="col-sm-3 col-form-label">Organization</label>
                                <div class="col-sm-9"><?= $dtUser['organization_name']; ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="id_org" class="col-sm-3 col-form-label">Created At</label>
                                <div class="col-sm-9"><?= date("l, d-m-Y", strtotime($dtUser['created_at'])); ?></div>
                            </div>
                            <div class="form-group row">
                                <label for="id_org" class="col-sm-3 col-form-label">Updated At</label>
                                <div class="col-sm-9">
                                    <?php if ($dtUser['updated_at'] == null) : ?>
                                        Not updated
                                    <?php else : ?>
                                        <?= date("l, d-m-Y", strtotime($dtUser['updated_at'])); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="is_active" class="col-sm-3 col-form-label">Is Active?</label>
                                <div class="col-sm-9">
                                    <?php if ($dtUser['is_active'] == '1') : ?>
                                        Yes
                                    <?php else : ?>
                                        No
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)" onclick="location.href='<?= base_url('User/UserManagement'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                            <a href="javascript:void(0)" onclick="location.href='<?= base_url('User/UpdateUser/' . Encrypt_url($dtUser['id'])); ?>'" class="btn btn-sm btn-info float-right">Update</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">View Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Profile Picture</label>
                                <div class="col-sm-8">
                                    <?php if ($dtUser['img_user'] == "default_img_user.png" or NULL) : ?>
                                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/img-profile/default_img_user.png'); ?>" alt="User profile picture">
                                    <?php else : ?>
                                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/img-profile/' . $dtUser['username'] . '/' . $dtUser['img_user']); ?>" alt="User profile picture">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<!-- Notes: includes file views templates/footer.php -->
<?php $this->load->view('templates/footer'); ?>