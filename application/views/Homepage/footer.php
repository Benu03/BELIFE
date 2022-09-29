 <!-- Main Footer -->
 <footer class="main-footer">
   <!-- To the right -->

   <strong><a href="javascript:void(0)"> PT Betterlife Jaya Indonesia </a>. <i class="fas fa-copyright font-italic ml-1"> <?= date('Y'); ?> JAP</i></strong>





 </footer>
 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->

 <!-- jQuery -->
 <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap 4 -->
 <script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
 <!-- AdminLTE for demo purposes -->
 <!-- <script src="<?= base_url('assets'); ?>/dist/js/demo.js"></script> -->
 <!-- 
 <script src="<?= base_url('assets/homepage'); ?>/js/popper.min.js"></script> -->
 <script src="<?= base_url('assets/homepage'); ?>/js/bootstrap.min.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/jquery.easing.1.3.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/jquery.waypoints.min.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/jquery.stellar.min.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/owl.carousel.min.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/jquery.magnific-popup.min.js"></script>
 <!-- <script src="<?= base_url('assets/homepage'); ?>/js/aos.js"></script> -->
 <script src="<?= base_url('assets/homepage'); ?>/js/jquery.animateNumber.min.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/bootstrap-datepicker.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/scrollax.min.js"></script>
 <script src="<?= base_url('assets/homepage'); ?>/js/main.js"></script>
 <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
 <script src="<?= base_url('assets'); ?>/homepage/js/sweetalert2/sweetalert2.all.min.js"></script>
 <script>
   const flashData = $('.flash-data').data('flashdata');
   if (flashData) {
     Swal({
       title: 'Data Berhasil ' + flashData,
       text: 'eeeeeeee',
       type: 'success'
     });
   }
 </script>

 </body>

 </html>