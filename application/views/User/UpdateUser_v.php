<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                        <li class="breadcrumb-item active">
                            Update Data
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
                <div class="col-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Update Data</h3>
                        </div>
                        <form action="<?= base_url('User/EditUser/' . Encrypt_url($dtUser['id'])); ?>" method="POST" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Insert username" value="<?= $dtUser['username']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Insert Name" value="<?= $dtUser['name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Insert Email" value="<?= $dtUser['email']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_role" class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm select2" id="id_role" name="id_role" data-placeholder="Select a Role" style="width: 100%;" required>
                                            <option></option>
                                            <?php foreach ($dtRoles as $r) : ?>
                                                <?php if (strtolower($r['id']) === strtolower($dtUser['id_role'])) : ?>
                                                    <option value="<?= $r['id']; ?>" selected="selected">
                                                        <?= $r['role']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?= $r['id']; ?>">
                                                        <?= $r['role']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_loc" class="col-sm-3 col-form-label">Work Location</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm select2" id="id_loc" name="id_loc" data-placeholder="Select a Work Location" style="width: 100%;" required>
                                            <option></option>
                                            <?php foreach ($dtLoc as $l) : ?>
                                                <?php if (strtolower($l['id']) === strtolower($dtUser['id_loc'])) : ?>
                                                    <option value="<?= $l['id']; ?>" selected="selected">
                                                        <?= $l['location_name']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?= $l['id']; ?>">
                                                        <?= $l['location_name']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_org" class="col-sm-3 col-form-label">Organization</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm select2" id="id_org" name="id_org" data-placeholder="Select an Organization" style="width: 100%;" required>
                                            <option></option>
                                            <?php foreach ($dtOrg as $o) : ?>
                                                <?php if (strtolower($o['id']) === strtolower($dtUser['id_org'])) : ?>
                                                    <option value="<?= $o['id']; ?>" selected="selected">
                                                        <?= $o['organization_name']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?= $o['id']; ?>">
                                                        <?= $o['organization_name']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_active" class="col-sm-3 col-form-label">Is Active?</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <?php if ($dtUser['is_active'] === '1') : ?>
                                                <input class="form-check-input" type="radio" id="is_active1" name="is_active" value="1" checked>
                                            <?php else : ?>
                                                <input class="form-check-input" type="radio" id="is_active1" name="is_active" value="1">
                                            <?php endif; ?>
                                            <label for="is_active1" class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <?php if ($dtUser['is_active'] === '0') : ?>
                                                <input class="form-check-input" type="radio" id="is_active2" name="is_active" value="0" checked>
                                            <?php else : ?>
                                                <input class="form-check-input" type="radio" id="is_active2" name="is_active" value="0">
                                            <?php endif; ?>
                                            <label for="is_active2" class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" onclick="location.href='<?= base_url('User/UserManagement'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-info float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>