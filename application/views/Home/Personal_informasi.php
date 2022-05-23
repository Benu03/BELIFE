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
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

         
        <div class="card">
                         <div class="card-body">
            <div class="row">
                <div class="col-12">
                  

                        

                <?= $this->session->flashdata('message'); ?>
                <?= form_error('name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                <?= form_error('phone', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                <?= form_error('alamat', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                <?= form_error('id_org', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                <?= form_error('id_loc', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                

                <div class="card card-solid">
                         <div class="card-body">

                         <form action="<?= base_url('Home/PersonalCustomer')?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">User Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control form-control-sm" id="username" name="username"  value="<?= $usrProfile['username']; ?>" disabled>

                                        <input type="text" class="form-control form-control-sm" id="email" name="email"  value="<?= $usrProfile['email']; ?>" hidden>
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Insert Title" value="<?= $usrProfile['name']; ?>" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="phone" name="phone"  value=" " >
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                       
                                    <textarea class=" col-lg-12 form-control " style="overflow:auto;resize:none" id="alamat"  name="alamat"  rows="3"  value="<?= set_value('alamat'); ?>"></textarea>
                                    


                                    </div>
                                </div>







                                <div class="form-group row">
                                    <label for="id_org" class="col-sm-3 col-form-label">Organization</label>
                                    <div class="col-sm-6">
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
                                    <label for="id_loc" class="col-sm-3 col-form-label">Work Location</label>
                                    <div class="col-sm-6">
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
                                </div>
                             


                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Selfie Foto</label>
                                    <div class="col-sm-8">
                      
                                          <div class="row">
                                                        <div class="col-sm-3">
                                                        
                                                        <img src="<?= base_url('assets/img/img-profile/').$usrProfile['username'].'/'.$usrProfile['img_user']; ?>" class="img-thumbnail" >
                                                        </div>
                                                        <div class="col-sm-6">
                                                        
                                                           <label for="image_selfie">Selfie Foto</label>
                                                            <input type="file" class="form-control-file" id="image_selfie" name="image_selfie"  accept="image/jpeg"  required><br>
                                                            <p class="help-block text-danger">*Format file 'jpg,jpeg,png', maksimal ukuran file 512kb</p>



                                                        </div>
                                                
                                                </div>
                                        
                                        </div>
                                </div>



                                <a href="<?= base_url('Auth'); ?>" class="btnSignIn text-center">Sign In</a>



                            </div>
                            <div class="card-footer">
                                <a href='<?= base_url('Home'); ?>' class="btn btn-sm btn-default">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-info float-right">Simpan</button>
                            </div>
                        </form>
                            




                         </div>
                    </div>

                  </div>
              </div>
             

                
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer'); ?>