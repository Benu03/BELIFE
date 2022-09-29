<!-- Notes: includes file views Templates/header.php -->
<?php $this->load->view('Templates/header'); ?>

<!-- Notes: includes file views Templates/navbar.php -->
<?php $this->load->view('Templates/navbar'); ?>

<!-- Notes: includes file views Templates/sidebar.php -->
<?php $this->load->view('Templates/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
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
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?= form_error('title', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('url', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= form_error('icon', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-file-alt mr-1"></i>
                                List Data
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-data">
                                            <i class="fas fa-plus-circle"></i>
                                            Add Data
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive pad">
                            <table id="tbmenu" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Menu Title</th>
                                        <th>Menu Name</th>
                                        <th>Menu URL</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($dtMenu as $m) : ?>
                                        <tr>
                                            <td width="30px"><?= $i++; ?></td>
                                            <td><?= $m['title']; ?></td>
                                            <td><?= $m['name']; ?></td>
                                            <td><?= $m['url']; ?></td>
                                            <td width="80px" class="text-center"><i class="nav-icon <?= $m['icon']; ?>"></i></td>
                                            <td width="80px" class="text-center">
                                                <div class="btn-group-vertical">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="location.href=' <?= base_url('Navigation/UpdateMenu/' . Encrypt_url($m['id'])); ?>'">Update</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="confDelete('<?= base_url('Navigation/DeleteMenu/' . Encrypt_url($m['id'])); ?>')">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL ADD DATA -->
<div class="modal fade" id="modal-add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Navigation/AddMenu'); ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Menu Title</label>
                        <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter Menu Title" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Menu Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Menu Name" required>
                    </div>
                    <div class="form-group">
                        <label for="url">Menu URL</label>
                        <input type="text" class="form-control form-control-sm" id="url" name="url" placeholder="Enter Menu URL" required>
                    </div>
                    <div class="form-group">
                        <label for="icon">Menu Icon</label>
                        <input type="text" class="form-control form-control-sm" id="icon" name="icon" placeholder="Enter Icon tag, ex: 'fas fa-fw fa-user' " required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Notes: includes file views Templates/footer.php -->
<?php $this->load->view('Templates/footer'); ?>