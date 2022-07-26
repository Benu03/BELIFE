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
                            List Data Kontak
                        </h3>

                    </div>
                    <div class="card-body table-responsive pad">
                        <table id="tbkontakuser" class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($Kontaks as $s) : ?>
                                    <tr>
                                        <td width="40px" class="text-center"><?= $i++; ?></td>
                                        <td width="250px"><?= $s['nama']; ?></td>

                                        <td width="150px" c>
                                            <?= $s['email']; ?>
                                        </td>
                                        <td width="150px" class="text-center">
                                            <?= $s['subject']; ?>
                                        </td>




                                        <td width="120px" class="text-center">
                                            <a class="btn btn-sm bg-primary" href="javascript:void(0)" onclick="location.href='<?= base_url('Transaction/DetailKontak'); ?>/<?= Encrypt_url($s['id']); ?>' "><i class="fas fa-inbox"></i> Detail Kontak</a>


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
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>