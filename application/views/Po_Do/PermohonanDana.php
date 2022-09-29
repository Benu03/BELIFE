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
      <form name="orderscustomerpodo" id="orderscustomerpodo" action="<?= base_url('PurchaseOrder_DeliveryOrder/PostPoDo_1'); ?>" method="POST">
        <div class="row">
          <div class="col-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card card-solid">
              <div class="card-body">

                <div class="row ">
                  <div class="col-4">


                    <div class="card card-solid">
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="kodepodo" class="col-sm-5 col-form-label">Kode PO & DO</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="kodepodo" name="kodepodo" placeholder="Insert Title" value="<?= $kode_podo; ?>" readonly>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="totalreqpodo" class="col-sm-5 col-form-label">Total Request (Rp)</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="totalreqpodo" name="totalreqpodo" value=" <?= number_format($sumpodoadd['price'], 0, ',', '.'); ?>" readonly>
                            <input type="text" class="form-control form-control-sm" id="totalreqpodo2" name="totalreqpodo2" value=" <?= $sumpodoadd['price']; ?>" hidden>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="countoderpodo" class="col-sm-5 col-form-label">Jumlah Detail</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm text-center" id="countoderpodo" name="countoderpodo" value="<?= $countoderpodo; ?>" readonly>
                          </div>
                        </div>

                        <button type="button" class="btn  btn-sm btn-primary float-right" data-toggle="modal" data-target="#listpodowaiting"><i class="fas fa-check-double"></i> Add Data</button>



                      </div>
                    </div>
                  </div>

                  <div class="col-8">
                    <div class="card card-solid">
                      <div class="card-body">
                        <div class="card card-info">
                          <div class="card-header">
                            <h3 class="card-title"><b>List PO & DO Request</b></h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>

                          <div class="card-body">


                            <table id="tblistpodo" class="table table-bordered">
                              <thead class="text-center">
                                <tr>
                                  <th>Kode Order</th>

                                  <th>Price</th>
                                  <th>Date Post</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($listadd as $dt) : ?>
                                  <tr>

                                    <td class="text-center" style="vertical-align:middle">
                                      <?= $dt['kode_parent']; ?>
                                    </td>

                                    <td class="text-center" style="vertical-align:middle">
                                      Rp. <?= number_format($dt['price'], 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                      <?= $dt['date_post']; ?>
                                    </td>

                                    <td class="text-center" style="vertical-align:middle">


                                      <a id="delorderspodo" onclick="pododelorder()" href="javascript:void(0)" class="btn  btn-sm btn-danger float-center" data-id="<?= $dt['id']; ?>" data-kode_po_do="<?= $dt['kode_po_do']; ?>">

                                        <i class="far fa-trash-alt"></i> Delete</a>
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









                <button type="submit" class="btn  btn-lg btn-success float-left" id="btn_permohonandana" onclick="return confirm('Apakah Pemohonan Dana Sudah Sesuai ?');"><i class="far fa-credit-card"></i> Request Permohonan Dana
                </button>
      </form>





    </div>
  </div>




</div>
</div>
</div>
</div>
</div>
<!-- /.content-wrapper -->





<!-- Modal -->
<div class="modal fade" id="listpodowaiting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listpodowaiting">List Order Waiting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="content">
          <div class="container-fluid">
            <div class="card card-solid">
              <div class="card-body">



                <div class="card-body table-responsive pad">
                  <table id="tblistpodo2" class="table table-bordered table-bordered text-nowrap mb-3" data-searching="false" data-info="false">
                    <thead class="text-center">
                      <tr>
                        <th>Kode Order</th>
                        <th>User Order</th>
                        <th>Data Order</th>
                        <th>Total Transaksi</th>
                        <th>Total Modal</th>
                        <th>Pembiayaan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($podolist as $dt) : ?>
                        <tr>

                          <td class="text-center" style="vertical-align:middle">
                            <?= $dt['kode_order']; ?>
                          </td>
                          <td class="text-center" style="vertical-align:middle">
                            <?= $dt['user_order']; ?>
                          </td>
                          <td class="text-center" style="vertical-align:middle">
                            <?= $dt['date_order']; ?>
                          </td>
                          <td class="text-center" style="vertical-align:middle">
                            Rp. <?= number_format($dt['total_amount'], 0, ',', '.'); ?>
                          </td>
                          <td class="text-center" style="vertical-align:middle">
                            Rp. <?= number_format($dt['total_harga_beli'], 0, ',', '.'); ?>
                          </td>
                          <td class="text-center" style="vertical-align:middle">
                            <?= $dt['fintech_name']; ?>
                          </td>
                          <td class="text-center" style="vertical-align:middle">

                            <button id="addorderspodo" onclick="podoaddoder()" class="btn  btn-sm btn-info float-center" data-kode_po_do="<?= $kode_podo; ?>" data-kode_parent="<?= $dt['kode_order']; ?>" data-price="<?= $dt['total_harga_beli']; ?>">

                              <i class="far fa-credit-card"></i> Add</button>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>








































<?php $this->load->view('Templates/footer'); ?>