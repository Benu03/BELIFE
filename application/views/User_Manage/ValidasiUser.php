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

                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-file-alt mr-1"></i>
                                List Data
                            </h3>
                           
                        </div>
                        <div class="card-body table-responsive pad">
                            <table id="tbregistercustomer" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>UserName</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Perusahan</th>
                                  
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                             
                                    <?php foreach ($dataregister as $p) : ?>
                                        <tr>
                                           
                                     
                                        <td class="text-left" style="vertical-align:middle"><?= $p['username']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['name_full']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['email']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['phone']; ?></td>
                                        <td class="text-left" style="vertical-align:middle"><?= $p['patner_name']; ?></td>


                                            
                                       
                                            <td width="80px" class="text-center"  style="vertical-align:middle">
                                                <div class="btn-group-vertical">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="location.href='<?= base_url('User_Manage/ViewDetailCustomer/' . Encrypt_url($p['id'])); ?>'">View Detail</a></li>

                                                            <!-- <li><a class="dropdown-item" href="javascript:void(0)" onclick="location.href='<?= base_url('User_Manage/RejectRegister/' . Encrypt_url($p['username'])); ?>'">Reject</a></li> -->
                                                         
                                                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="confDelete('<?= base_url('User_Manage/RejectRegister/' . Encrypt_url($p['username'])); ?>')">Reject</a></li>
                                                           
                                                        </ul>
                                                    </div>
                                                </div>
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
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/footer'); ?>