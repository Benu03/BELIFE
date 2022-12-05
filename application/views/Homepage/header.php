<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>
  <link rel="Shortcut Icon" href="<?php echo base_url('assets'); ?>/img/belife-logo-1.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/mycss.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url('assets/homepage'); ?>/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url('assets/homepage'); ?>/css/icomoon.css">
  	<link rel="stylesheet" href="<?= base_url('assets/homepage'); ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/homepage'); ?>/css/ionicons.min.css"> -->


  <script src="<?= base_url('assets/homepage'); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url('assets/homepage'); ?>/js/jquery-migrate-3.0.1.min.js"></script>

</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed  layout-footer-fixed">

  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-orange">
      <div class="container">


        <a href="<?= base_url(''); ?>" class="navbar-brand">
          <img src="<?= base_url('assets/img/belife-logo-2.png'); ?>" alt="BeLife Logo" class="brand-image">

        </a>


        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="order-1 order-md-3 navbar-nav  ml-auto">
            <li class="nav-item">
              <a href="<?= base_url(''); ?>" class="nav-link text-light"><span class="fas fa-home"></span> Beranda</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Homepage/About'); ?>" class="nav-link text-light"><span class="fas fa-building"></span> Tetang Kami</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Homepage/Contact'); ?>" class="nav-link text-light"><span class="fas fa-address-book"></span> Kontak</a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-light"><span class="fas fa-users"></span> Akun</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                <?php if (is_login()) : ?>

                  <li><a href="<?= base_url('Home'); ?>" class="dropdown-item"> <span class="fas fa-user"></span> Profile </a></li>

              

                  <?php if ($this->session->userdata('id_role') == '2') : ?>
                    <li><a href="<?= base_url('DashboardUser'); ?>" class="dropdown-item"> <span class="fas fa-chalkboard-teacher"></span> Dashboard</a></li>
                    <li><a href="<?= base_url('Feature/Keranjang'); ?>" class="dropdown-item"> <span class="fas fa-shopping-cart"></span> Keranjang (<?= count_item($this->session->userdata('username')); ?>)</a></li>
                    <li><a href="<?= base_url('Auth/Logout'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Log Out</a></li>
                  <?php elseif ($this->session->userdata('id_role') == '3') : ?>
                    <li><a href="<?= base_url('DashboardAdmin_belife'); ?>" class="dropdown-item"> <span class="fas fa-chalkboard-teacher"></span> Dashboard</a></li>
                    <li><a href="<?= base_url('Auth/Logout'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Log Out</a></li>
                  <?php elseif ($this->session->userdata('id_role') == '4') : ?>
                    <li><a href="<?= base_url('DashboardAdmin_Product'); ?>" class="dropdown-item"> <span class="fas fa-chalkboard-teacher"></span> Dashboard</a></li>
                    <li><a href="<?= base_url('Auth/Logout'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Log Out</a></li>
                  <?php elseif ($this->session->userdata('id_role') == '5') : ?>
                    <li><a href="<?= base_url('DashboardBOD'); ?>" class="dropdown-item"> <span class="fas fa-chalkboard-teacher"></span> Dashboard</a></li>
                    <li><a href="<?= base_url('Auth/Logout'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Log Out</a></li>
                  <?php elseif ($this->session->userdata('id_role') == '6') : ?>
                    <li><a href="<?= base_url('DashboardFinance'); ?>" class="dropdown-item"> <span class="fas fa-chalkboard-teacher"></span> Dashboard</a></li>
                    <li><a href="<?= base_url('Auth/Logout'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Log Out</a></li>
                  <?php else : ?>

                    <li><a href="<?= base_url('Auth/Logout'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Log Out</a></li>

                  <?php endif; ?>




                <?php else : ?>

                  <li><a href="<?= base_url('Auth/Login'); ?>" class="dropdown-item"> <span class="fas fa-sign-in-alt"></span> Login Akun </a></li>
                  <li><a href="<?= base_url('Auth/Registration_form'); ?>" class="dropdown-item"> <span class="fas fa-user-friends"></span> Daftar Akun</a></li>
                  <li><a href="<?= base_url('Auth/forgot_password'); ?>" class="dropdown-item"><span class="fas fa-sign-out-alt"></span> Lupa Password</a></li>


                <?php endif; ?>

                <!-- End Level two -->
              </ul>
            </li>
          </ul>






        </div>
    </nav>
    <!-- /.navbar -->