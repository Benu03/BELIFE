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

                    <?= form_error('fintech', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

                    <section class="content">

                        <!-- Default box -->
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">

                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Data Order</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive pad">
                                                <table class="table table-hover text-nowrap">

                                                    <tbody>

                                                        <tr>
                                                            <td>Kode Order</td>
                                                            <td><?= $Dataorders['kode_order']; ?></td>

                                                        <tr>
                                                            <td>User Order</td>
                                                            <td><?= $Dataorders['user_order']; ?></td>

                                                        <tr>
                                                            <td>Date Order</td>
                                                            <td><?= $Dataorders['date_order']; ?></td>

                                                        <tr>
                                                            <td>Tenor</td>
                                                            <td><?= $Dataorders['tenor']; ?></td>

                                                        <tr>
                                                            <td>Angsuran</td>
                                                            <td>Rp. <?= number_format($Dataorders['angsuran'], 0, ',', '.'); ?> </td>

                                                        <tr>
                                                            <td>Nama Penerima</td>
                                                            <td><?= $Dataorders['nama_penerima']; ?></td>

                                                        <tr>
                                                            <td>Kontak Penerima</td>
                                                            <td><?= $Dataorders['kontak_penerima']; ?></td>




                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->











                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card card-warning">

                                            <div class="card-header">
                                                <h3 class="card-title">Detail Data Order</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body">

                                                <div class="card-body table-responsive pad">
                                                    <table class="table table-hover text-nowrap" style="font-size: 11px;">
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
                                                            <?php foreach ($Dataorders_item as $dt) : ?>
                                                                <tr>
                                                                    <td width="75px" class="text-center">

                                                                        <img src="<?= base_url('assets/img/product/') . $dt['image_product']; ?>" class="img-thumbnail">





                                                                    </td>
                                                                    <td class="text-left" style="vertical-align:middle"><?= $dt['nama_product']; ?></td>
                                                                    <td class="text-center" style="vertical-align:middle"><?= $dt['qty']; ?></td>
                                                                    <td class="text-center" style="vertical-align:middle">Rp. <?= number_format($dt['price'], 0, ',', '.'); ?></td>
                                                                    <td class="text-center" style="vertical-align:middle">Rp. <?= number_format($dt['subtotal'], 0, ',', '.'); ?></td>



                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <tr>
                                                                <td colspan="6" class="text-right">
                                                                    <h5> Total Harga : <b> Rp. <?= number_format($totalharga['totalharga'], 0, ',', '.'); ?> </b> </h5>
                                                                </td>
                                                            </tr>


                                                        </tbody>
                                                    </table>




                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-sm-8">
                                        <div class="card card-solid">
                                            <div class="card-body">
                                                <form class="form-horizontal" action="<?= base_url('Transaction/ApproveOrder'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Fintech</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" id="fintech" name="fintech">
                                                                    <option value="" hidden>Fintech</option>

                                                                    <?php foreach ($fintech as $r) :   ?>
                                                                        <option value="<?= $r['id']; ?>"> <?= $r['fintech_name'];  ?></option>
                                                                    <?php endforeach;   ?>
                                                                </select>
                                                            </div>

                                                            <input type="text" id="kode_order" name="kode_order" class="form-control form-control-sm" value="<?= $Dataorders['kode_order']; ?>" hidden>


                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Note Order</label>
                                                            <div class="col-sm-8">

                                                                <textarea class=" col-sm-12 form-control " style="overflow:auto;resize:none" id="noteorder" name="noteorder" normalizer_normalize="noteorder" rows="3" value="<?= set_value('noteorder'); ?>"></textarea>



                                                            </div>
                                                        </div>


                                                    </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h3 class="card-title">Aksi</h3>


                                            </div>
                                            <div class="card-body">

                                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Approved </button>
                                                <a class="btn btn-danger btn-block" href="<?= base_url('Transaction/RejectOrder'); ?>/<?= $Dataorders['kode_order']; ?>"><i class="fas fa-times"></i> Reject</a>

                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>








                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>