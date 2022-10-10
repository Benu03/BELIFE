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


                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-file-alt mr-1"></i>
                                List Data History
                            </h3>
                            
                        </div>
                        <div class="card-body table-responsive pad">

                        <table id="tbproduct" class="table table-bordered table-striped table-sm">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Status</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($listdata as $ld) : ?>
                                    <tr>
                                    <td class="text-left" style="vertical-align:middle"><?= $ld['kode_po_do']; ?></td>
                                    <td class="text-left" style="vertical-align:middle"><?= $ld['status_po_do']; ?></td>

                                    </tr>
                                <?php endforeach; ?>
                                </tbody>




                        </div>


                </div>









                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->









<?php $this->load->view('Templates/footer'); ?>