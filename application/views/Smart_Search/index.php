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
        <?= form_error('contract_no', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
            <div class="row">
                <div class="col-5">

                    <div class="card">
                        <div class="card-header">
                            Cari Kontrak
                        </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                        <form action="<?= base_url('Smart_Search/Kontrak_detail'); ?>" method="POST">

                        <div class="form-group">
                        <label for="contract_no">Kontrak No</label>
                        <input type="text" class="form-control form-control-sm" id="contract_no" name="contract_no" autocomplete="off" >
                        </div>
                    

                        <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
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
</div>
<!-- /.content-wrapper -->









<?php $this->load->view('Templates/footer'); ?>