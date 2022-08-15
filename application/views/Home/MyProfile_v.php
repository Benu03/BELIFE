<!-- Notes: includes file views Templates/header.php -->
<?php $this->load->view('Templates/header'); ?>

<!-- Notes: includes file views Templates/navbar.php -->
<?php $this->load->view('Templates/navbar'); ?>

<!-- Notes: includes file views Templates/sidebar.php -->
<?php $this->load->view('Templates/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">

        <div class="container-fluid">
            <?= $this->session->flashdata('wlcmsg'); ?>
            <div class="row">

                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if ($usrProfile['img_user'] == "default_img_user.png" or NULL) : ?>
                                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/img-profile/default_img_user.png'); ?>" alt="User profile picture">
                                <?php else : ?>
                                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/img-profile/' . $usrProfile['username'] . '/' . $usrProfile['img_user']); ?>" alt="User profile picture">
                                <?php endif; ?>
                            </div>

                            <h3 class="profile-username text-center"><?= $usrProfile['name']; ?></h3>

                            <p class="text-muted text-center"><?= $usrProfile['username']; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $usrProfile['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b> <a class="float-right"><?= $usrProfile['role']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date Created</b> <a class="float-right"><?= date("l, d-m-Y", strtotime($usrProfile['created_at'])); ?></a>
                                </li>
                            </ul>


                        </div>
                        <div class="card-footer text-right">
                        <a href="<?= base_url('Home/PersonalData') ?>" class="btn btn-warning btn-sm active" role="button" aria-pressed="true"><i class="fas fa-user-tag"></i> Personal Data</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Start Form Error Notification -->
                    <?= $this->session->flashdata('pass_message'); ?>
                    <?= form_error('img_user', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('email', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('current_password', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('new_password1', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('new_password2', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <!-- End Form Error Notification -->
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#imageprofile" data-toggle="tab"><i class="fas fa-user-circle"></i> Image Profile</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="#editprofile" data-toggle="tab">Edit Profile</a></li> -->
                                <li class="nav-item"><a class="nav-link" href="#changepassword" data-toggle="tab"><i class="fas fa-key"></i> Change Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- START TAB UPLOAD IMAGE -->
                                <div class="active tab-pane" id="imageprofile">
                                    <form action="<?= base_url('Home/UpdateImage/' . Encrypt_url($this->session->userdata('username'))); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="img_user">Image Profile</label>
                                            <input type="file" class="form-control-file" id="img_user" name="img_user" accept="image/jpeg" required><br>
                                            <p class="help-block text-danger">*Format file 'jpg', maksimal ukuran file 512kb</p>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary float-right">
                                                <i class="fas fa-upload"></i> Upload
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END TAB UPLOAD IMAGE -->
                                <!-- START TAB EDIT PROFILE -->
                                <div class="tab-pane" id="editprofile">
                                    <form action="<?= base_url('Home/EditProfile/' . Encrypt_url($this->session->userdata('username'))); ?>" class="form-horizontal" method="POST">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Update Data Name" value="<?= $usrProfile['name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Update Data Email" value="<?= $usrProfile['email']; ?>" required>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label for="id_org" class="col-sm-4 col-form-label">Organization</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm select2" id="id_org" name="id_org" data-placeholder="Select an Organization" style="width: 100%;" required>
                                                    <option></option>
                                                    <?php foreach ($dtOrganization as $dt) : ?>
                                                        <?php if (strtolower($dt['id']) === strtolower($usrProfile['id_org'])) : ?>
                                                            <option value="<?= $dt['id']; ?>" selected="selected">
                                                                <?= $dt['organization_name']; ?>
                                                            </option>
                                                        <?php else : ?>
                                                            <option value="<?= $dt['id']; ?>">
                                                                <?= $dt['organization_name']; ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id_loc" class="col-sm-4 col-form-label">Work Location</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm select2" id="id_loc" name="id_loc" data-placeholder="Select an Organization" style="width: 100%;" required>
                                                    <option></option>
                                                    <?php foreach ($dtWorklocation as $dt) : ?>
                                                        <?php if (strtolower($dt['id']) === strtolower($usrProfile['id_loc'])) : ?>
                                                            <option value="<?= $dt['id']; ?>" selected="selected">
                                                                <?= $dt['location_name']; ?>
                                                            </option>
                                                        <?php else : ?>
                                                            <option value="<?= $dt['id']; ?>">
                                                                <?= $dt['location_name']; ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="submit" class="btn btn-sm btn-primary float-right">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END TAB EDIT PROFILE -->
                                <!-- START TAB CHANGE PASSWORD -->
                                <div class="tab-pane" id="changepassword">
                                    <form action="<?= base_url('Home/ChangePassword/' . Encrypt_url($this->session->userdata('username'))); ?>" class="form-horizontal" method="POST">
                                        <div class="form-group row">
                                            <label for="current_password" class="col-sm-4 col-form-label">Old Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control form-control-sm" id="current_password" name="current_password" placeholder="Insert Old Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password1" class="col-sm-4 col-form-label">New Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control form-control-sm" id="new_password1" name="new_password1" placeholder="Insert New Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password2" class="col-sm-4 col-form-label">Repeat New Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control form-control-sm" id="new_password2" name="new_password2" placeholder="Confirm New Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="submit" class="btn btn-sm btn-primary float-right">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END TAB CHANGE PASSWORD -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Notes: includes file views Templates/footer.php -->
<?php $this->load->view('Templates/footer'); ?>