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
                                <div class="col-7">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Form Operational Cash Flow</b></h3>
                                        </div>
                                        <div class="card-body">


                                            <form name="orderscustomerpodo" action="<?= base_url('Finance/PostPoDo_Review_Upd'); ?>" method="POST"></form>
                                            <div class="form-group row">
                                                <label for="coa" class="col-sm-5 col-form-label">COA</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" id="coa" name="coa" placeholder="Insert Title" value=" ">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="status" class="col-sm-5 col-form-label">Status</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" id="status" name="status" placeholder="Insert Title" value=" ">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nominal" class="col-sm-5 col-form-label">Nominal</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" id="nominal" name="nominal" placeholder="Insert Title" value=" ">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="notereview" class="col-sm-5 col-form-label">Note</label>
                                                <textarea class=" col-sm-7 form-control " style="overflow:auto;resize:none;font-size: 12px" id="notereview" name="notereview" normalizer_normalize="notereview" rows="4" value="<?= set_value('noteapv'); ?>"> </textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <a href="javascript:void(0)" onclick="location.href='<?= base_url('Finance/PoDoList/'); ?>'" class="btn  btn-sm btn-secondary  btn-block text-center">

                                                        <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                                </div>

                                                <div class="col-sm-6 text-center">
                                                    <button type="submit" class="btn  btn-sm btn-success btn-block text-center"><i class="fas fa-user-tie"></i> Post </button>
                                                </div>
                                            </div>
                                            </form>




                                        </div>
                                    </div>

                                </div>

                                <div class="col-5">

                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title"><b>SummaryOperational Cash Flow</b></h3>
                                        </div>
                                        <div class="card-body">






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