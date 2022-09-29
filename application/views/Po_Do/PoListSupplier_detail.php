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
          <div class="invoice p-3 mb-3" style="background-color: #d7e4f2;">
            <!-- title row -->
            <div class="row align-items-center">
              <div class="col-12">
                <form name="detailshipping" amethod="POST">
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
     
                <div class="col-sm-4 invoice-col">
                  Kode Purchase Order
                  <address>
                    <strong><?= $podetailsup['kode_po_do']; ?></strong><br>

                  </address>
                 
                </div>

                <div class="col-sm-4 invoice-col">
                
   
                  Total Amount
                  <address>
                    <strong>Rp. <?= number_format($podetailsup['total_req'], 0, ',', '.'); ?></strong><br>

                  </address>
                </div>

                <div class="col-sm-4 invoice-col">
                
                Tangal Approve
                  <address>
                    <strong><?= $podetailsup['date_approve']; ?></strong><br>

                  </address>
              </div>
             
              
            
            </div>
            <!-- /.row -->

            <!-- Table row -->


            <div class="row">
            <strong>Detail Purchase Order</strong>
              <div class="col-12 table-responsive">
                <table class="table table-hover   text-nowrap">
                  <thead>
                    <tr>
                      <th>Supplier Name</th>
                      
                      <th>Nama Kontak</th>
                      <th>Kontak</th>
                      <th>Price</th>
                      <th>Alamat</th>
                      <th class="text-center">Bank</th>
                      <th class="text-center">No Rekening</th>
              
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($podetailsup2 as $s) : ?>
                      <tr>
                        <td><?= $s['supplier_name']; ?></td>
                        <td><?= $s['nama_kontak_supplier']; ?></td>
                        <td><?= $s['kontak_supplier']; ?></td>
                        <td>Rp. <?= number_format($s['price'], 0, ',', '.'); ?></td>
                        <td><?= $s['alamat']; ?></td>
                        <td class="text-center"><?= $s['bank_supplier']; ?></td>
                        <td class="text-center"><?= $s['norek_supplier']; ?></td>
                      </tr>

                    <?php endforeach; ?>
                   

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

                  <a class="btn btn-success float-right mr-2" href="javascript:void(0)" onclick="location.href='<?= base_url('PurchaseOrder_DeliveryOrder/PoSupDetailDone'); ?>/<?= $podetailsup['kode_po_do']; ?>' "><i class="fas fa-check-square"></i> Done</a>
                  <a class="btn btn-primary float-right mr-2" href="<?= base_url('PurchaseOrder_DeliveryOrder/GeneratePDFPOSup'); ?>/<?= $podetailsup['kode_po_do']; ?>" target="_blank"><i class="fas fa-download"></i> Generate PDF</a>

                 

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