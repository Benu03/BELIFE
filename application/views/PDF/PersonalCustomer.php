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
                
                $data = file_get_contents('http://localhost:6060/belife-apps/assets/img/belife-logo-1.png');
                $base64 = 'data:image/'  . ';base64,' . base64_encode($data);
                ?>
                    <tr>
                        <td style="text-align:center;background-color:Gray;" >
                        <h2> <img  src="<?php echo $base64; ?>" style="height:30px;"> PT Betterlife Jaya indonesia </h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <br>

            <!--  Data Pegawai -->
            <b style="font-size: 14px;">Personal Data</b>
            <table border="0" width="100%"   >
                <tbody>
                        <tr>
                        <td><b>Name</b></td>
                        <td><?= $datadetailregister['name_full']; ?></td>

                        <td><b>Tanggal Lahir</b></td>
                        <td><?= $datadetailregister['tgl_lahir']; ?></td>
                        </tr>
                        <tr>
                        <td><b>Username</b></td>


                       <td><?= $datadetailregister['username']; ?></td>
                       <td><b>Tempat Lahir</b></td>
                        <td><?= $datadetailregister['tempat_lahir']; ?></td>
                       </tr>
                        <tr> 
                       <td><b>Email</b></td>

                        <td><?= $datadetailregister['email']; ?></td>
                        <td><b>Jenis Kelamin</b></td>
                        <td><?= $datadetailregister['jenis_kelamin']; ?></td>
                        </tr>
                        <tr>
                        <td><b>No Kontak</b></td>
                        <td><?= $datadetailregister['phone']; ?></td>
                        <td><b>Provinsi</b></td>
                        <td><?= $datadetailregister['nama_provinsi']; ?></td>
                        </tr>
                        <tr>
                       <td><b>NIK</b></td>
                       <td><?= $datadetailregister['nik']; ?></td> 
                       <td><b>Kota Kabupaten</b></td>
                        <td><?= $datadetailregister['nama_kota_kabupaten']; ?></td>
                       </tr>
                        <tr>
                       <td><b>Perusahaan</b></td>
                       <td><?= $datadetailregister['patner_name']; ?></td> 
                       <td><b>Alamat KTP</b></td>
                        <td><?= $datadetailregister['address_ktp']; ?></td>
                       </tr>
                        <tr>
                       <td><b>limit</b></td>
                       <td>Rp. <?= number_format($datadetailregister['limit'],0 ,',','.'); ?></td> 
                    

                    </tr>
                   

                </tbody>
            </table>
            <br>

            <table border="0" width="100%"   >
            <tr>
            <td style="text-align:center; width: 33%;" ><b>Selfie</b></td>
            <td style="text-align:center; width: 33%;"><b>KTP</b></td>
            <td style="text-align:center; width: 33%;"><b>Selfie Dengan KTP</b></td>


            </tr>

            <tr>
            <td style="text-align:center; width: 33%;" >
            <?php 
                $url = base_url('assets/img/img-profile/'.$datadetailregister['username'].'/'. $datadetailregister['selfie_image']); 
                $dataselfie = file_get_contents($url);
                $base64selfie = 'data:image/'  . ';base64,' . base64_encode($dataselfie);
                ?>

            <img  src="<?php echo $base64selfie; ?>" style="height:150px;">


            </td>

            <td style="text-align:center; width: 33%;" >
            <?php 
                $url = base_url('assets/img/img-profile/'.$datadetailregister['username'].'/'. $datadetailregister['ktp_image']); 
                $dataktp = file_get_contents($url);
                $base64ktp = 'data:image/'  . ';base64,' . base64_encode($dataktp);
                ?>

            <img  src="<?php echo $base64ktp; ?>" style="height:150px;">


            </td>

            <td style="text-align:center; width: 33%;" >
            <?php 
                $url = base_url('assets/img/img-profile/'.$datadetailregister['username'].'/'. $datadetailregister['selfie_ktp_image']); 
                $dataselfie_ktp_image = file_get_contents($url);
                $base64selfie_ktp_image = 'data:image/'  . ';base64,' . base64_encode($dataselfie_ktp_image);
                ?>

            <img  src="<?php echo $base64selfie_ktp_image; ?>" style="height:150px;">


            </td>

            

            </tr>


            </table>



         

        </div>

    </div>
    <p></p>
    <footer>
        <hr>
        © 2022 Belife Indonesia
    </footer>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <!-- <script>
        window.addEventListener(" load", window.print()); </script> -->
</body>

</html>