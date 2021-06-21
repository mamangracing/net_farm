      <?php $this->load->view('users/head'); ?>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/'); ?>/dash/img/sidebar-1.jpg">
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Netfarm
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
                  <h4 class="card-title">Edit Profile</h4>
                  <p class="card-category">Silahkan Lengkapi profile anda !</p>
                </div>
                <div class="card-body">
                  <?= form_open_multipart('petani/edit_profile'); ?>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama</label>
                          <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama; ?>">
                          <?= form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" name="email" id="email" value="<?= $email; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor hp</label>
                          <input type="number" class="form-control" name="nohp" id="nohp" value="<?= $nohp; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor Rekening</label>
                          <input type="number" class="form-control" name="norek" id="norek" value="<?= $norek; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="pass" id="pass" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Alamat</label>
                          <input type="text" class="form-control" name="alm" id="alm" value="<?= $alamat; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="fileinput">
                          <input type="file" class="form-control" name="image" id="img">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>About Me</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                            <textarea class="form-control" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
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
                  <h4 class="card-title"><?= $nama; ?></h4>
                  <h6 class="card-category text-gray"><?= $kategori; ?></h6>
                  <p class="card-description text-left"><b>
                    Email : <?= $email; ?><br>
                    Alamat : <?= $alm = $alamat ? $alamat : "belum di isi"; ?><br>
                    Nomor Hp : <?= $nohp; ?><br>
                    No Rek : <?= $rek = $norek ? $norek : "belum di isi"; ?></b>  
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
</body>
<?php $this->load->view('users/js.php'); ?>