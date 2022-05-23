<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link logo-switch navbar-orange"  onclick="location.href='<?= base_url(''); ?>'">
        <img src="<?= base_url('assets/img/belife-logo-1.png'); ?>" alt="BeLife Logo" class="brand-image-xl logo-xs img-circle elevation-3" style="opacity: .8">
        <img src="<?= base_url('assets/img/belife-logo-2.png'); ?>" alt="BeLife Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (($this->session->userdata('img_user') == "default_img_user.png") or ($this->session->userdata('img_user') == NULL)) : ?>
                    <a class="d-block"  href="javascript:void(0)" onclick="location.href='<?= base_url('Home/MyProfile'); ?>'"> <img src="<?= base_url('assets/img/img-profile/default_img_user.png'); ?>" class="img-circle elevation-2" alt="User Image"> </a>
                <?php else : ?>
                    <a class="d-block"  href="javascript:void(0)" onclick="location.href='<?= base_url('Home/MyProfile'); ?>'">   <img    src="<?= base_url('assets/img/img-profile/' . $this->session->userdata('username') . '/' . $this->session->userdata('img_user')); ?>" class="img-circle elevation-2" alt="User Image"> </a>
                <?php endif; ?>
            </div>
            <div class="info">
                <a class="d-block"  href="javascript:void(0)" onclick="location.href='<?= base_url('Home/MyProfile'); ?>'"><?= $this->session->userdata('name'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- QUERY VIEW LIST MENU -->
                <?php $menu = $this->user_menu_m->get_menu_by_role($this->session->userdata('id_role')); ?>
                <!-- LOOPING MENU -->



                  <?php foreach ($menu as $m) : ?>
                    <?php if ($this->uri->segment(1) === $m['url']) : ?>
                        <li class="nav-item menu-open">
                            <a   class="nav-link active">
                            <?php else : ?>
                          <li class="nav-item">
                            <a  href="<?= base_url($m['url']); ?>" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon <?= $m['icon']; ?>"></i>
                            <p><?= $m['title']; ?></p>
                           
                            </a>

                            <!-- QUERY VIEW LIST SUB MENU -->
                            <?php $subMenu = $this->user_sub_menu_m->get_submenu_by_menu($m['id']);
                            
                    
                            
                            ?>
                            <!-- LOOPING SUB MENU -->

                            
                            <?php foreach ($subMenu as $sm) : ?>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                            <?php if ($title == $sm['title']) : ?>
                                            <a href="javascript:void(0)" onclick="location.href='<?= base_url($sm['url']); ?>'" class="nav-link active">
                                             <?php else : ?>
                                                <a href="javascript:void(0)" onclick="location.href='<?= base_url($sm['url']); ?>'" class="nav-link">
                                                <?php endif; ?>
                                                <i class="nav-icon <?= $sm['icon']; ?>"></i>
                                                <p>
                                              
                                                    <?= $sm['title']; ?> 
                                             
                                    <!-- NOTIFIACTION COUNT DATA (FROM HELPER) -->
                                                    <?php if ($sm['id'] == '21'): ?> 
                                                    <span class="badge badge-pill badge-warning right">
                                                    <?=  count_orderprocess(); ?></span>

                                                    <?php elseif ($sm['id'] == '19'): ?> 
                                                    <span class="badge badge-pill badge-success right">
                                                    <?=  count_validasiregister(); ?></span>

                                                    <?php elseif ($sm['id'] == '16'): ?> 
                                                    <span class="badge badge-pill badge-primary right">
                                                    <?=  count_shipping(); ?></span>

                                                    <?php elseif ($sm['id'] == '31'): ?> 
                                                        <span class="badge badge-pill badge-warning right">
                                                    <?=  count_delivery(); ?></span>

                                                    <?php elseif ($sm['id'] == '32'): ?> 
                                                        <span class="badge badge-pill badge-info right">
                                                    <?=  count_kontak(); ?></span>

                                                    <?php elseif ($sm['id'] == '11'): ?> 
                                                        <span class="badge badge-pill badge-info right">
                                                     <?=  count_item($this->session->userdata('username')); ?></span>


                                                    <?php endif; ?>

                                                  
                                                </p>
                                                </a>
                                    </li>
                                </ul>
                            <?php endforeach; ?>

                        </li>
                    <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</aside>