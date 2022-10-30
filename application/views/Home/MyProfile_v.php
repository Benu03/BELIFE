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
            <?= $this->session->flashdata('message'); ?>
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

                            <p class="text-muted text-center"><?= $usrProfile['username']; ?> (<?= $usrProfile['role']; ?>)</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $usrProfile['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No Handphone</b> <a class="float-right"><?= $usrProfile['phone']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Registrasi</b> <a class="float-right"><?= date("l, d-m-Y", strtotime($usrProfile['created_at'])); ?></a>
                                </li>
                                <?php if (($this->session->userdata('id_role') == 2))  : ?>
                                <li class="list-group-item">
                                    <b>Limit Per Bulan</b> <a class="float-right">Rp. <?= number_format($usrProfile['limit_user'], 0, ',', '.'); ?></a>
                                </li>
                                <?php endif; ?>

                                <?php if (($this->session->userdata('id_role') == 2) && $contract_data['status_contract'] == 'GOLIVE')  : ?>
                                <li class="list-group-item">
                                    <b>Cicilan Berjalan</b> <button type="button" class="float-right btn btn-sm btn-info" data-toggle="modal" data-target="#modal-contract-data"><i class="fas fa-money-bill-wave"></i> Detail Cicilan </button>
                                </li>
                                <?php endif; ?>
                                
                  
                            </ul>


                        </div>

                        <?php if (($this->session->userdata('id_role') == 2) && $personal['status_register'] == 'not_update')  : ?>
                        <div class="card-footer text-right">
                        <a href="<?= base_url('Home/PersonalData') ?>" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-user-tag"></i> Personal Data</a>
                        </div>
                        <?php endif; ?>

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





<div class="modal fade" id="modal-contract-data">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-money-bill-wave"></i> Detail Cicilan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
            
                <div class="row">
                <div class="col-12">

                    <div class="card">
                    <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-kontrak-tab" data-toggle="pill" href="#pills-kontrak" role="tab" aria-controls="pills-kontrak" aria-selected="true"><i class="fas fa-file-contract"></i> Kontrak Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-personal-tab" data-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="false"><i class="fas fa-id-card"></i> Personal Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-installment-tab" data-toggle="pill" href="#pills-installment" role="tab" aria-controls="pills-installment" aria-selected="false"><i class="fas fa-money-bill"></i> Installment Data</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" id="pills-history-tab" data-toggle="pill" href="#pills-history" role="tab" aria-controls="pills-history" aria-selected="false"><i class="fas fa-history"></i> Kontrak History</a>
                    </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-kontrak" role="tabpanel" aria-labelledby="pills-kontrak-tab">
                     
                    <div class="card">
                    <div class="card-body">

                    <table class="table table-sm">
                    
                    <tbody>
                        <tr>
                            <th scope="row">Kontrak No</th>
                            <td><?= $contract['contract_no'] ?></td>
                            <th scope="row">User Order</th>
                            <td><?= $contract['user_order'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kode Order</th>
                            <td><?= $contract['kode_order'] ?></td>
                            <th scope="row">Date Order</th>
                            <td><?= $contract['date_order'] ?></td>      
                        </tr>
                        <tr>
                            <th scope="row">Tenor</th>
                            <td><?= $contract['tenor'] ?></td>
                            <th scope="row">Total Amout</th>
                            <td>Rp. <?= number_format($contract['total_amount'], 0, ',', '.'); ?></td>      
                        </tr>
                        <tr>
                            <th scope="row">Angsuran</th>
                            <td>Rp. <?= number_format($contract['angsuran'], 0, ',', '.'); ?></td>
                            <th scope="row">Biaya Admin</th>
                            <td>Rp. <?= number_format($contract['admin_cost'], 0, ',', '.'); ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">Status Kontrak</th>
                            <td><?= $contract['status_contract'] ?></td>
                            <th scope="row">Biaya Pengiriman</th>
                            <td>Rp. <?= number_format($contract['shipping_cost'], 0, ',', '.'); ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">Fintech</th>
                            <td><?= $contract['fintech_name'] ?></td>
                            <th scope="row">Ekspedisi</th>
                            <td><?= $contract['ekspedisi_name'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">User Approve</th>
                            <td><?= $contract['user_approve'] ?></td>
                            <th scope="row">Date Approve</th>
                            <td><?= $contract['date_approve'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">Kode Shiping</th>
                            <td><?= $contract['kode_shipping'] ?></td>
                            <th scope="row">Status Pengiriman</th>
                            <td><?= $contract['status_pengiriman'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">User Shiping</th>
                            <td><?= $contract['user_shipping'] ?></td>
                            <th scope="row">Date Shiping</th>
                            <td><?= $contract['date_shipping'] ?></td>      
                        </tr>
                       
                    </tbody>
                    </table>
                   
                       








                    </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">

                      
                    <div class="card">
                    <div class="card-body">


                    <table class="table table-sm">
                    
                    <tbody>
                        <tr>
                            <th scope="row">Username</th>
                            <td><?= $personaldata['username'] ?></td>
                            <th scope="row">Nama Lengkap</th>
                            <td><?= $personaldata['name_full'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?= $personaldata['email'] ?></td>
                            <th scope="row">NIK KTP</th>
                            <td><?= $personaldata['nik'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Lahir</th>
                            <td><?= $personaldata['tgl_lahir'] ?></td>
                            <th scope="row">Tempat Lahir</th>
                            <td><?= $personaldata['tempat_lahir'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $personaldata['jenis_kelamin'] ?></td>
                            <th scope="row">Provinsi</th>
                            <td><?= $personaldata['nama_provinsi'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kota</th>
                            <td><?= $personaldata['nama_kota_kabupaten'] ?></td>
                            <th scope="row">Alamat KTP</th>
                            <td><?= $personaldata['address_ktp'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Perusahan</th>
                            <td><?= $personaldata['partner_name'] ?></td>
                            <th scope="row">Tanggal Register</th>
                            <td><?= $personaldata['datetime_post'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Limit</th>
                            <td>Rp. <?= number_format($personaldata['limit_user'], 0, ',', '.'); ?></td>
                            
                        </tr>



                        </tbody>
                    </table>

 


                    </div>
                    </div>


                    </div>
                    <div class="tab-pane fade" id="pills-installment" role="tabpanel" aria-labelledby="pills-installment-tab">


                    <div class="card">
                    <div class="card-body">

                          <table id="tbinstallmentss" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kontrak No</th>
                                        <th>Installment No</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Angsuran</th>
                                        <th>Is Payment</th>
                                        <th>Tanggal Payment</th>
                                        <th>Tanggal Posting</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($installment_data as $p) : ?>
                                        <tr>


                                            <td class="text-center" style="vertical-align:middle"><?= $p['contract_no']; ?></td>
                                            <td class="text-center" style="vertical-align:middle"><?= $p['installment_no']; ?></td>
                                            <td class="text-center" style="vertical-align:middle"><?= $p['due_date']; ?></td>
                                            <td class="text-center" style="vertical-align:middle">Rp. <?= number_format($p['angsuran'], 0, ',', '.'); ?></td>
                                            <td class="text-center" style="vertical-align:middle"><?= $p['is_payment']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['date_payment']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['payment_post_date']; ?></td>

                                          
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>



                    </div>
                    </div>



                    </div>
                    <!-- <div class="tab-pane fade" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">


                                <div class="card">
                                <div class="card-body">



                                history





                                </div>
                                </div>


                    </div> -->
                    </div>


                    </div>
                    </div>






                </div>
            </div>

                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<?php $this->load->view('Templates/footer'); ?>


