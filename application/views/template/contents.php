  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/sawah.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1 class="text-black">Network Farming</h1>
            <h3 style="margin-top: -10px; margin-bottom: 10px; max-width: 600px;">Platform untuk mengintegrasikan para buruh tani dan petani</h3>
            <a class="btn btn-success btn-round" href="<?= base_url('daftar'); ?>">i want to hire</a>
            <a class="btn btn-danger btn-round" href="#listwork">i want work</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- mulai contents -->
  <div class="main main-raised">

    <?php

    if($this->session->userdata('email')){
      ?>
        <div class="section section-example">
          <div class="container">
            <!-- alert -->
            <!-- <div class="alert alert-info alert-message">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">info_outline</i>
                </div><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">
                    <i class="material-icons">clear</i>
                  </span>
                </button>
                <b>Info alert :</b> Di bawah ini adalah daftar pekerjaan yang tersedia untuk anda !
              </div>
            </div> -->
            <?= $this->session->flashdata('info'); ?>
            <!-- end alerts -->

            <div class="row" id="listwork">
              <!-- bagian card -->
              <?php
              foreach ($posting as $post) {
              $date = new Datetime($post['batas_waktu']);
                
                if($post['is_posted'] == 1){

                  ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                      <div class="card text-center">
                          <img class="card-img-top img-fluid" src="<?= base_url('assets/img/images/'. $post['gambar']); ?>">
                          <div class="card-body">
                            <h4 class="card-title"><?= $post['nama']; ?></h4>  
                            <ul class="text-left list-group">
                              <li>tipe kerja : <?= $post['tipe_kerja']; ?></li>
                              <li>Upah : <?= $post['upah']; ?></li>
                              <li>Uang makan : <?= $um = $post['uang_makan'] == 0 ? "tidak ada" : $post['uang_makan']; ?></li>
                              <li>Batas waktu kerja : <?= $date->format('d/m/Y'); ?></li>
                              
                              <li>lokasi : <?= substr($post['lokasi'], 0,17); ?>...  <a href="https://www.google.com/maps/search/?api=1&query=<?= $post['lokasi']; ?>" class="btn-fab btn-fab-mini btn-round" data-toggle="tooltip" data-placement="top" title="Lihat di Gmaps"><i class="material-icons">pageview</i></a></li>
                              
                            </ul>
                            <a class="btn btn-primary" href="<?= base_url('get/work/'). $post['id_pekerjaan']; ?>">ambil</a>
                          </div>
                          <div class="card-footer text-muted">posted at <?php $det = new Datetime($post['created_at']);echo $det->format('h:i:s d/m/Y'); ?></div>
                      </div>
                    </div>
                  <?php 

                } else {
                  ?>
                    <div class="col-xl-12">
                      <div class="card text-center">
                        <div class="card-body">
                          <b>Saat ini tidak ada pekerjaan</b>
                        </div>
                      </div>
                    </div>
                  <?php
                }
              } 
              ?>

            </div>
          </div>
        </div>
      <?php
    }
    ?>
  </div>
  <!-- akhir contents -->