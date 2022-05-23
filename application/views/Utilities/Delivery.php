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
                   

                         <div class="card card-solid">
                         <div class="card-body">
             
                         <?= $this->session->flashdata('message'); ?>
                 
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-file-alt mr-1"></i>
                                    List Data Delivery
                                </h3>
                        
                            </div>
                 <div class="card-body table-responsive pad">
                     <table id="tbpickup" class="table table-bordered table-striped">
                         <thead class="text-center">
                             <tr>
                                 <th>No</th>
                                 <th>Kode Pengiriman</th>
                                 
                                 <th>User Pengiriman</th>
                                 <th>Tanggal Pengiriman</th>
                                 <th>Nama Penerima</th>
                                 <th>Kontak Penerima</th>
                                 <th>Status</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1; ?>
                             <?php foreach ($delivery as $s) : ?>
                                 <tr>
                                     <td width="30px" class="text-center"><?= $i++; ?></td>
                                     <td width="150px"><?= $s['kode_shipping']; ?></td>

                                     <td width="100px" class="text-center">
                                       <?= $s['user_pengiriman']; ?>
                                     </td>
                                         <td width="100px" class="text-center">
                                       <?= $s['date_pengiriman']; ?>
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


                                     
                                     <td width="120px" class="text-center">
                                     <div class="btn-group-vertical">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a class="dropdown-item"  data-toggle="modal" data-target="#modal-add-data<?= $s['kode_shipping']; ?>">Done</a></li>

                                                         
                                                         
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="location.href='<?= base_url('Utilities/DeliveryCancel/' . ($s['kode_shipping'])); ?>'" >Cancel</a></li>
                                                           
                                                        </ul>
                                                    </div>
                                                </div>

                                   
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
</div>
</div>
<!-- /.content-wrapper -->



                
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->








<?php foreach ($delivery as $s) : ?>

<div class="modal fade" id="modal-add-data<?= $s['kode_shipping']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Utilities/DeliveryDone'); ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan No Resi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_resi">No Resi</label>
                        <input type="text" class="form-control form-control-sm" id="no_resi" name="no_resi" placeholder="Enter No Resi" required>
                        <input type="hidden" class="form-control" id="kode_shipping" name="kode_shipping"  value="<?=  $s['kode_shipping']; ?>"  >
                    </div>
                   
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<?php endforeach; ?>



<?php $this->load->view('templates/footer'); ?>