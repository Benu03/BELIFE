<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/fonts/icomoon/style.css" />

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/owl.carousel.min.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/bootstrap.min.css" />

  <!-- Style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/style.css" />

  <title><?= $title; ?></title>
  <link rel="Shortcut Icon" href="<?php echo base_url('assets'); ?>/img/belife-logo-1.png" />

</head>

<body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?= base_url('assets'); ?>/auth_assets/images/undraw_control_panel_re_y3ar.svg" alt="Image" class="img-fluid" />
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <img src="<?= base_url('assets'); ?>/auth_assets/images/belife-logo-full.png" alt="Image" class="img-fluid" />
                <p class="d-block text-left my-2 text-center text-white">Change Your Password for!!!</p>
                <p class="d-block text-left my-2 text-center text-white"><?= $this->session->userdata('reset_email');  ?></p>

              </div>
              <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
              <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
              <?= $this->session->flashdata('message'); ?>
              <form action="<?= base_url('Auth/changepassword'); ?>" method="post">
                <!-- <div class="form-group first">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"   value="<?= set_value('email'); ?>"  />
                  </div> -->

                <div class="form-group first">
                  <label for="password">Enter new password</label>
                  <input type="password" class="form-control" id="password1" name="password1" />
                </div>


                <div class="form-group last mb-">
                  <label for="password">Repeat password</label>
                  <input type="password" class="form-control" id="password2" name="password2" />
                </div>



                <div class="d-flex mb-3 align-items-center">

                  <span class="ml-auto"><a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth'); ?>'" class="forgot-pass">Sign In</a></span>
                </div>

                <input type="submit" value="Change Password" class="btn btn-block btn-light" />

                <span class="d-block text-left my-4 text-muted"><a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth/Registration'); ?>'" class="signup-pass">Sign Up</a></span>

                <span class="d-block text-left my-1 text-center text-white">PT Betterlife Jaya Indonesia </span>
                <span class="d-block text-left my-1 text-center text-white">Copyright &copy;<?= date('Y'); ?> JAP</span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets'); ?>/auth_assets/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url('assets'); ?>/auth_assets/js/popper.min.js"></script>
  <script src="<?= base_url('assets'); ?>/auth_assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets'); ?>/auth_assets/js/main.js"></script>
</body>

</html>