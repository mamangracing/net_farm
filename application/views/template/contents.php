  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/sawah.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1 class="text-black">Network Farming</h1>
            <h3 style="margin-top: -10px; margin-bottom: 10px; max-width: 600px; color: yellow">Platform untuk mengintegrasikan para buruh tani dan petani. Menjalin kerjasama antar anggota,masyarakat, dan Desa untuk membantu mewujudkan progam pemerintah swasembada(kemampuan untuk memenuhi segala kebutuhan) pangan berkelanjutan.</h3>
            <?= $this->session->role_id == 2 ? '<a class="btn btn-success btn-round" href="Dashboard">Dashboard</a>' : ( $this->session->role_id == 3 ? '<a class="btn btn-success btn-round" href="Dashboard">Dashboard</a>' : '') ;?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if($this->session->role_id != 3){ ?>
  <div class="col-md-12 p-5">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title text-center"><?= $judul_table ;?></h4>
      </div>
      
          <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-xl-12 m-atuo">Visi</label><br>
              <label>Meningkatkan kesejahteraan anggota Kelompok Tani dan masyarakat.</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-xl-12 m-auto">Misi</label><br>
              <label>Menggali sumber daya alam dan sumber daya manusia untuk meningkatkan pertanian dengan bergotong royong, sehingga Kesejahteraan anngota dan masyarakat dapat tercapai.</label>
            </div>
          </div>
        </div>
      </div>      
    </div>
  </div>
        <?php } ?>
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
                  $awal = new Datetime($post['mulai_kerja']);
      
                    ?>
                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <img class="card-img-top img-fluid w-50 m-auto" src="<?= base_url('assets/img/images/'. $post['gambar']); ?>">
                            <div class="card-body">
                              <h4 class="card-title"><?= $post['nama_pekerjaan']; ?></h4>  
                              <ul class="text-left list-group">
                                <li>Pemilik Ladang : <?= $post['pemilik_ladang'];?></li>
                                <li>Tipe Kerja : <?= $post['tipe_kerja']; ?></li>
                                <li>Luas Ladang : <?= $post['meter']; echo " Meter"; ?></li>
                                <li>Upah : <?= "Rp ".number_format($post['harga'],0,',','.'); ?></li>
                                <li>Mulai Kerja : <?= $post['mulai_kerja']; ?></li>            
                              </ul>
                              <a class="btn btn-primary" href="<?= base_url('get/work/'.$post['id_pekerjaan']); ?>">ambil</a>
                            </div>
                            <div class="card-footer text-muted">posted at <?php $det = new Datetime($post['mulai_kerja']);echo $det->format('h:i:s d/m/Y'); ?></div>
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