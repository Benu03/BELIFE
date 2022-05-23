<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>
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
                    <!-- Error Message -->
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible text-sm">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6><strong>Error!</strong></h6>
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Success Message -->
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
                            <table id="tbsubmenu" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>SubMenu Title</th>
                                        <th>Menu URL</th>
                                        <th>Menu Icon</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($dtSubMenu as $sm) : ?>
                                        <tr>
                                            <td width="30px"><?= $i++; ?></td>
                                            <td><?= $sm['title']; ?></td>
                                            <td><?= $sm['url']; ?></td>
                                            <td width="80px" class="text-center"><i class="nav-icon <?= $sm['icon']; ?>"></i></td>
                                            <td width="80px" class="text-center">
                                                <?php if ($sm['is_active'] == '1') : ?>
                                                    Yes
                                                <?php else : ?>
                                                    No
                                                <?php endif; ?>
                                            </td>
                                            <td width="80px" class="text-center">
                                                <div class="btn-group-vertical">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="location.href='<?= base_url('Navigation/UpdateSubMenu/' . Encrypt_url($sm['id'])); ?>'">Update</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="confDelete('<?= base_url('Navigation/DeleteSubMenu/' . Encrypt_url($sm['id'])); ?>')">Delete</a></li>
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
            <form action="<?= base_url('Navigation/AddSubMenu'); ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Sub Menu Title</label>
                        <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter Sub Menu Title" required>
                    </div>
                    <div class="form-group">
                        <label for="menu_id">Menu Title</label>
                        <select class="form-control form-control-sm select2" id="menu_id" name="menu_id" data-placeholder="Select a Menu" style="width: 100%;" required>
                            <option></option>
                            <?php foreach ($dtMenu as $m) : ?>
                                <option value="<?= $m['id']; ?>">
                                    <?= $m['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control form-control-sm" id="url" name="url" placeholder="Enter url [menu/function_name], ex: 'Home/MyProfile' " required>
                    </div>


                    <div class="form-group">
                        <label for="icon">ICON</label>
                        <input type="text" class="form-control form-control-sm" id="icon" name="icon" placeholder="Enter Menu icon " required>
                    </div>


                    <div class="form-group">
                        <label for="role">Is Active ?</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="is_active1" name="is_active" value="1">
                            <label for="is_active1" class="custom-control-label">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="is_active2" name="is_active" value="0">
                            <label for="is_active2" class="custom-control-label">No</label>
                        </div>
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
<!-- /.modal -->

<!-- Notes: includes file views templates/footer.php -->
<?php $this->load->view('templates/footer'); ?>