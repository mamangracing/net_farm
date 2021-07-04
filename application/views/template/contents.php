  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/sawah.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1 class="text-black">Network Farming</h1>
            <h3 style="margin-top: -10px; margin-bottom: 10px; max-width: 600px;">Platform untuk mengintegrasikan para buruh tani dan petani</h3>
            <a class="btn btn-success btn-round" href="<?= base_url('daftar'); ?>"><?= $this->session->role_id == 2 ? 'Dashboard' : ($this->session->role_id == 3 ? 'Dashboard' : 'Daftar User' )?></a>
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

                if($this->session->role_id == 3){
                  foreach ($posting as $post) {
                  $awal = new Datetime($post['tgl_awal']);
      
                    ?>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <img class="card-img-top img-fluid" src="<?= base_url('assets/img/images/'. $post['gambar']); ?>">
                            <div class="card-body">
                              <h4 class="card-title"><?= $post['nama']; ?></h4>  
                              <ul class="text-left list-group">
                                <li>tipe kerja : <?= $post['tipe_kerja']; ?></li>
                                <li>Luas Ladang : <?= $post['juru']; echo " Juru"; ?></li>
                                <li>Upah : <?= "Rp ".number_format($post['harga'],0,',','.'); ?></li>
                                <li>Mulai Kerja : <?= $awal->format('d-m-Y'); ?></li>            
                              </ul>
                              <a class="btn btn-primary" href="<?= base_url('get/work/'.$post['id_pekerjaan']); ?>">ambil</a>
                            </div>
                            <div class="card-footer text-muted">posted at <?php $det = new Datetime($post['created_at']);echo $det->format('h:i:s d/m/Y'); ?></div>
                        </div>
                      </div>
                    <?php
                  }
                } else {

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