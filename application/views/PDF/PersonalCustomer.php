<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="Shortcut Icon" href="<?php echo base_url('assets'); ?>/img/logo.png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
    <style>
        table,
        th,
        td {
           
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <header>
      
       
    </header>
    <div class="wrapper">

        <div class="card-body">
            <table style="width:100%" border="1">
                <tbody>
                <?php 
                $path = "/application/BELIFE/assets/img/belife-logo-1.png";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                ?>
                    <tr>
                        <td style="text-align:left;background-color:Coral;" >
                        <h2> <img  src="<?php echo $base64; ?>" style="height:30px;"> PT Betterlife Jaya indonesia </h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <br>

            <!--  Data Pegawai -->
            <b style="font-size:18px;font-family: Arial, Helvetica, sans-serif;">Personal Data</b>
            <table border="0" width="100%"   >
                <tbody>
                    <tr>
                       <td  width="50%">
                        <table border="0" width="100%"   >
                         <tbody>
                         <tr>
                        <td style="width: 30%;"><b>Nama</b></td>
                        <td><?= $datadetailregister['name_full']; ?></td>
                        </tr>
                        <tr>
                        <td><b>Tanggal Lahir</b></td>
                        <td><?= $datadetailregister['tgl_lahir']; ?></td>
                        </tr>
                        <tr>
                        <td><b>Username</b></td>
                       <td><?= $datadetailregister['username']; ?></td>
                       </tr>
                        <tr>
                       <td><b>Tempat Lahir</b></td>
                        <td><?= $datadetailregister['tempat_lahir']; ?></td>
                       </tr>
                        <tr> 
                       <td><b>Email</b></td>
                        <td><?= $datadetailregister['email']; ?></td>
                        </tr>
                       <tr>
                        <td><b>Jenis Kelamin</b></td>
                        <td><?= $datadetailregister['jenis_kelamin']; ?></td>
                        </tr>
                        <tr>
                        <td><b>No Kontak</b></td>
                        <td><?= $datadetailregister['phone']; ?></td>
                        </tr>
                        <tr>
                        <td><b>Provinsi</b></td>
                        <td><?= $datadetailregister['nama_provinsi']; ?></td>
                        </tr>
                        <tr>
                       <td><b>NIK</b></td>
                       <td><?= $datadetailregister['nik']; ?></td> 
                       </tr>
                        <tr>
                       <td><b>Kota Kabupaten</b></td>
                        <td><?= $datadetailregister['nama_kota_kabupaten']; ?></td>
                       </tr>
                       <tr>
                       <td><b>Alamat KTP</b></td>
                        <td><?= $datadetailregister['address_ktp']; ?></td>
                       </tr>
                        <tr>
                       <td><b>Nama Ibu</b></td>
                       <td><?= $datadetailregister['nama_ibu']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>Status Pernikahan</b></td>
                       <td><?= $datadetailregister['tgl_mulai_bekerja']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>Nama Pasangan</b></td>
                       <td><?= $datadetailregister['nama_pasangan']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>Kontak Pasangan</b></td>
                       <td><?= $datadetailregister['phone_pasangan']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>Nama Saudara</b></td>
                       <td><?= $datadetailregister['nama_saudara']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>kontak Saudara</b></td>
                       <td><?= $datadetailregister['phone_saudara']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>Tempat Bekerja</b></td>
                       <td><?= $datadetailregister['partner_name']; ?></td> 
                       </tr>
                       <tr>
                       <td><b>Tanggal Mulai Bekerja</b></td>
                       <td><?= $datadetailregister['tgl_mulai_bekerja']; ?></td> 
                       </tr>      
                       </tbody>
                      </table>
                      </td>
                    <td  width="50%">
                            <table width="90%">
                            <tbody>
                            <tr>
                            <td style="width: 30%;" ><b>KTP</b></td>
                            <td style="text-align:center;">
                            <?php 
                            $pathktp = "/application/BELIFE/assets/img/img-profile/".$datadetailregister['username']."/".$datadetailregister['ktp_image'];
                            $typektp = pathinfo($pathktp, PATHINFO_EXTENSION);
                            $dataktp = file_get_contents($pathktp);
                            $base64ktp = 'data:image/' . $typektp . ';base64,' . base64_encode($dataktp);
                            ?>
                            <img  src="<?php echo $base64ktp; ?>" style="height:95px;">
                            </td> 
                            </tr>
                            <tr>
                            <td style="width: 30%;" ><b>Selfie</b></td>
                            <td style="text-align:center;">
                            <?php 
                            $pathSelfie = "/application/BELIFE/assets/img/img-profile/".$datadetailregister['username']."/".$datadetailregister['selfie'];
                            $typeSelfie = pathinfo($pathSelfie, PATHINFO_EXTENSION);
                            $dataSelfie = file_get_contents($pathSelfie);
                            $base64Selfie = 'data:image/' . $typeSelfie . ';base64,' . base64_encode($dataSelfie);
                            ?>
                            <img  src="<?php echo $base64Selfie; ?>" style="height:95px;">
                            </tr>
                            <tr>
                            <td style="width: 30%;" ><b>Selfie Dengan KTP</b></td>
                            <td style="text-align:center;">
                            <?php 
                            $pathSelfiektp = "/application/BELIFE/assets/img/img-profile/".$datadetailregister['username']."/".$datadetailregister['selfie_ktp_image'];
                            $typeSelfiektp = pathinfo($pathSelfiektp, PATHINFO_EXTENSION);
                            $dataSelfiektp = file_get_contents($pathSelfiektp);
                            $base64Selfiektp = 'data:image/' . $typeSelfiektp . ';base64,' . base64_encode($dataSelfiektp);
                            ?>                            
                            <img  src="<?php echo $base64Selfiektp; ?>" style="height:95px;">
                            </tr>
                            <tr>
                            <td style="width: 30%;" ><b>Buku Tabungan</b></td>
                            <td style="text-align:center;">
                            <?php 
                            $pathtabungan = "/application/BELIFE/assets/img/img-profile/".$datadetailregister['username']."/".$datadetailregister['buku_tabungan'];
                            $typetabungan = pathinfo($pathtabungan, PATHINFO_EXTENSION);
                            $datatabungan = file_get_contents($pathtabungan);
                            $base64tabungan = 'data:image/' . $typetabungan . ';base64,' . base64_encode($datatabungan);
                            ?>  
                            <img  src="<?php echo $base64tabungan; ?>" style="height:95px;">
                            </td> 
                            </tr>
                            <tr>
                            <td style="width: 30%;" ><b>Slip Gaji</b></td>
                            <td style="text-align:center;">
                            <?php 
                            $pathslipgaji = "/application/BELIFE/assets/img/img-profile/".$datadetailregister['username']."/".$datadetailregister['slip_gaji'];
                            $typeslipgaji = pathinfo($pathslipgaji, PATHINFO_EXTENSION);
                            $dataslipgajin = file_get_contents($pathslipgaji);
                            $base64slipgaji = 'data:image/' . $typeslipgaji . ';base64,' . base64_encode($dataslipgajin);
                            ?>  
                            <img  src="<?php echo $base64slipgaji; ?>" style="height:95px;">
                            </td> 
                            </tr>
                         </tbody>
                        </table>

                    </td>
                   
                    </tr>
                                     
                   

                </tbody>
            </table>
                         

        </div>

    </div>
    <p></p>
    <footer>
        <hr>
        <i style="font-size:11px;font-family: Arial, Helvetica, sans-serif;">© 2022 Belife Indonesia</i>
        
    </footer>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <!-- <script>
        window.addEventListener(" load", window.print()); </script> -->
</body>

</html>