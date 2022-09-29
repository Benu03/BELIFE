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

                <div class="col-md-6"">
                                                   
                            <div class=" card card-primary">
                    <div class="card-header">

                        <h3 class="card-title">Data Kontak</h3>
                        <div class="card-tools">
                            <?= $Kontakdetail['date_post']; ?>
                        </div>




                    </div>


                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?= $Kontakdetail['nama']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?= $Kontakdetail['email']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Subject</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?= $Kontakdetail['subject']; ?>" disabled>
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1">Pesan</label>
                            <textarea disabled class="form-control" style="overflow:auto;resize:none" name="pesan" rows="11" normalizer_normalize="pesan" data-rule="required" required data-msg="Please write something for us"> <?= $Kontakdetail['pesan']; ?>   </textarea>

                        </div>



                    </div>
                </div>



            </div>

            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Reply Kontak</h3>
                    </div>

                    <form action="<?= base_url('Transaction/ReplyKontak'); ?>" method="POST" class="form-horizontal">
                        <div class="card-body">

                            <div class="form-group">
                                <input type="text" class="form-control" name="id" id="id" value="<?= $Kontakdetail['id']; ?>" hidden>
                                <textarea class="form-control" style="overflow:auto;resize:none" name="replykontak" id="replykontak" rows="11" normalizer_normalize="replykontak" data-rule="required" required data-msg="Please write something for us">   </textarea>

                            </div>




                        </div>

                        <div class="card-footer">
                            <a href="javascript:void(0)" onclick="location.href='<?= base_url('Transaction/Kontak'); ?>'" class="btn btn-sm btn-default">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-info float-right">Post</button>
                        </div>
                    </form>





                </div>




            </div>




        </div>




    </div>
</div>
</div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Templates/footer'); ?>