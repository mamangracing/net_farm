<?php $this->load->view('users/head'); ?>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/'); ?>/dash/img/sidebar-1.jpg">
      <div class="logo">
        <a href="<?= base_url();?>" class="simple-text logo-normal">
           <?= $this->session->role_id == 1 ? "Admin" : ($this->session->role_id == 2 ? "Petani ".$this->session->nama : "Mitra ".$this->session->nama)?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <?php $this->load->view('users/menu.php'); ?>
      </div>
    </div>
    <div class="main-panel">
    <!-- menu -->
    <?php $this->load->view('users/nav'); ?>
    <!-- end menu -->
      <div class="content">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><?= $judul_table ;?></h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <img src="<?= base_url('assets/');?>img/images/default.jpg  ">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-labl-floating">Nama Pekerjaan</label><br>
                        <label><?= $nama_pekerjaan;?></label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Mulai Pengerjaan</label><br>
                        <label><?= $tgl_awal ;?></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Panjang Ladang</label><br>
                        <label><?= $juru.' juru' ;?></label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Harga</label>
                        <label><?= "Rp ".number_format($harga,0,',','.');?></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="<?= base_url('assets/'); ?>img/profile/<?= $img; ?>" />
                  </a>
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?= $nama_user; ?></h4>
                  <h6 class="card-category text-gray"><?= $role == 3 ? 'Buruh' : 'Belum terdaftar' ?></h6>
                  <p class="card-description text-left"><b>
                    <div class="form_group">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <label>Email </label>
                        </div>
                        <div class="col-md-6 text-left">
                          <label><?= $email;?></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <label>Nomor Hp </label>
                        </div>
                        <div class="col-md-6 text-left">
                          <label><?= $nohp;?></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <label>Satus Pekerjaan</label>
                        </div>
                        <div class="col-md-6 text-left">
                          <label><?= $status == 0 ? 'Belum dikerjakan' : ($status == 1 ? 'Dikerjakan' : 'Selesai Dikerjakan') ?></label>
                        </div>
                      </div>
                    </div> 
                  </p>
                  <!-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> -->
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php $this->load->view('users/js.php'); ?>