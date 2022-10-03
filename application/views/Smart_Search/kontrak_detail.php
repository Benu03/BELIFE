<?php $this->load->view('Templates/header'); ?>
<?php $this->load->view('Templates/navbar'); ?>
<?php $this->load->view('Templates/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class=""><?= $title; ?></h1> 
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-outline-warning btn-sm" href="<?= base_url('Smart_Search'); ?>" role="button"><i class="fas fa-hand-point-left"></i> Kembali</a>  
                </div>
                <div class="col-sm-8">
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
                <div class="col-12">

                    <div class="card">
                    <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-kontrak-tab" data-toggle="pill" href="#pills-kontrak" role="tab" aria-controls="pills-kontrak" aria-selected="true"><i class="fas fa-file-contract"></i> Kontrak Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-personal-tab" data-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="false"><i class="fas fa-id-card"></i> Personal Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-installment-tab" data-toggle="pill" href="#pills-installment" role="tab" aria-controls="pills-installment" aria-selected="false"><i class="fas fa-money-bill"></i> Installment Data</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" id="pills-history-tab" data-toggle="pill" href="#pills-history" role="tab" aria-controls="pills-history" aria-selected="false"><i class="fas fa-history"></i> Kontrak History</a>
                    </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-kontrak" role="tabpanel" aria-labelledby="pills-kontrak-tab">
                     
                    <div class="card">
                    <div class="card-body">

                    <table class="table table-sm">
                    
                    <tbody>
                        <tr>
                            <th scope="row">Kontrak No</th>
                            <td><?= $contract['contract_no'] ?></td>
                            <th scope="row">User Order</th>
                            <td><?= $contract['user_order'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kode Order</th>
                            <td><?= $contract['kode_order'] ?></td>
                            <th scope="row">Date Order</th>
                            <td><?= $contract['date_order'] ?></td>      
                        </tr>
                        <tr>
                            <th scope="row">Tenor</th>
                            <td><?= $contract['tenor'] ?></td>
                            <th scope="row">Total Amout</th>
                            <td><?= $contract['total_amount'] ?></td>      
                        </tr>
                        <tr>
                            <th scope="row">Angsuran</th>
                            <td><?= $contract['angsuran'] ?></td>
                            <th scope="row">Biaya Admin</th>
                            <td><?= $contract['admin_cost'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">Status Kontrak</th>
                            <td><?= $contract['status_contract'] ?></td>
                            <th scope="row">Biaya Pengiriman</th>
                            <td><?= $contract['shipping_cost'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">Fintech</th>
                            <td><?= $contract['fintech_name'] ?></td>
                            <th scope="row">Ekspedisi</th>
                            <td><?= $contract['ekspedisi_name'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">User Approve</th>
                            <td><?= $contract['user_approve'] ?></td>
                            <th scope="row">Date Approve</th>
                            <td><?= $contract['date_approve'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">Kode Shiping</th>
                            <td><?= $contract['kode_shipping'] ?></td>
                            <th scope="row">Status Pengiriman</th>
                            <td><?= $contract['status_pengiriman'] ?></td>      
                        </tr>

                        <tr>
                            <th scope="row">User Shiping</th>
                            <td><?= $contract['user_shipping'] ?></td>
                            <th scope="row">Date Shiping</th>
                            <td><?= $contract['date_shipping'] ?></td>      
                        </tr>
                       
                    </tbody>
                    </table>
                   
                       








                    </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">

                      
                    <div class="card">
                    <div class="card-body">


                    <table class="table table-sm">
                    
                    <tbody>
                        <tr>
                            <th scope="row">Username</th>
                            <td><?= $personaldata['username'] ?></td>
                            <th scope="row">Nama Lengkap</th>
                            <td><?= $personaldata['name_full'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?= $personaldata['email'] ?></td>
                            <th scope="row">NIK KTP</th>
                            <td><?= $personaldata['nik'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Lahir</th>
                            <td><?= $personaldata['tgl_lahir'] ?></td>
                            <th scope="row">Tempat Lahir</th>
                            <td><?= $personaldata['tempat_lahir'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $personaldata['jenis_kelamin'] ?></td>
                            <th scope="row">Provinsi</th>
                            <td><?= $personaldata['nama_provinsi'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kota</th>
                            <td><?= $personaldata['nama_kota_kabupaten'] ?></td>
                            <th scope="row">Alamat KTP</th>
                            <td><?= $personaldata['address_ktp'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Perusahan</th>
                            <td><?= $personaldata['partner_name'] ?></td>
                            <th scope="row">Tanggal Register</th>
                            <td><?= $personaldata['datetime_post'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Limit</th>
                            <td><?= $personaldata['limit_user'] ?></td>
                            
                        </tr>



                        </tbody>
                    </table>

        

                       




                    </div>
                    </div>


                    </div>
                    <div class="tab-pane fade" id="pills-installment" role="tabpanel" aria-labelledby="pills-installment-tab">


                    <div class="card">
                    <div class="card-body">

                    <table id="tbinstallmentss" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kontrak No</th>
                                        <th>Installment No</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Angsuran</th>
                                        <th>Is Payment</th>
                                        <th>Tanggal Payment</th>
                                        <th>Tanggal Posting</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($installment_data as $p) : ?>
                                        <tr>


                                            <td class="text-left" style="vertical-align:middle"><?= $p['contract_no']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['installment_no']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['due_date']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['angsuran']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['is_payment']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['date_payment']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['payment_post_date']; ?></td>

                                          
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>








                    </div>
                    </div>



                    </div>
                    <!-- <div class="tab-pane fade" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">


                                <div class="card">
                                <div class="card-body">



                                history





                                </div>
                                </div>


                    </div> -->
                    </div>


                    </div>
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->









<?php $this->load->view('Templates/footer'); ?>