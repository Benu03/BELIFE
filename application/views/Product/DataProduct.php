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





                    <?= $this->session->flashdata('message'); ?>
                    <?= form_error('title', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('product_name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('kategori', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <?= form_error('harga', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <?= form_error('status', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <?= form_error('image_product', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-file-alt mr-1"></i>
                                List Data
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-data">
                                            <i class="fas fa-plus-circle"></i>
                                            Add Data
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body table-responsive pad">
                            <table id="tbproduct" class="table table-bordered table-striped table-sm">
                                <thead class="text-center">
                                    <tr>
                                        <th>Image</th>
                                        <th>Nama Product</th>
                                        <th>Kategori Product</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Belife</th>
                                        <th>Harga Jual</th>
                                        <th>Status</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($product as $p) : ?>
                                        <tr>

                                            <td width="80px" class="text-center">

                                                <img src="<?= base_url('assets/img/product/') . $p['image_product']; ?>" class="img-thumbnail">
                                            </td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['nama_product']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['category_name']; ?></td>
                                            <td class="text-left" style="vertical-align:middle">Rp. <?= number_format($p['price_buy'], 0, ',', '.'); ?></td>
                                            <td class="text-left" style="vertical-align:middle">Rp. <?= number_format($p['price_belife'], 0, ',', '.'); ?></td>
                                            <td class="text-left" style="vertical-align:middle">Rp. <?= number_format($p['price_sell'], 0, ',', '.'); ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['status']; ?></td>
                                            <td class="text-left" style="vertical-align:middle"><?= $p['qty']; ?></td>




                                            <td width="80px" class="text-center" style="vertical-align:middle">
                                                <div class="btn-group-vertical">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="location.href='<?= base_url('Product/Updateproduct/' . Encrypt_url($p['kode_product'])); ?>'">Update</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="confDelete('<?= base_url('Product/DeleteProduct/' . Encrypt_url($p['kode_product'])); ?>')">Delete</a></li>


                                                        </ul>
                                                    </div>
                                                </div>
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


<!-- MODAL ADD DATA -->
<div class="modal fade" id="modal-add-data">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?= base_url('Product/AddProduct'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Title Product</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter Title Product " required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="product_name" class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" placeholder="Enter Product Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class=" col-sm-12 form-control " style="overflow:auto;resize:none" id="deskripsi" name="deskripsi" normalizer_normalize="deskripsi" rows="3" value="<?= set_value('deskripsi'); ?>"></textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori Product</label>
                        <div class="col-sm-9">
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="" hidden>Select Kategori</option>

                                <?php foreach ($kategoriproduct as $r) :   ?>
                                    <option value="<?= $r['id']; ?>"> <?= $r['category_name'];  ?></option>
                                <?php endforeach;   ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hargaproductbeli" class="col-sm-3 col-form-label">Harga Beli</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" id="hargaproductbeli" name="hargaproductbeli" onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <label for="rateproductbeli" class="col-sm-2 col-form-label">Rate Beli %</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control form-control-sm" id="rateproductbeli" name="rateproductbeli" onkeypress="return hanyaAngka(event)" onkeyup="harga_belife()" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="hargaproductbelife" class="col-sm-3 col-form-label">Harga Belife</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" id="hargaproductbelife" name="hargaproductbelife" onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <label for="rateproductbelife" class="col-sm-2 col-form-label">Rate Belife %</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control form-control-sm" id="rateproductbelife" name="rateproductbelife" onkeypress="return hanyaAngka(event)"  onkeyup="harga_jual()" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="hargaproduct" class="col-sm-3 col-form-label">Harga Jual</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" id="hargaproduct" name="hargaproduct" onkeypress="return hanyaAngka(event)" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm-9">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="diskon1" name="diskon" value="1">
                                        <label for="diskon1" class="custom-control-label">Yes</label>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="diskon2" name="diskon" value="0">
                                        <label for="diskon2" class="custom-control-label">No</label>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="form-group row " id="diskon_label" style="display: none">
                        <label for="diskon_value" class="col-sm-3 col-form-label">Diskon Value</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="diskon_value" name="diskon_value" onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <label for="diskon_value" class="col-sm-2 col-form-label">Date Expired</label>
                        <div class="col-sm-2">
                            <input type="dateexpired_diskon" class="form-control" placeholder="(YYYY-MM-DD)" id="dateexpired_diskon" name="dateexpired_diskon" value="<?= set_value('dateexpired_diskon'); ?>"  />
                            </div>
                    </div>



                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <select name="status" class="form-control" name="status" id="status">
                                <option value="" hidden>Select Status</option>
                                <option value="in stock">in stock</option>
                                <option value="out stock">out stock</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="qty" name="qty" onkeypress="return hanyaAngka(event)" required>
                        </div>
                    </div>




                    <div class="form-group row">
                        <label for="image_product" class="col-sm-3 col-form-label">Gambar Product</label>
                        <div class="col-sm-9">

                            <div class="row">
                                <div class="col-sm-3">

                                    <img src="<?= base_url('assets/img/product/default.png'); ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-6">

                                    <label for="image_product">Gambar Product</label>
                                    <input type="file" class="form-control-file" id="image_product" name="image_product" required><br>
                                    <p class="help-block text-danger">*Format file 'jpg,jpeg,png', maksimal ukuran file 512kb</p>



                                </div>

                            </div>

                        </div>

                    </div>





                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<?php $this->load->view('Templates/footer'); ?>