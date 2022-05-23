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
                   

                <div class="card card-success card-outline">
                        
                        <div class="card-body table-responsive pad">

                        <?= form_open_multipart('Report/GenerateReporttransaction');?>
                        <div class="row">
                         <div class="col-4">
                       
                      
                         <input type="startdate" class="form-control" placeholder="Start Date (YYYY-MM-DD)"  id="startdate" name="startdate"   value="<?= set_value('startdate'); ?>"   required  />
                        </div>

                         <div class="col-4">
                         <input type="enddate" class="form-control" placeholder="End Date (YYYY-MM-DD)"  id="enddate" name="enddate"   value="<?= set_value('enddate'); ?>"   required  />
                      

                        </div>

                        <div class="col-4 text-center">

                        <button type="submit" class="btn btn-sm btn-primary" >
                        <i class="far fa-file-excel"></i>   Generate Data
                                            </button>
                                   
                        </div>
                      </div>
                      </form>



                        </div>



                        </div>







                
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                   

                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-file-alt mr-1"></i>
                            
                            </h3>
                           
                        </div>
                        <div class="card-body table-responsive pad">
                    
                            <table id="tbrpttran" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kode Order</th>
                                        <th>Total Order</th>
                                        <th>Tenor</th>
                                        <th>Angsuran</th>
                                        <th>Status</th>
                                        <th>Fintech</th>
                                        <th>User Order</th>
                                        <th>Tanggal Order</th>
                                       
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    <?php foreach ($transaksi as $p) : ?>
                                        <tr>
                                           
                                        <td class="text-left" style="vertical-align:middle"><?= $p['kode_order']; ?></td>
                                        <td class="text-left" style="vertical-align:middle">Rp. <?= number_format($p['total_order'],0 ,',','.'); ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['tenor']; ?></td>
                                        <td class="text-left" style="vertical-align:middle">Rp. <?= number_format($p['angsuran'],0 ,',','.'); ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['status_order']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['fintech_name']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['user_order']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['date_order']; ?></td>
                                     

                                    
                                          
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