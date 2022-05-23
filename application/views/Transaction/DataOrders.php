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
            <div class="row">
                <div class="col-12">
                   

                        
                <?= $this->session->flashdata('message'); ?>
                 
                 <div class="card-header">
                     <h3 class="card-title">
                         <i class="far fa-file-alt mr-1"></i>
                         List Data Orders
                     </h3>
               
                 </div>
                 <div class="card-body table-responsive pad">
                     <table id="tborserscus" class="table table-bordered table-striped">
                         <thead class="text-center">
                             <tr>
                                 <th>No</th>
                                 <th>Kode Order</th>
                                 <th>Tanggal Order</th>
                                 <th>Nama User</th>
                                 <th>Kontak User</th>
                                 <th>Total Transaksi</th>
                                 <th>Tenor</th>
                                 <th>Angsuran</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1; ?>
                             <?php foreach ($Dataorders as $s) : ?>
                                 <tr>
                                     <td width="25px" class="text-center"><?= $i++; ?></td>
                                     <td width="150px"><?= $s['kode_order']; ?></td>
                                         <td width="100px" class="text-center">
                                     <?= $s['date_order']; ?>
                                     </td>
                                     <td width="100px" c>
                                     <?= $s['name_full']; ?>
                                     </td>
                                     <td width="50px" class="text-center">
                                     <?= $s['phone']; ?>
                                     </td>
                                     <td width="100px" class="text-center">
                                     Rp. <?= number_format($s['total_order'],0 ,',','.'); ?>
                                     </td>
                                     <td width="50px" class="text-center">
                                     <?= $s['tenor']; ?>
                                     </td>
                                     <td width="50px" class="text-center">
                                     Rp. <?= number_format($s['angsuran'],0 ,',','.'); ?>
                                     </td>


                                     
                                     <td width="120px" class="text-center">
                                     <a class="btn btn-sm bg-warning"   href="javascript:void(0)" onclick="location.href='<?= base_url('Transaction/DetailOrder'); ?>/<?= $s['kode_order']; ?>' "><i class="fas fa-inbox"></i> Detail Orders</a> 

                                   
                                     </td>
                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
</div>
<!-- /.content-wrapper -->




                
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer'); ?>