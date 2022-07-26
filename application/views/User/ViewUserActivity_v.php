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
                            View Data
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
                    <div class="card-body table-responsive pad">
                        <table id="tbuseractivity" class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>

                                    <th>Username</th>
                                    <th>Activites</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dtActivity as $dt) : ?>
                                    <tr>

                                        <td width="100px"><?= $dt['username']; ?></td>
                                        <td><?= $dt['activities']; ?></td>



                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="javascript:void(0)" onclick="location.href='<?= base_url('User/UserActivity'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>