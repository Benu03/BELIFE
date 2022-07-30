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
            <?= $this->session->flashdata('message'); ?>
            <div class="row">

                <div class="col-12">

                    <div class="card card-secondary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-req-tab" data-toggle="pill" href="#custom-tabs-one-req" role="tab" aria-controls="custom-tabs-one-req" aria-selected="true">Request List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-approved-tab" data-toggle="pill" href="#custom-tabs-one-approved" role="tab" aria-controls="custom-tabs-one-approved" aria-selected="false">Approve List</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-req" role="tabpanel" aria-labelledby="custom-tabs-one-req-tab">
                                    <div class="card card-solid">
                                        <div class="card-body">

                                            <table id="tblistpodoreq" class="table table-bordered" style="font-size: 10px;">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Kode PO DO</th>
                                                        <th>Nominal (Rp)</th>
                                                        <th>Count</th>
                                                        <th>Tipe Request</th>
                                                        <th>User Request</th>
                                                        <th>Date Request</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($listreq as $lr) : ?>
                                                        <tr>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['kode_po_do']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= number_format($lr['total_req'], 0, ',', '.'); ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['count_detail']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['Description']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['user_request']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['date_request']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('Finance/PoDoReq_Review/' . Encrypt_url($lr['kode_po_do'])); ?>'" class="btn  btn-sm btn-warning float-center">

                                                                    <i class="fas fa-eye"></i> Review</a>

                                                            </td>



                                                        </tr>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>








                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-approved" role="tabpanel" aria-labelledby="custom-tabs-one-approved-tab">

                                    <div class="card card-solid">
                                        <div class="card-body">





                                            <table id="tblistpodoapv" class="table table-bordered" style="font-size: 11px;">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Kode PO DO</th>
                                                        <th>Nominal (Rp)</th>
                                                        <th>Count</th>
                                                        <th>Tipe Request</th>
                                                        <!-- <th>User Request</th> -->
                                                        <th>Date Request</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($listapv as $lr) : ?>
                                                        <tr>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['kode_po_do']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= number_format($lr['total_req'], 0, ',', '.'); ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['count_detail']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['Description']; ?>
                                                            </td>
                                                            <!-- <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['user_request']; ?>
                                                            </td> -->
                                                            <td class="text-center" style="vertical-align:middle">
                                                                <?= $lr['date_request']; ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align:middle">



                                                                <a href="<?= base_url('Finance/PrintPodoList/' . Encrypt_url($lr['kode_po_do'])); ?>" class="btn  btn-sm btn-info" target="_blank">
                                                                    <i class="fas fa-print"></i> Print</a>


                                                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('Finance/PrintPodoListDone/' . Encrypt_url($lr['kode_po_do'])); ?>'" class="btn  btn-sm btn-success">
                                                                    <i class="fas fa-clipboard-check"></i> Done</a>


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
                        <!-- /.card -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->










<?php $this->load->view('Templates/footer'); ?>