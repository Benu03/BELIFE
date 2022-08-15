<?php $this->load->view('Templates/header'); ?>
<?php $this->load->view('Templates/navbar'); ?>
<?php $this->load->view('Templates/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="error-page">
            

            <h2 class="headline text-warning"> 403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Maaf Anda Tidak Ada Akses..!!!</h3>
                <p>
                   
                    Silakan <a href="javascript:void(0)" onclick="location.href='<?= base_url('Home'); ?>'">Kembali Ke Beranda</a>.
                </p>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('Templates/footer'); ?>