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
                   
                            <div class="card card-solid">
                                        <div class="card-body">


                                        <div class="row">
                                          <div class="col-7">

                                          <div class="row">
                                          <div class="col-12">

                                                 <div class="card card-info">
                                                <div class="card-header">
                                                <h3 class="card-title"><b>Form Upload Billing Customer</b></h3>

                                                </div>

                                                <div class="card-body">

                                                                                          
                                                   <form action="<?= base_url('Finance/BillingUpload'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                    <div class="col-sm-8">
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="billing" name="billing"   value="<?= set_value('billing'); ?>"  required>
                                                        <label class="custom-file-label" for="billing">Choose file</label>
                                                        </div>
                                                    
                                                    </div>
                                                    <div class="col-sm-4">
                                                         <button type="submit" class="btn btn-primary" >
                                                         <i class="fas fa-upload"></i>  Upload
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

                                                <div class="card card-secondary">
                                                <div class="card-header">
                                                <h3 class="card-title"><b>Top 5 Last Upload</b></h3>

                                                </div>

                                                <div class="card-body">
                                                <div class="card-body table-responsive pad">
                                                <table  id="tblistfileuploadbill" class="table table-bordered table-bordered text-nowrap mb-3" data-searching="false" data-info="false"  style="font-size: 11px;" >
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Nama File</th>
                                                            <th>User Upload</th>
                                                            <th>Date Upload</th>
                                                            <th>Posting</th>
                                                            <th>User Posting</th>
                                                            <th>Date Posting</th>
                                                       
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  foreach ($listfileuplaod as $lu) : ?>
                                                            <tr >
                                                            
                                                                <td  class="text-center" style="vertical-align:middle" >
                                                                <?= $lu['nama_file']; ?>
                                                                </td>
                                                                <td  class="text-center" style="vertical-align:middle" >
                                                                <?= $lu['user_upload']; ?>
                                                                </td>
                                                                <td  class="text-center" style="vertical-align:middle" >
                                                                <?= $lu['date_upload']; ?>
                                                                </td>
                                                                <td  class="text-center" style="vertical-align:middle" >
                                                                <?= $lu['is_posting']; ?>
                                                                </td>
                                                                <td  class="text-center" style="vertical-align:middle" >
                                                                <?= $lu['user_posting']; ?>
                                                                </td>
                                                                <td  class="text-center" style="vertical-align:middle" >
                                                                <?= $lu['date_posting']; ?>
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

                                          <div class="col-5">
                                             <div class="card card-success">
                                                <div class="card-header">
                                                <h3 class="card-title"><b>Summary Upload</b></h3>

                                                </div>

                                                <div class="card-body">



                                            
                                                <?php if ($checkposting == 1) : ?>


                                                <div class="form-group row">
                                                    <label for="kodepodo" class="col-sm-5 col-form-label">File Upload</label>
                                                    <label for="kodepodo" class="col-sm-5 col-form-label"> <?= $dataunposting['nama_file']; ?></label>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="kodepodo" class="col-sm-5 col-form-label">Jumlah Row Upload</label>
                                                    <label for="kodepodo" class="col-sm-5 col-form-label"><?= $dataunposting['countdata']; ?> Contract</label>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="kodepodo" class="col-sm-5 col-form-label">Jumlah Amount (Rp)</label>
                                                    <label for="kodepodo" class="col-sm-5 col-form-label"><?= number_format($dataunposting['amount'],0 ,',','.'); ?></label>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="kodepodo" class="col-sm-5 col-form-label">User Upload</label>
                                                    <label for="kodepodo" class="col-sm-5 col-form-label"><?= $dataunposting['user_upload']; ?></label>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="kodepodo" class="col-sm-5 col-form-label">Tanggal Upload</label>
                                                    <label for="kodepodo" class="col-sm-5 col-form-label"><?= $dataunposting['date_upload']; ?></label>
                                                </div>



                                                <div class="form-group row">
                                                    <div class="col-sm-6 text-center">
                                                    <a  href="javascript:void(0)" onclick="location.href='<?= base_url('Finance/PostingBillingUpload'); ?>'"
                                                      class="btn  btn-sm btn-warning  btn-block text-center"    ><i class="fas fa-check-double"></i> Posting Billing</a>
                                                    </div>
                                                    <div class="col-sm-6 text-center">
                                                    
                                                        <a  href="javascript:void(0)" 
                                                        onclick="location.href='<?= base_url('Finance/ResetBillingUpload'); ?>'"
                                                        class="btn  btn-sm btn-danger  btn-block text-center"    ><i class="fas fa-trash-restore-alt"></i> Reset Data Upload</a>
                                    
                                                    </div>
                                                </div>


                                                <?php endif; ?>   

                                             

                                                </div>

                                              
                                                </div>
                                    


                                          

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










<?php $this->load->view('templates/footer'); ?>