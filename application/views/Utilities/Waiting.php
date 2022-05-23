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
                         List Data Shipping
                     </h3>
               
                 </div>
                 <div class="card-body table-responsive pad">
                     <table id="tbWT" class="table table-bordered table-striped">
                         <thead class="text-center">
                             <tr>
                                 <th>No</th>
                                 <th>Kode Pengiriman</th>
                                 
                                 <th>Tanggal Order</th>
                               
                                 <th>Nama Penerima</th>
                                 <th>Kontak Penerima</th>
                                 <th>Status</th>
                               
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1; ?>
                             <?php foreach ($waiting as $s) : ?>
                                 <tr>
                                     <td width="30px" class="text-center"><?= $i++; ?></td>
                                     <td width="150px"><?= $s['kode_shipping']; ?></td>
                                         <td width="100px" class="text-center">
                                     <?= $s['date_order']; ?>
                                     </td>
                                  
                                     <td width="150px" class="text-center">
                                     <?= $s['nama_penerima']; ?>
                                     </td>
                                     <td width="100px" class="text-center">
                                     <?= $s['kontak_penerima']; ?>
                                     </td>
                                     <td width="100px" class="text-center">
                                     <?= $s['status_pengiriman']; ?>
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