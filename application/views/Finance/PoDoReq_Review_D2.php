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
                    <div class="card card-solid">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-4">

                                    <form name="orderscustomerpodo" action="<?= base_url('Finance/PostPoDo_Review_Upd'); ?>" method="POST">

                                        <div class="card card-solid">
                                            <div class="card-body">

                                                <div class="form-group row">
                                                    <label for="kodepodo" class="col-sm-5 col-form-label">Kode PO & DO</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control form-control-sm" id="kodepodo" name="kodepodo" placeholder="Insert Title" value="<?= $pododata['kode_po_do']; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="totalreqpodo" class="col-sm-5 col-form-label">Total Request (Rp)</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control form-control-sm" id="totalreqpodo" name="totalreqpodo" value=" <?= number_format($pododata['total_req'], 0, ',', '.'); ?>" readonly>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="countoderpodo" class="col-sm-5 col-form-label">Jumlah Detail</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control form-control-sm text-center" id="countoderpodo" name="countoderpodo" value="<?= $pododata['count_detail']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="countoderpodo" class="col-sm-5 col-form-label">Status </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control form-control-sm " id="countoderpodo" name="countoderpodo" value="<?= $pododata['status_po_do']; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="notereview" class="col-sm-5 col-form-label">Note Review</label>


                                                    <textarea class=" col-sm-7 form-control " style="overflow:auto;resize:none;font-size: 12px" id="notereview" name="notereview" normalizer_normalize="notereview" rows="4" value="<?= set_value('noteapv'); ?>"> </textarea>


                                                </div>




                                                <div class="row">
                                                    <div class="col-sm-6">


                                                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('Finance/PoDoList/'); ?>'" class="btn  btn-sm btn-warning  btn-block text-center">

                                                            <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                                    </div>



                                                    <div class="col-sm-6 text-center">
                                                        <button type="submit" class="btn  btn-sm btn-success btn-block text-center"><i class="fas fa-user-tie"></i> Request Approve </button>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="col-8">

                                    <div class="card card-solid">
                                        <div class="card-body">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title"><b>List Detail PO & DO Pembayaran Ke Pihak Supplier</b></h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="card-body">

                                                    <div class="table-responsive">
                                                        <table id="tblpodoreview_d2" class="table table-bordered" style="font-size: 10px;" data-searching="false" data-paging="false" data-info="false">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    <th>Kode PODO</th>

                                                                    <th>Nominal Request</th>
                                                                    <th>Nama Supplier</th>
                                                                    <th>Kontak Supplier</th>
                                                                    <th>Bank Supplier</th>
                                                                    <th>User Order</th>
                                                                    <th>Tanggal Order</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($DetailData as $dt) : ?>
                                                                    <tr>

                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= $dt['kode_po_do']; ?>
                                                                        </td>


                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= number_format($dt['amount_req'], 0, ',', '.'); ?>
                                                                        </td>


                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= $dt['supplier_name']; ?>
                                                                        </td>

                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= $dt['kontak_supplier']; ?>
                                                                        </td>


                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= $dt['bank_supplier']; ?> - <?= $dt['norek_supplier']; ?>
                                                                        </td>


                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= $dt['user_post']; ?>
                                                                        </td>

                                                                        <td class="text-center" style="vertical-align:middle">
                                                                            <?= $dt['date_post']; ?>
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


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->










<?php $this->load->view('Templates/footer'); ?>