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
                        <li class="breadcrumb-item active">
                            Update Data
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
    <?= $this->session->flashdata('message'); ?>
                    <?= form_error('title', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('product_name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('kategori', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <?= form_error('harga', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <?= form_error('status', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                   
        <div class="container-fluid">
            <div class="row">
        

                <div class="col-8">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Update Data</h3>
                        </div>
                        <form action="<?= base_url('Product/EditProduct/' . Encrypt_url($product['kode_product'])); ?>" method="POST"  enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Title Product</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter Title Product "   value="<?= $product['title_product']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" placeholder="Enter Product Name" value="<?= $product['nama_product']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                    <div class="col-sm-9">
                                    <textarea class=" col-sm-12 form-control " style="overflow:auto;resize:none" id="deskripsi"  name="deskripsi" normalizer_normalize="deskripsi" rows="3"    value="<?= $product['description']; ?>"><?= $product['description']; ?></textarea>
                                
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kategori" class="col-sm-3 col-form-label">Kategori Product</label>
                                    <div class="col-sm-9">
                                    <select name="kategori" id="kategori" class="form-control">  
                                                    <option value="" hidden>Select Kategori</option> 

                                                    <?php foreach($kategoriproduct as $r) :   ?>
                                                        <?php if (strtolower($r['id']) === strtolower($product['id_category_product'])) : ?>
                                                        <option value="<?= $r['id']; ?>" selected="selected">
                                                        <?= $r['category_name'];  ?>
                                                        </option> 
                                                        <?php else : ?>

                                                            <option value="<?= $r['id']; ?>" >     <?= $r['category_name'];  ?>  </option> 
                                                            <?php endif; ?>
                                                    <?php endforeach;   ?> 
                                                </select>     
                                                

                                            
                                                
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="hargaproductbeli" class="col-sm-3 col-form-label">Harga Beli</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" id="hargaproductbeli" name="hargaproductbeli"  onkeypress="return hanyaAngka(event)" value="<?= $product['price_buy']; ?>" required>
                                </div>
                            </div>

                    
                                <div class="form-group row">
                                    <label for="hargaproduct" class="col-sm-3 col-form-label">Harga Jual</label>
                                    <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" id="hargaproduct" name="hargaproduct"  onkeypress="return hanyaAngka(event)"   value="<?= $product['price_sell']; ?>" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                                    <div class="col-sm-9">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                    <div class="custom-control custom-radio">
                                         <?php if ($product['is_diskon'] == '1') : ?>
                                        <input class="custom-control-input" type="radio" id="diskon1" name="diskon" value="1" checked>
                                        <?php else : ?>
                                            <input class="custom-control-input" type="radio" id="diskon1" name="diskon" value="1">
                                            <?php endif; ?>
                                        <label for="diskon1" class="custom-control-label">Yes</label>


                                      
                                    </div>

                                    </div>
                                    <div class="col-sm-4">
                                    <div class="custom-control custom-radio">
                                      <?php if ($product['is_diskon'] == '0') : ?>
                                        <input class="custom-control-input" type="radio" id="diskon2" name="diskon" value="0" checked>
                                        <?php else : ?>
                                            <input class="custom-control-input" type="radio" id="diskon2" name="diskon" value="0">
                                            <?php endif; ?>
                                        <label for="diskon2" class="custom-control-label">No</label>
                                    </div>


                                    </div>

                                    </div>
                                    
                                    


                                    </div>
                                </div>

         
                                <div class="form-group row " id="diskon_label" style="display: <?php  if ($product['is_diskon'] == '0') {echo "none";}?>
                                " >
                                    <label for="diskon_value" class="col-sm-3 col-form-label" >Diskon Value</label>
                                    <div class="col-sm-4">
                                    <select name="diskon_value" id="diskon_value" class="form-control">  
                                                    <option value="" hidden>Select Diskon</option> 

                                                    <?php foreach($diskon as $r) :   ?>
                                                        <?php if (strtolower($r['id']) === strtolower($product['diskon_id'])) : ?>
                                                        <option value="<?= $r['id']; ?>" selected="selected"> <?= $r['description'];  ?></option> 
                                                        <?php else : ?>
                                                            <option value="<?= $r['id']; ?>" >     <?= $r['description'];  ?>  </option> 
                                                            <?php endif; ?>
                                                    <?php endforeach;   ?> 
                                                </select>      
                                    </div>
                                </div>


                                
                              


                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-4">
                                    <select name="status" class="form-control"  name= "status" id="status" >
                                    <option value="" hidden>Select Status</option> 
                                        <option value="in stock" <?php if($product['status']=='in stock') echo 'selected'?>>in stock</option>
                                        <option value="out stock"  <?php if($product['status']=='out stock') echo 'selected'?>>out stock</option>
                                    </select>
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="qty" class="col-sm-3 col-form-label">Qty</label>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" id="qty" name="qty"  onkeypress="return hanyaAngka(event)"  value="<?= $product['qty']; ?>" required>
                                    </div>
                                </div>



                                <div class="form-group row">
                                                <label for="image_product" class="col-sm-3 col-form-label">Gambar Product</label>
                                                <div class="col-sm-9">
                                    
                                                        <div class="row">
                                                                    <div class="col-sm-3">
                                                                    
                                                                    <img src="<?= base_url('assets/img/product/default.png');?>" class="img-thumbnail" >
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    
                                                                    <label for="image_product">Gambar Product</label>
                                                                        <input type="file" class="form-control-file" id="image_product"  size="60" name="image_product"  ><br>
                                                                        <p class="help-block text-danger">*Format file 'jpg,jpeg,png', maksimal ukuran file 512kb</p>



                                                                    </div>
                                                            
                                                            </div>
                                                    
                                                    </div>
                                    
                                </div>
                                        








                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('Product/DataProduct'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-info float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer'); ?>