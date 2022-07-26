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
                                List Data
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body table-responsive pad">
                            <table id="tbuseractivity" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>

                                        <th>Username</th>
                                        <th>activities</th>
                                        <th>object</th>
                                        <th>url</th>
                                        <th>ipdevice</th>
                                        <th>at_time</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dtActivity as $dt) : ?>
                                        <tr>

                                            <td width="100px"><?= $dt['username']; ?></td>
                                            <td><?= $dt['activities']; ?></td>
                                            <td><?= $dt['object']; ?></td>
                                            <td><?= $dt['url']; ?></td>
                                            <td><?= $dt['ipdevice']; ?></td>
                                            <td><?= $dt['at_time']; ?></td>


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

<?php $this->load->view('Templates/footer'); ?>