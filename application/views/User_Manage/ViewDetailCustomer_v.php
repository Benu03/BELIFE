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

                <div class="col-md-6"">
                                                   
                            <div class=" card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Personal Data</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Username</label>

                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['username'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['name_full'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['email'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">NIK KTP</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['nik'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['tgl_lahir'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['tempat_lahir'] ?></label>
                            </div>
                        </div>


                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['jenis_kelamin'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Provinsi</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['nama_provinsi'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kota</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['nama_kota_kabupaten'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat KTP</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['address_ktp'] ?></label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Perusahan</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['patner_name'] ?></label>
                            </div>
                        </div>


                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Register</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label"><?= $datadetailregister['datetime_post'] ?></label>
                            </div>
                        </div>


                        <div class="row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Limit</label>
                            <div class="col-sm-8">
                                <label for="staticEmail" class="col-form-label">Rp. <?= number_format($datadetailregister['limit'], 0, ',', '.'); ?></label>
                            </div>
                        </div>


                    </div>
                </div>



            </div>

            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Image Data</h3>
                    </div>



                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie_image']); ?>" data-toggle="lightbox" data-title="Foto Selfie" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie_image']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>
                            <div class="col-sm-4 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['ktp_image']); ?>" data-toggle="lightbox" data-title="Foto KTP" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['ktp_image']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>

                            <div class="col-sm-4 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie_ktp_image']); ?>" data-toggle="lightbox" data-title="Foto Selfie Dengan KTP" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie_ktp_image']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>

                        </div>
                    </div>





                </div>

                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Verifikasi Customer</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('User_Manage/approvedpostlimit'); ?>" method="POST" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="limit" class="col-sm-4 col-form-label">Limit (Rp)</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="username" name="username" value="<?= $datadetailregister['username'] ?>" hidden>
                                    <input type="text" class="form-control form-control-sm" id="limit" name="limit" onkeypress="return hanyaAngka(event)" required>

                                </div>
                            </div>




                    </div>
                    <div class="card-footer text-right">

                        <a class="btn btn-md bg-info mr-2" href="<?= base_url('User_Manage/GeneratePdfRegister/' . Encrypt_url($datadetailregister['username'])); ?>" target="_blank"><i class="fas fa-file-pdf"></i> Generate PDF</a>

                        <a class="btn btn-md bg-danger  mr-2 " href="<?= base_url('User_Manage/RejectRegister/' . Encrypt_url($datadetailregister['username'])); ?>"><i class="fas fa-thumbs-down"></i> Reject</a>

                        <button type="submit" class="btn btn-success"> <i class="fas fa-thumbs-up"></i> Approved</button>

                    </div>
                    </form>

                </div>


            </div>




        </div>




    </div>
</div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>