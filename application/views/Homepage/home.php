<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">

      <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

      <div class="row mb-2">
        <div class="col-md-12">
          <section class="content mb-2">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-interval="2000">
                  <img class="img-fluid d-block w-100 rounded mx-auto d-block" src="<?= base_url('assets/img/general/') ?><?= $banner1['file_upload']; ?>" alt="First slide">

                </div>
                <div class="carousel-item" data-interval="2000">
                  <img class="img-fluid d-block w-100 rounded mx-auto d-block" src="<?= base_url('assets/img/general/') ?><?= $banner2['file_upload']; ?>" alt="Second slide">

                </div>
                <div class="carousel-item" data-interval="2000">
                  <img class="img-fluid d-block w-100 rounded mx-auto d-block" src="<?= base_url('assets/img/general/') ?><?= $banner3['file_upload']; ?>" alt="Third slide">

                </div>
              </div>


              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

          </section>


        </div>
      </div>

  

    <section>
    <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h4><strong> Featured Products </strong></h4>
                     <hr style="background-color: #fc7c19; height: 3px; border: 0;">
                  </div>
               </div>
            </div>
            <div class="row">
            <?php foreach ($product as $p) : ?>

              <div class="col-6 col-sm-4 col-md-3 d-flex align-items-stretch flex-column">
              <div class="card  d-flex flex-fill">
         
                <div class="card-body">
                  <div class="row">
                   
                    <div class="col-12 ">
                      <div class="img-hover-zoom card-img-top text-center">
                        <a href="<?= base_url('Feature/DetailProduct/') ?><?= $p['kode_product']; ?>">
                          <img src="<?= base_url('assets/img/product/') ?><?= $p['image_product']; ?>" class="img-square img-fluid mb-2" style="height:150px;max-width:100%;">
                        
                        </a>
                        <strong>
                        <p class="card-title text-dark" ><?= $p['title_product']; ?></p>
                        </strong>
                      </div>
                    </div>

                  </div>
                </div>
       
              </div>
            </div>

              <?php endforeach; ?>
            </div>
      </div>
      
    </section>

    <section>
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h3><strong> Solusi Barang Impian Anda</strong></h3>
                  </div>
               </div>
            </div>


            <div class="row">
               <div class="col-sm-6">
												<div class="card-body">
													<h5 class="card-title"> </h5>
												</div>
                        <a href="">
												<img  class="img-fluid d-block w-100 rounded mx-auto d-block" src="<?= base_url('assets/auth_assets/images/1.png'); ?>" style="">
                        </a>
										  </div>

               <div class="col-sm-6">
                    <div class="card-body">
													<h5 class="card-title"> </h5>
												</div>
                        <a href="">
												<img  class="img-fluid d-block w-100 rounded mx-auto d-block" src="<?= base_url('assets/auth_assets/images/2.png'); ?>" style="">

                        </a>
										  </div>
             

               </div>
            </div>

    </section>







</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->