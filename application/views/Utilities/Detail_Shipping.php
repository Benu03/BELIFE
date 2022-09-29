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


          <!-- Main content -->
          <div class="invoice p-3 mb-3" style="background-color: #adb5bd;">
            <!-- title row -->
            <div class="row align-items-center">
              <div class="col-12">
                <form name="detailshipping" action="<?= base_url('Utilities/DetailshippingDone'); ?>" method="POST">
                  <img class="img-fluid img-rounded float-left mr-2 mb-2" src="<?= base_url('assets/img/belife-logo-1.png'); ?>" style="height:30px;">
                  <h4>
                    PT Betterlife Jaya indonesia
                    <small class="float-right">Date: <?= date("Y-m-d");  ?></small>
                  </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info mb-2">
              <?php foreach ($detailshipping as $ds) : ?>
                <div class="col-sm-4 invoice-col">
                  Kode Pengiriman
                  <address>
                    <strong><?= $ds['kode_shipping']; ?></strong><br>

                  </address>
                  Kode Order
                  <address>
                    <strong><?= $ds['kode_order']; ?></strong><br>

                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Nama Penerima
                  <address>
                    <strong><?= $ds['nama_penerima']; ?></strong><br>

                  </address>
                  Kontak Penerima
                  <address>
                    <strong><?= $ds['kontak_penerima']; ?></strong><br>

                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Alamat Penerima</b><br>
                  <address>
                    <?= $ds['alamat_pengiriman']; ?><br>

                  </address>
                </div>
                <!-- /.col -->
              <?php endforeach; ?>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-hover   text-nowrap">
                  <thead>
                    <tr>
                      <th>Kode Product</th>
                      <th>Nama Product</th>
                      <th class="text-center">Qty</th>
                      <th class="text-center">Harga</th>
                      <th class="text-center">Tanggal Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($detailshipping_item as $s) : ?>
                      <tr>
                        <td><?= $s['kode_product']; ?></td>
                        <td><?= $s['nama_product']; ?></td>
                        <td class="text-center"><?= $s['qty']; ?></td>
                        <td class="text-center">Rp. <?= number_format($s['price'], 0, ',', '.'); ?></td>
                        <td class="text-center"><?= $s['date_order']; ?></td>
                      </tr>

                    <?php endforeach; ?>
                    <tr>
                      <td colspan="5" class="text-left">
                        <b> Total Harga : Rp. <?= number_format($totalharga['totalharga'], 0, ',', '.'); ?> </b>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->






          </div>
          <!-- /.invoice -->




          <div class="row">
            <div class="col-12">

              <div class="card card-solid">
                <div class="card-body">

                  <a class="btn btn-success float-right mr-2" href="javascript:void(0)" onclick="location.href='<?= base_url('Utilities/ShippingDelivery'); ?>/<?= $detailshipping['0']['kode_shipping']; ?>' "><i class="fas fa-truck-pickup"></i> Delivery</a>
                  <a class="btn btn-primary float-right mr-2" href="<?= base_url('Utilities/GeneratePDFShipping'); ?>/<?= $detailshipping['0']['kode_shipping']; ?>" target="_blank"><i class="fas fa-download"></i> Generate PDF</a>



                </div>
                <!-- /.col -->
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->



          </form>




        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>