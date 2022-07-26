
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
                <div class="col-12">
                   

                <?php   foreach ($dataproduct as $dt) : ?>

                        <!-- Default box -->
              <div class="card card-solid">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-sm-4">
                    
                      <div class="col-12 img-hover-zoom text-center">
                        <img src="<?= base_url('assets/img/product/') ?><?= $dt['image_product']; ?>" class="product-image" alt="Product Image" style="max-width:80%;">
                      </div>

                     
                    
                    </div>
                    <div class="col-12 col-sm-8">
                    <h3 class="my-3"><?= $dt['title_product']; ?></h3>
                      <p><?= $dt['nama_product']; ?></p>
                      <hr>
                                        
                      <h4>Spesification</h4>
                      <div class="btn-group btn-group-toggle rounded" data-toggle="buttons">
                        
                      <?= $dt['description']; ?>
                      </div>
                      <hr>
                      <h5>Status : <?= $dt['status']; ?> (<?= $dt['qty']; ?>)</h5>

                     
                    
                    

                      <div class="bg-gray py-2 px-3 mt-4 rounded-lg">
                        <h2 class="mb-0">
                        Rp. <?= number_format($dt['price_sell'],0 ,',','.'); ?>
                    
                        </h2>
                       
                      </div>

                      <div class="mt-4">

                  
                        <div class="btn btn-primary btn-sm btn-flat rounded-sm">
                        <a href="<?= base_url('DashboardUser/AddBucketProduct/') ?><?= $dt['kode_product']; ?>" class="btn btn-sm btn-primary rounded-sm mr-2">
                        <i class="fas fa-cart-plus"></i> Tambah Item </a>
                        </div> 

                        <div class="btn btn-success btn-sm btn-flat rounded-sm">
                        <a href="<?= base_url('Feature/Keranjang') ?>" class="btn btn-sm btn-success rounded-sm">
                              <i class="fas fa-city"></i> Kembali Ke Keranjang</a>
                      </div>


               
                

                      </div>
                            </div>
                           

                            <?php endforeach; ?>


                           



                            </div>
                    <!-- /.card-body -->

                 
                </div>
                </div>

              

                
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>