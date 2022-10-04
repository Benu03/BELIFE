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

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-file-alt mr-1"></i>
                            List Data PO Supplier
                        </h3>

                    </div>
                    <div class="card-body table-responsive pad">
                        <table id="tbpolistsupplier" class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode PO</th>
                                    <th>Total Request</th>
                                    <th>Jumlah Detail</th>
                                    <th>Tanggal Approve</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($polist as $s) : ?>
                                    <tr>
                                        <td width="30px" class="text-center"><?= $i++; ?></td>
                                        <td width="150px"><?= $s['kode_po_do']; ?></td>
                                        <td width="100px" class="text-center">
                                            <?= $s['total_req']; ?>
                                        </td>

                                        <td width="150px" class="text-center">
                                            <?= $s['count_detail']; ?>
                                        </td>
                                        <td width="100px" class="text-center">
                                            <?= $s['date_approve']; ?>
                                        </td>
                                        <td width="100px" class="text-center">
                                            <?= $s['status_po_do']; ?>
                                        </td>

                                        <td width="120px" class="text-center">
                                            <a class="btn btn-sm bg-warning" href="javascript:void(0)" onclick="location.href='<?= base_url('PurchaseOrder_DeliveryOrder/PO_supplier_d'); ?>/<?= $s['kode_po_do']; ?>' "><i class="fas fa-inbox"></i> Detail</a>


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




</div>
</div>
</div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>