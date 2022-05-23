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


                              <table  id="tblistpodoreqapv" class="table table-bordered" >
                                <thead class="text-center">
                                    <tr>
                                        <th>Kode PO DO</th>                                    
                                        <th>Nominal (Rp)</th>
                                        <th>Count</th>
                                        <th>Tipe Request</th>
                                        <th>User Request</th>
                                        <th>Date Request</th>
                                         <th>Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach ($listreqapv as $lr) : ?>
                                        <tr >
                                        <td  class="text-center" style="vertical-align:middle" >
                                        <?= $lr['kode_po_do']; ?>
                                         </td>
                                         <td  class="text-center" style="vertical-align:middle" >
                                         <?=  number_format($lr['total_req'],0 ,',','.'); ?>
                                        </td>
                                        <td  class="text-center" style="vertical-align:middle" >
                                        <?= $lr['count_detail']; ?>
                                        </td>
                                        <td  class="text-center" style="vertical-align:middle" >
                                        <?= $lr['Description']; ?>
                                        </td>
                                        <td  class="text-center" style="vertical-align:middle" >
                                        <?= $lr['user_request']; ?>
                                        </td>
                                        <td  class="text-center" style="vertical-align:middle" >
                                        <?= $lr['date_request']; ?>
                                        </td>
                                        <td  class="text-center" style="vertical-align:middle" >
                                        <a href="javascript:void(0)"  onclick="location.href='<?= base_url('BOD/PoDoReq_Review/' . Encrypt_url($lr['kode_po_do'])); ?>'" class="btn  btn-sm btn-warning float-center"  >
                                        
                                          <i class="fas fa-eye"></i> Review</a>
                                        
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









<?php $this->load->view('templates/footer'); ?>