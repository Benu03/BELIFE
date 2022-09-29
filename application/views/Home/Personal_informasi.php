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
        <?= $this->session->flashdata('message'); ?>

        
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                            
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-5 col-form-label">UserName</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="username" name="username" value="<?= $usrProfile['username']; ?>" disabled>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-5 col-form-label">Name Lengkap</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Insert Title" value="<?= $usrProfile['name']; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-5 col-form-label">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?= $usrProfile['email']; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nik" class="col-sm-5 col-form-label">NIK</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="nik" name="nik"  value="<?= $personaluser['nik']; ?>" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-5 col-form-label">No Handphone</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="<?= $personaluser['phone']; ?>" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="dateregister" class="col-sm-5 col-form-label">Tanggal Register</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="dateregister" name="dateregister"  value="<?= $personaluser['datetime_post']; ?>" disabled>
                                                </div>
                                            </div>

                                           

                                  

                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                             <div class="card">
                                <div class="card-body">                                      
                              
                                <div class="form-group row">
                                    <label for="tgl_lhr" class="col-sm-5 col-form-label">Tanggal lahir</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" id="tgl_lhr" name="tgl_lhr"  value="<?= $personaluser['tgl_lahir']; ?>" disabled>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="tmpt_lhr" class="col-sm-5 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" id="tmpt_lhr" name="tmpt_lhr" placeholder="Insert Title" value="<?= $personaluser['tempat_lahir']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-5 col-form-label">Provinsi</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" id="provinsi" name="provinsi" placeholder="Insert Title" value="<?= $personaluser['nama_provinsi']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kota" class="col-sm-5 col-form-label">Kota/Kabupaten</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" id="kota" name="kota" placeholder="Insert Title" value="<?= $personaluser['nama_kota_kabupaten']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-5 col-form-label">Alamat KTP</label>
                                    <div class="col-sm-7">
                                        <textarea class=" col-lg-12 form-control " style="overflow:auto;resize:none" id="alamat" name="alamat" rows="3" value="<?= set_value('alamat'); ?>" disabled><?= $personaluser['address_ktp']; ?></textarea>
                                    </div>
                                            </div>

                                        </div>

                                </div>

                            </div>

                    </div>


                    <div class="row">
                          <div class="col-8">
                            <div class="card">
                                <div class="card-body">  
                                                <div class="row">                                                    
                                                    <div class="col-9">
                                                         <form action="<?= base_url('Home/Upload_ktp') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                        <div class="input-group">
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="ktp_image" name="ktp_image" value="<?= set_value('ktp_image'); ?>">
                                                            <label class="custom-file-label" for="inputGroupFile04">Upload Foto KTP</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                    <?php if ($personaluser['ktp_image'] != NULL)  : ?>
                                                    <button type="button" class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#ktp"> <i class="fas fa-image"></i> KTP</button>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="row mt-2">                                                    
                                                    <div class="col-9">
                                                         <form action="<?= base_url('Home/Upload_selfie') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                        <div class="input-group">
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="selfie_image" name="selfie_image" value="<?= set_value('selfie_image'); ?>">
                                                            <label class="custom-file-label" for="inputGroupFile04">Upload Foto Selfie</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                    <?php if ($personaluser['selfie'] != NULL)  : ?>
                                                    <button type="button" class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#selfie"> <i class="fas fa-image"></i> Selfie</button>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>


                                                <div class="row mt-2">                                                    
                                                    <div class="col-9">
                                                         <form action="<?= base_url('Home/Upload_selfie_ktp') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                        <div class="input-group">
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="selfie_ktp_image" name="selfie_ktp_image" value="<?= set_value('selfie_ktp_image'); ?>">
                                                            <label class="custom-file-label" for="inputGroupFile04">Upload Foto Selfie Dengan KTP</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                    <?php if ($personaluser['selfie_ktp_image'] != NULL)  : ?>
                                                    <button type="button" class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#selfiektp"> <i class="fas fa-image"></i> Selfie KTP</button>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>


                                                
                                                <div class="row mt-2">                                                    
                                                    <div class="col-9">
                                                         <form action="<?= base_url('Home/Upload_buku_tabungan') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                        <div class="input-group">
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="buku_tabungan_image" name="buku_tabungan_image" value="<?= set_value('buku_tabungan_image'); ?>">
                                                            <label class="custom-file-label" for="inputGroupFile04">Upload Foto Buku Tabungan</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                    <?php if ($personaluser['buku_tabungan'] != NULL)  : ?>
                                                    <button type="button" class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#bukutabungan"> <i class="fas fa-image"></i> Buku Tabungan</button>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>


                                                <div class="row mt-2">                                                    
                                                    <div class="col-9">
                                                         <form action="<?= base_url('Home/Upload_slip_gaji') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                        <div class="input-group">
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="slip_gaji_image" name="slip_gaji_image" value="<?= set_value('slip_gaji_image'); ?>">
                                                            <label class="custom-file-label" for="inputGroupFile04">Upload Foto Slip Gaji</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                    <?php if ($personaluser['slip_gaji'] != NULL)  : ?>
                                                    <button type="button" class="btn btn-info btn-md btn-block" data-toggle="modal" data-target="#slipgaji"> <i class="fas fa-image"></i> Slip Gaji</button>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>




                                </div>
                            </div>
                          </div>

                          <div class="col-4 text-center">
                          <div class="card">
                            <div class="card-body">    
                            
                            <a href="<?= base_url('Home/UpdateRegisterStatus') ?>" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true"><i class="fas fa-user-check"></i> Verifikasi Admin</a>

                            </div>
                            </div>

                          </div>

                    </div>






                </div>
            </div>
       
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>






<!-- Modal -->
<div id="ktp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gambar KTP</h4>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
      <img src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/'); ?><?= $personaluser['ktp_image']; ?>" class="img-fluid img-thumbnail">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="selfie" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gambar Selfie</h4>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
      <img src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/'); ?><?= $personaluser['selfie']; ?>" class="img-fluid img-thumbnail">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div id="ktp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gambar KTP</h4>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
      <img src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/'); ?><?= $personaluser['ktp_image']; ?>" class="img-fluid img-thumbnail">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div id="selfiektp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gambar Selfie Dengan KTP</h4>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
      <img src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/'); ?><?= $personaluser['selfie_ktp_image']; ?>" class="img-fluid img-thumbnail">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="bukutabungan" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gambar Selfie Dengan KTP</h4>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
      <img src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/'); ?><?= $personaluser['buku_tabungan']; ?>" class="img-fluid img-thumbnail">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div id="slipgaji" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gambar Selfie Dengan KTP</h4>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
      <img src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/'); ?><?= $personaluser['slip_gaji']; ?>" class="img-fluid img-thumbnail">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>