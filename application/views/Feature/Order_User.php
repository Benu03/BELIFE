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
        <div class="container-fluid ">
            <div class="row">
                <div class="col-12">




                    <div class="card card-solid">
                        <div class="card-body">




                            <div class="card card-solid">
                                <div class="card-body">

                                    <!-- title row -->
                                    <div class="row align-items-center" style="background-color: #FFBF00;">
                                        <div class="col-sm-6  m-auto" style="margin-top: auto;margin-bottom: auto;">
                                            <form name="orderscustomer" action="<?= base_url('Feature/AddOrder'); ?>" method="POST">
                                                <img class="img-fluid img-rounded float-left mr-2" src="<?= base_url('assets/img/belife-logo-1.png'); ?>" style="height:30px;">
                                                <h5><i> <b>PT Betterlife Jaya indonesia</b></i></h5>

                                        </div>

                                        <div class="col-sm-6  m-auto" style="margin-top: auto;margin-bottom: auto;">
                                            <small class="float-right"> <b> Kode Order : <?= $kode_order; ?> | Date: <?= date('Y-m-d'); ?> </b></small>
                                            <input type="text" class="form-control form-control-sm" id="kode_order" name="kode_order" value="<?= $kode_order; ?>" hidden>

                                        </div>



                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->

                                    <!-- Table row -->
                                    <div class="row">

                                        <div class="col-12 table-responsive">
                                            <table class="table table-hover text-nowrap mb-3">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Nama Product</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Sub-Total</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($datacart as $dt) : ?>
                                                        <tr>
                                                            <td width="120px" class="text-center">

                                                                <img src="<?= base_url('assets/img/product/') . $dt['image_product']; ?>" class="img-thumbnail">


                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle"><?= $dt['nama_product']; ?></td>
                                                            <td class="text-center" style="vertical-align:middle"><?= $dt['qty']; ?></td>
                                                            <td class="text-center" style="vertical-align:middle">Rp. <?= number_format($dt['price'], 0, ',', '.'); ?></td>
                                                            <td class="text-center" style="vertical-align:middle">Rp. <?= number_format($dt['subtotal'], 0, ',', '.'); ?></td>



                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="6" class="text-right">
                                                            <h5> Total Harga : Rp. <b id="totalorders"><?= number_format($totalharga['totalharga'], 0, ',', '.'); ?> </b> </h5>

                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>




                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>

                            <div class="row ">
                                <!-- accepted payments column -->

                                <div class="col-8 ">
                                    <div class="card card-solid">
                                        <div class="card-body">


                                            <div class="form-group row">
                                                <label for="tenor" class="col-sm-4 col-form-label">Pilih Tenor </label>

                                                <div class="col-sm-3">
                                                    <select class="form-control form-control-sm" id="tenor" name="tenor" onchange="kalkulasi()" required>
                                                        <option value="" hidden>Pilih Tenor</option>
                                                        <?php foreach ($tenor as $r) :   ?>
                                                            <option value="<?= $r['tenor']; ?>"> <?= $r['description'];  ?></option>
                                                        <?php endforeach;   ?>
                                                    </select>
                                                    <input type="text" class="form-control form-control-sm" id="totalharga" name="totalharga" value="<?= $totalharga['totalharga']; ?>" hidden>

                                                </div>

                                                <label for="angsuran" class="col-sm-3 col-form-label text-left " id="angsuranshow" name="angsuranshow"> </label>


                                                <a tabindex="0" id="infoangsuran" name="infoangsuran" class="btn btn-sm " role="button" data-toggle="popover" data-trigger="focus" title="Info Angsuran" data-content="
                                      ((Total Transaksi * Bunga) + Total Transaksi)  / Tenor
                                    "> </a>

                                                <input type="text" class="form-control form-control-sm" id="angsuran" name="angsuran" hidden>



                                            </div>

                                            <div class="form-group row">
                                                <label for="nama_penerima" class="col-sm-4 col-form-label">Nama Penerima</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm" id="nama_penerima" name="nama_penerima" placeholder="Insert Title" value="<?= $customeroder['0']['name_full']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-4 col-form-label">Kontak Penerima</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" id="kontak_penerima" name="kontak_penerima" placeholder="Insert Title" value="<?= $customeroder['0']['phone']; ?>" onkeypress="return hanyaAngka(event)" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat" class="col-sm-4 col-form-label">Alamat Pengiriman </label>
                                                <div class="col-sm-6 ">
                                                    <textarea class="form-control" style="resize:none;" id="alamat_pengiriman" name="alamat_pengiriman" rows="3"><?= $customeroder['0']['address_ktp']; ?>
                                  </textarea>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                </div>

                                <div class="col-4 ">
                                    <div class="card card-solid">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="kode_voucher" class="col-sm-4 col-form-label">Kode Voucher</label>
                                                <div class="col-sm-6">



                                                    <input type="text" class="form-control form-control-sm" id="kode_voucher" name="kode_voucher" placeholder="Insert Voucher">



                                                </div>

                                                <div class="col-sm-2">

                                                    <a href="javascript:void(0)" class="btn btn-sm bg-teal" id="btnbvoucherget" name="btnbvoucherget" onclick="voucherget()">
                                                        <i class="fa fa-search"></i>
                                                    </a>

                                                </div>




                                            </div>


                                            <div class="form-group row">
                                                <label for="nominal_voucher" class="col-sm-4 col-form-label"> </label>
                                                <label for="nominal_voucher" class="col-sm-8 col-form-label text-left " id="nominal_voucher" name="nominal_voucher"> </label>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kode_voucher" class="col-sm-4 col-form-label">Biaya Admin</label>

                                                <label for="biayaadmin" class="col-sm-6 col-form-label">Rp. <?= number_format($biayaadmin['value'], 0, ',', '.'); ?></label>


                                            </div>









                                            <div class="form-group row">
                                                <label for="kode_voucher" class="col-sm-5 col-form-label mr-1">Pemberitahuan *</label> <a tabindex="0" class="btn btn-sm " role="button" data-placement="right" data-toggle="popover" data-trigger="focus" title="Pemberitahuan *" data-content="Biaya Admin Di Tagih Bersamaan Pada Angsuran Pertama"> <i class='fas fa-info-circle'> </i> </a>



                                            </div>



                                        </div>
                                    </div>

                                </div>







                                <!-- /.col -->

                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12 ">


                                    <button type="submit" class="btn  btn-sm btn-success float-right" id="btn_prosespesanan" onclick="return confirm('Apakah data Pesanan anda sudah sesuai ?');"><i class="far fa-credit-card"></i> Proses Pesanan
                                    </button>
                                    </form>
                                    <a href="<?= base_url('Feature/Keranjang') ?>" class="btn btn-sm btn-info  float-right mr-3">
                                        <i class="fas fa-cart-arrow-down"></i> Back</a>

                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>











                    </div>
                </div>





            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>