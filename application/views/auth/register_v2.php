<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/owl.carousel.min.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/bootstrap.min.css" />

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/mycss.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/style2.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/sweetalert2.min.css">

    <title><?= $title; ?></title>
    <link rel="Shortcut Icon" href="<?php echo base_url('assets'); ?>/img/belife-logo-1.png" />




</head>

<body>

    <div class="content">



        <div class="container register">
            <div class="row">
                <div class="col-md-3 register-left">
                <a href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets'); ?>/auth_assets/images/belife-logo-full.png" alt="Image" class="img-fluid" />

                    <img src="<?= base_url('assets'); ?>/auth_assets/images/undraw_reviewed_docs_re_9lmr.svg" alt="Image" class="img-fluid" />
                </a>
                    <p>Belife Apps Change Your Life Become Better</p>
                    <br>
                    <span class="d-block text-left my-1 text-center text-white">PT Betterlife Jaya Indonesia </span>
                    <span class="d-block text-left my-1 text-center text-white">Copyright &copy;<?= date('Y'); ?> JAP</span>
                </div>
                <div class="col-md-9 register-right">


                    <h3 class="register-heading">Upload File</h3>
                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('Auth/Registration_upload') ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row register-form">

                                <div class="col-md-8">
                               
                                <input type="text" class="form-control" id="username" name="username"  data="username" value="<?= $username; ?>" hidden />
                                
                                <input type="text" class="form-control" id="email" name="email"  data="email" value="<?= $email; ?>"  hidden />


                                <div class="form-row">
                             
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="selfie_image" name="selfie_image" value="<?= set_value('selfie_image'); ?>"  required> 
                                        <label class="custom-file-label" for="selfie_image">Foto Selfie *</label>
                                       
                                    </div>
                                    
                                </div>
                              

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ktp_image" name="ktp_image" value="<?= set_value('ktp_image'); ?>" required> 
                                        <label class="custom-file-label" for="ktp_image">Foto KTP *</label>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="selfie_ktp_image" name="selfie_ktp_image" value="<?= set_value('selfie_ktp_image'); ?>"> 
                                        <label class="custom-file-label" for="selfie_ktp_image">Foto Selfie Dengan KTP *</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="buku_tabungan" name="buku_tabungan" value="<?= set_value('buku_tabungan'); ?>">
                                        <label class="custom-file-label" for="buku_tabungan">Foto Buku Tabungan*</label>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="slip_gaji" name="slip_gaji" value="<?= set_value('slip_gaji'); ?>" require> 
                                        <label class="custom-file-label" for="slip_gaji">Foto Slip Gaji*</label>
                                    </div>
                                </div>                             


                            </div>

                            
                       
                            <a href="<?= base_url('Auth/Registration'); ?>" class="btnBack text-center">Kembali</a>
                            
                            <button type="submit" class="btnRegister2">Register</button>


                            </div>


                    </form>

                </div>
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
    <script src="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/'); ?>dist/js/sweetalert2.min.js"></script>



    <script>
    

        $(function(){
        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
        });
        });

        function hanyaAngka(event) {
            var nohp = event.which ? event.which : event.keyCode;
            var nik = event.which ? event.which : event.keyCode;
            if (
                nohp != 46 &&
                nohp > 31 &&
                (nohp < 48 || nohp > 57)
            )
                if (
                    nik != 46 &&
                    nik > 31 &&
                    (nik < 48 || nik > 57)
                )


                    return false;
            return true;
        }







    $(document).ready(function(){
 
    $('#selfie_image').submit(function(e){
        var username = $(this).data('username');
        var email = $(this).data('email');
        e.preventDefault(); 
            $.ajax({
                url:'<?= base_url('Auth/Upload_selfie_image') ?>',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){
                    alert("Upload Image Berhasil.");
                }
            });
        });
    

    });




    function suppliergetpodo() {
        var username = $("#username").val();
        var email = $("#email").val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('Auth/Upload_selfie_image') ?>",
            dataType: "JSON",
            data: {
                username: username,
                email: email
            },
            // cache: false,
            success: function(data) {


                $("#namakontaksup").val(data.nama_kontak_supplier);
                $("#kontaksup").val(data.kontak_supplier);
                $("#bankaccountsup").val(data.bank_supplier);
                $("#noreksup").val(data.norek_supplier);


            }
        });


    }


    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>



</body>

</html>