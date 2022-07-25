<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Kontak</h1>



        </div><!-- /.col -->

        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>



      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->



  <!-- Main content -->
  <div class="content ">
    <div class="container">

      <section id="contact" class="contact">
        <div class="container">

          <div class="row" data-aos="fade-in">

            <div class="col-md-6 ">
              <div class="card">
                <div class="card-body">
                  <div class="info">
                    <div class="address">

                      <h5> <i class="fas fa-city"></i> Alamat </h5>
                      <p> Jl. Ciputat Raya No.28D, RT.3/RW.10, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12240</p>
                    </div>

                    <div class="email">

                      <h5> <i class="fas fa-at"></i> Email </h5>
                      <p>Belifeindonesia@gmail.com</p>
                    </div>

                    <div class="phone">

                      <h5> <i class="fas fa-phone"></i> Telepon</h5>
                      <p>+62 812-8466-6194</p>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.052089643173!2d106.77509611487518!3d-6.256868695471117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1118251060d%3A0xe3da2dad37b8c065!2sPT%20Betterlife%20Jaya%20indonesia!5e0!3m2!1sen!2sid!4v1616684420864!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen loading="lazy" pointer-events: none;"></iframe>
                  </div>

                </div>

              </div>

            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url('Homepage/KontakSend') ?>" method="POST">
                    <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
                      <strong>Terimakasih !</strong> Pesan anda telah kami terima.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="form-control" id="name" data-rule="minlen:4" required data-msg="Please enter at least 4 chars" />
                        <div class="validate"></div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" name="email" id="email" data-rule="email" required data-msg="Please enter a valid email" />
                        <div class="validate"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name">Subject</label>
                      <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" required data-msg="Please enter at least 8 chars of subject" />
                      <div class="validate"></div>
                    </div>
                    <div class="form-group">
                      <label for="name">Pesan</label>
                      <textarea class="form-control" style="overflow:auto;resize:none" name="pesan" rows="11" normalizer_normalize="pesan" data-rule="required" required data-msg="Please write something for us"></textarea>
                      <div class="validate"></div>
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Kirim</button></div>

                  </form>
                </div>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->


      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->