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
          <img src="<?= base_url('assets'); ?>/auth_assets/images/undraw_searching_p-5-ux.svg" alt="Image" class="img-fluid" />
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <a href="<?= base_url(); ?>">
                  <img src="<?= base_url('assets'); ?>/auth_assets/images/belife-logo-full.png" alt="Image" class="img-fluid" />
                  <!-- <p class="mb-4">Belife Apps Change Your Life Become Better</p> -->
                </a>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <form action="<?= base_url('Auth/forgot_password'); ?>" method="post">
                <!-- <div class="form-group first">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"   value="<?= set_value('email'); ?>"  />
                  </div> -->

                <div class="form-group singel mb-4">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" />
                </div>


                <div class="d-flex mb-5 align-items-center">

                  <span class="ml-auto"><a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth'); ?>'" class="forgot-pass">Sign In</a></span>
                </div>

                <input type="submit" value="Request New Password" class="btn btn-block btn-light" />

                <span class="d-block text-left my-4 text-muted"><a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth/Registration'); ?>'" class="signup-pass">Sign Up</a></span>

                <span class="d-block text-left my-4 text-center text-white">Copyright &copy;<?= date('Y'); ?> PT Betterlife Jaya Indonesia <i class="fas fa-copyright font-italic ml-2"> JAP</i></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="card card-footer text-center">
            <strong class="text-center">
                Copyright &copy;<?= date('Y'); ?> PT Betterlife Jaya Indonesia
            </strong>
    </div> -->
  <script src="<?= base_url('assets'); ?>/auth_assets/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url('assets'); ?>/auth_assets/js/popper.min.js"></script>
  <script src="<?= base_url('assets'); ?>/auth_assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets'); ?>/auth_assets/js/main.js"></script>
</body>

</html>