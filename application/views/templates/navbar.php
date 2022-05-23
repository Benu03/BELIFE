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

        <a href="<?= base_url('Feature/Keranjang') ?>" class="nav-link" role="button" >
     
        <i class="fas fa-shopping-cart mr-2 text-light"></i>  
     
        <span class="badge  badge-light navbar-badge"><?=  count_item($this->session->userdata('username')); ?></span> 
        </a>   

        <?php endif; ?>     
            
        </li>

        <li class="nav-item">

        
        <?php if (($this->session->userdata('id_role') == 2)) : ?>

        <a href="<?= base_url('Notification/listdata') ?>" class="nav-link" role="button" >

        <i class="fas fa-bell mr-2 text-light"></i>  

        <span class="badge  badge-light navbar-badge"><?=  count_notification($this->session->userdata('username')); ?></span> 
        </a>   

        <?php endif; ?>     
            
        </li>





        

            <li class="nav-item">
            <?php if (($this->session->userdata('id_role') == 2)) : ?>
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search text-light"></i>
            <?php endif; ?>
            </a>
            <div class="navbar-search-block">
            <form class="form-inline">
            <form action="<?= base_url('DashboardUser/index'); ?>" method="post" class="form-inline">
                <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-sm" placeholder="Cari Barang">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
            </form>
            </div>
        </li>
       
        </ul>

    
     
     
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
       
       

 
          

        
                 <li class="nav-item">
                <a class="badge badge-pill badge-light" data-toggle="modal" data-target="#modal-signout" role="button">
                <b class="mr-2 ">  Sign Out</b>  
                    <i class="fas fa-sign-out-alt "></i>
                </a>



            </li>
        </ul>
    </nav>
    <!-- /.navbar -->