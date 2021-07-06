<?php $this->load->view('users/head'); ?>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/'); ?>/dash/img/sidebar-1.jpg">
      <div class="logo">
        <a href="<?= base_url('dashboard');?>" class="simple-text logo-normal">
          <?= $this->session->role_id == 1 ? "Admin" : ($this->session->role_id == 2 ? "Petani ".$this->session->nama : "Buruh ".$this->session->nama)?>
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
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Tasks:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">assignment</i> Detail Biaya
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons">credit_card</i> Bank account
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="material-icons">backup</i> Upload Bukti Transfer
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nama Pekerjaan</th>
                            <th>Type kerja</th>
                            <th>Upah</th>
                            <th>Biaya Admin</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?= $row->nama; ?></td>
                            <td><?= $row->tipe_kerja; ?></td>
                            <td><?= "Rp " . number_format($row->harga,0,',','.'); ?></td>
                            <?php 
                            $by_admin = 30/100; //10% dari total uang makan+upah
                            $sumUpah = $row->harga;
                            $biaya_admin = $row->juru * 200000 * $by_admin;
                            $total = $sumUpah + $biaya_admin;

                            ?>
                            <td>30% = <?= "Rp " . number_format($biaya_admin,0,',','.'); ?></td>
                            <td><?= "Rp " . number_format($total,0,',','.'); ?></td>
                          </tr>
                          <tr>
                            <td colspan="6">
                              Silahkan transfer sesuai biaya yang tertera di atas,untuk akun bank admin silahkan click tab <b>BANK ACCOUNT</b> !
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="messages">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td colspan="2">
                              Jika sudah melakukan transfer silahkan click tab <b>UPLOAD BUKTI TRANSFER</b> di atas, agar postingan anda segera di publikasi !
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img class="img-thumbnail" src="<?= base_url('assets/img/'); ?>bni.png" style="width: 50px; height: 30px;">
                            </td>
                            <td>3645763389
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img class="img-thumbnail" src="<?= base_url('assets/img/'); ?>bri.png" style="width: 50px; height: 30px;">
                            </td>
                            <td>124145467848758</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="settings">
                      <?= form_open_multipart('petani/up_bukti/'.$row->id_pekerjaan); ?>
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="fileinput">
                                  <label class="bmd-label-floating">Silahkan upload bukti transfer ! </label>
                                  <?= form_error('image','<small class="text-danger pl-3 alert-message">','</small>'); ?>                        
                                  <input type="file" class="file-input form-control" name="image" required="">
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Upload</button>
                                <div class="clearfix"></div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </form>
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

