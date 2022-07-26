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
                        <li class="breadcrumb-item active">
                            Update Data
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Update Data</h3>
                        </div>
                        <form action="<?= base_url('DataMaster_Product/EditSupplier/' . Encrypt_url($dtSupplier['id'])); ?>" method="POST" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="supplier_name" class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" placeholder="Insert Supplier Name" value="<?= $dtSupplier['supplier_name']; ?>" requied>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class=" col-sm-12 form-control " style="overflow:auto;resize:none" id="alamat" name="alamat" normalizer_normalize="alamat" rows="3" value="<?= set_value('alamat'); ?>"><?= $dtSupplier['alamat']; ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="nama_kontak_supplier" class="col-sm-3 col-form-label">Nama Kontak</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="nama_kontak_supplier" name="nama_kontak_supplier" placeholder="Enter Nama Kontak" value="<?= $dtSupplier['nama_kontak_supplier']; ?>" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="kontak_supplier" class="col-sm-3 col-form-label">Kontak</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="kontak_supplier" name="kontak_supplier" placeholder="Enter Kontak Supplier" value="<?= $dtSupplier['kontak_supplier']; ?>" onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="bank_supplier" class="col-sm-3 col-form-label">Bank Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="bank_supplier" value="<?= $dtSupplier['bank_supplier']; ?>" name="bank_supplier" placeholder="Enter Bank" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="norek_supplier" class="col-sm-3 col-form-label">No Rekening Supplier</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" id="norek_supplier" name="norek_supplier" placeholder="Enter No Rekening" value="<?= $dtSupplier['norek_supplier']; ?>" onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="is_active" class="col-sm-3 col-form-label">Is Active?</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio">
                                            <?php if ($dtSupplier['is_active'] == '1') : ?>
                                                <input class="custom-control-input" type="radio" id="is_active1" name="is_active" value="1" checked>
                                            <?php else : ?>
                                                <input class="custom-control-input" type="radio" id="is_active1" name="is_active" value="1">
                                            <?php endif; ?>
                                            <label for="is_active1" class="custom-control-label">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <?php if ($dtSupplier['is_active'] == '0') : ?>
                                                <input class="custom-control-input" type="radio" id="is_active2" name="is_active" value="0" checked>
                                            <?php else : ?>
                                                <input class="custom-control-input" type="radio" id="is_active2" name="is_active" value="0">
                                            <?php endif; ?>
                                            <label for="is_active2" class="custom-control-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('DataMaster_Product/Supplier'); ?>'" class="btn btn-sm btn-default">Cancel</a>
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

<?php $this->load->view('Templates/footer'); ?>