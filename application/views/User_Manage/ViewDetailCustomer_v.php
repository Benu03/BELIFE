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

                <div class="col-md-12">
                                                   
                    <div class=" card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-tag"></i> Personal Data</h3>
                    </div>
                    <div class="card-body">
                         <div class="row text-align">
                         <div class="col-sm-5 text-align">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right text-dark"><b><?= $datadetailregister['username'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Lengkap</b> <a class="float-right text-dark"><b><?= $datadetailregister['name_full']; ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right text-dark"><b><?= $datadetailregister['email']; ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No Handphone</b> <a class="float-right text-dark"><b><?= $datadetailregister['phone'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>NIK</b> <a class="float-right text-dark"><b><?= $datadetailregister['nik'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Lahir</b> <a class="float-right text-dark"><b><?= $datadetailregister['tgl_lahir'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tempat Lahir</b> <a class="float-right text-dark"><b><?= $datadetailregister['tempat_lahir'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b> <a class="float-right text-dark"><b><?= $datadetailregister['jenis_kelamin'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Provinsi</b> <a class="float-right text-dark"><b><?= $datadetailregister['nama_provinsi'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Kota/Kabupaten</b> <a class="float-right text-dark"><b><?= $datadetailregister['nama_kota_kabupaten'] ?></b></a>
                                </li>
                            

                                </ul>

                            </div>
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-5 ">

                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                    <b>Alamat KTP</b> <a class="float-right text-dark"><b><?= $datadetailregister['address_ktp'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Ibu</b> <a class="float-right text-dark"><b><?= $datadetailregister['nama_ibu'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status Pernikahan</b> <a class="float-right text-dark"><b><?= $datadetailregister['marital_status'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Pasangan</b> <a class="float-right text-dark"><b><?= $datadetailregister['nama_pasangan'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP Pasangan</b> <a class="float-right text-dark"><b><?= $datadetailregister['phone_pasangan'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Saudara</b> <a class="float-right text-dark"><b><?= $datadetailregister['nama_saudara'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP Saudara</b> <a class="float-right text-dark"><b><?= $datadetailregister['phone_saudara'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Perusahaan</b> <a class="float-right text-dark"><b><?= $datadetailregister['partner_name'] ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Mulai Bekerja</b> <a class="float-right text-dark"><b><?= $datadetailregister['tgl_mulai_bekerja'] ?></b></a>
                                </li>
                            </ul>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            </div>
            <div class="row">

            <div class="col-sm-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-image"></i> Image Data</h3>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                           <div class="col-sm-1">
                            </div>
                            <div class="col-sm-2">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie']); ?>" data-toggle="lightbox" data-title="Foto Selfie" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>
                            <div class="col-sm-2 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['ktp_image']); ?>" data-toggle="lightbox" data-title="Foto KTP" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['ktp_image']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>

                            <div class="col-sm-2 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie_ktp_image']); ?>" data-toggle="lightbox" data-title="Foto Selfie Dengan KTP" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['selfie_ktp_image']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>

                            <div class="col-sm-2 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['buku_tabungan']); ?>" data-toggle="lightbox" data-title="Foto Buku Tabungan" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['buku_tabungan']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>


                            <div class="col-sm-2 text-center">
                                <a href="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['slip_gaji']); ?>" data-toggle="lightbox" data-title="Foto Slip Gaji" data-gallery="gallery">
                                    <img src="<?= base_url('assets/img/img-profile/' . $datadetailregister['username'] . '/' . $datadetailregister['slip_gaji']); ?>" class="img-fluid mb-2">
                                </a>
                            </div>
                            
                            <div class="col-sm-1">
                            </div>


                        </div>

                    </div>





                </div>

            </div>
                <div class="col-sm-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Verifikasi Customer</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('User_Manage/approvedpostlimit'); ?>" method="POST" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="limit" class="col-sm-4 col-form-label">Limit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="username" name="username" value="<?= $datadetailregister['username'] ?>" hidden>
                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control-sm" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="limit" name="limit" onkeypress="return hanyaAngka(event)" required>
                                    </div>
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
</div>
<!-- /.content-wrapper -->

<script>
         var limitcustomer = document.getElementById("limit"); 

      
        limitcustomer.addEventListener("keyup", function(e) {    
        limitcustomer.value = formatRupiah(this.value);
        });


        function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? rupiah : "";
        }

</script>

<?php $this->load->view('Templates/footer'); ?>