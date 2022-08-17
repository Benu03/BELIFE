<?php $this->load->view('Templates/header'); ?>
<?php $this->load->view('Templates/navbar'); ?>
<?php $this->load->view('Templates/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

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

        </div>

       

        

        </section>
        <?= $this->session->flashdata('message'); ?>






        <!-- /.box -->
        <section class="content">
            <!-- /.content -->

          

            <div class="row text-center">


                <?php foreach ($product as $p) : ?>


                    <div class="col-6 col-sm-4 col-md-2 d-flex align-items-stretch flex-column">
                        <div class="card  d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                            <b style="font-size: 0.7rem;"> <?= $p['title_product']; ?> </b>
                            </div>
                            <div class="card-body  pt-0">
                                <div class="row">
                                    <div class="col-12 text-center">
                                    
                                        <div class="img-hover-zoom">
                                            <a href="<?= base_url('Feature/DetailProduct/') ?><?= $p['kode_product']; ?>">
                                                <img src="<?= base_url('assets/img/product/') ?><?= $p['image_product']; ?>" class="img-square img-fluid mb-2" style="height:100px;max-width:100%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="text-center">
                               

                            </div>
                            <div class="text-left">

                                <?php if ($p['is_diskon'] == 1 && $p['date_expired_diskon'] >= date("Y-m-d")) : ?>

                                    <!-- harga yang di strip  -->


                                    <b class="text-left text-secondary ml-3" style="font-size: 0.7rem;"><del>Rp. <?= number_format(
                                                                                                    $p['diskon_value'],
                                                                                                    0,
                                                                                                    ',',
                                                                                                    '.'
                                                                                                ); ?> </del></b>

                                    <b class="text-right text-warning ml-3" style="font-size: 0.7rem;">Rp. <?= number_format($p['price_sell'], 0, ',', '.'); ?></b>


                                <?php else: ?>
                                    <b class="text-center text-warning ml-3" style="font-size: 0.7rem;">Rp. <?= number_format($p['price_sell'], 0, ',', '.'); ?></b>

                                <?php endif; ?>


                            </div>
                            <div class="card-footer">

                                <div class="btn-group text-center">
                                    <a href="<?= base_url('DashboardUser/AddBucketProduct/') ?><?= $p['kode_product']; ?>" class="btn btn-xs bg-teal">
                                        <small><i class="fas fa-shopping-basket"></i> Keranjang</small> </a>

                                    <a href="<?= base_url('Feature/DetailProduct/') ?><?= $p['kode_product']; ?>" class="btn btn-xs btn-primary">
                                        <small><i class="fas fa-external-link-square-alt "></i> Detail</small> </a>
                                </div>

                            </div>
                        </div>
                    </div>


                <?php endforeach; ?>


            </div>


    </div>
   
   
</div>

</section>
<section class="content">
<div class="row text-center">
<div class="col-12">
<div class="d-flex justify-content-center">
<?= $this->pagination->create_links(); ?>
</div>
</div>
</div>
</section>

</div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>