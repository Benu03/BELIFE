    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light navbar-orange">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-light"></i></a>
            </li>



            <!-- <li class="nav-item">

            <?php if (($this->session->userdata('id_role') == 2)) : ?>

            <a class="nav-link" href="<?= base_url('Feature/KontakAdminBelife') ?>"  class="nav-link" role="button">
            <i class="far fa-bell mr-2 text-light"></i>
            <span class="badge badge-light navbar-badge">15</span>
            </a>

            <?php endif; ?>
            </li> -->

            <li class="nav-item">


                <?php if (($this->session->userdata('id_role') == 2)) : ?>

                    <a href="<?= base_url('Feature/Keranjang') ?>" class="nav-link" role="button">

                        <i class="fas fa-shopping-cart mr-2 text-light"></i>

                        <span class="badge  badge-light navbar-badge"><?= Count_item($this->session->userdata('username')); ?></span>
                    </a>

                <?php endif; ?>

            </li>

            <li class="nav-item">


                <?php if (($this->session->userdata('id_role') == 2)) : ?>

                    <a href="<?= base_url('Notification/listdata') ?>" class="nav-link" role="button">

                        <i class="fas fa-bell mr-2 text-light"></i>

                        <span class="badge  badge-light navbar-badge"><?= Count_notification($this->session->userdata('username')); ?></span>
                    </a>

                <?php endif; ?>

            </li>


            <li class="nav-item ml-2">
                <?php if (($this->session->userdata('id_role') == 2)) : ?>
                    <form action="<?= base_url('DashboardUser/Index'); ?>" method="post" class="form-inline">
                    <div class="input-group input-group-sm">
                    <input class="form-control form-control-sm" id="cari" name="cari" type="text" placeholder="Search" aria-label="Search" autocomplete="off">                   
                    <span class="input-group-append">
                    <input class="btn btn-outline-light my-2 my-sm-0 btn-sm" type="submit" name="submit" value="Cari">
                    </span>
                      </div>
                    </form>   
                <?php endif; ?>
             
            </li>

            <li class="nav-item ml-2">
                <?php if (($this->session->userdata('id_role') == 2)) : ?>
                    <form action="<?= base_url('DashboardUser/Index'); ?>" method="post" class="form-inline">
                    <div class="input-group input-group-sm">
                            <select name="kategori_dashboard" id="kategori_dashboard" class="form-control">
                                <option value="" hidden> Kategori</option>
                                <?php foreach ($kategori as $r) :   ?>
                                    <option value="<?= $r['id']; ?>"> <?= $r['category_name'];  ?></option>
                                <?php endforeach;   ?>
                            </select>
                        <div class="input-group-append">
                        <input class="btn btn-outline-light my-2 my-sm-0 btn-sm" type="submit" name="submit2" value="Pilih">
                        </div>
                        </div>
                    </form>   
                <?php endif; ?>
             
            </li>

        </ul>




        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">







            <li class="nav-item">
                <a class="badge badge-pill badge-light" data-toggle="modal" data-target="#modal-signout" role="button">
                    <b class="mr-2 "> Sign Out</b>
                    <i class="fas fa-sign-out-alt "></i>
                </a>



            </li>
        </ul>
    </nav>
    <!-- /.navbar -->