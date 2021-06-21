<?php $this->load->view('users/head.php'); ?>



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
      <!-- contents -->
      <div class="content">
        <div class="container-fluid">
          <?= $this->session->flashdata('pesan'); ?>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><?= $judul_table;?></h4>
                  <p class="card-category">Di perbarui pada <script>
          document.write(new Date().toLocaleString("en-GB", {timeZone: "Asia/Jakarta"})); 
        </script></p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover" id="table-datatable">
                    <thead class="text-success">
                    <tr>
                      <th class="text-center"><b>No</th> 
                      <?php 
                      if($this->session->role_id == 1){
                        echo '<th class="text-center"><b>Nama Petani</th>';
                      } 
                      ?>
                      <th class="text-center"><b>Nama Pekerjaan</th>
                      <th class="text-center"><b>Upah</th>
                      <th class="text-center"><b>Uang makan</th>
                      <th class="text-center"><b>Total Biaya</th>
                      <?=
                      $role = $this->session->role_id == 1 ? '<th class="text-center"><b>Bukti</th>' : '<th class="text-center"><b>Status Postingan</th>';
                      ?>
                      <th class="text-center"><b>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <div id="preview"></div>
                      <?php
                      $i = 1; 
                      foreach ($transaksi as $t) {
                      $bukti = "<a href=" . base_url('assets/img/bukti/' . $t['bukti']) ."><img src=" . base_url('assets/img/bukti/' . $t['bukti']) ." style=width:59px></a>";
                      // print_r($bukti);
                      // die();  ?>
                        <tr>
                          <td class="text-center"><?= $i++; ?></td>
                            <?php 
                            if($this->session->role_id == 1){
                              echo '<td class="text-center">'. $t["Pemosting"] .'</td>';
                            } 
                            ?>
                          <td class="text-center"><?= $t['Nama_pekerjaan']; ?></td>
                          <td class="text-center"><?= $t['upah']; ?></td>
                          <td class="text-center"><?= $t['uang_makan']; ?></td>
                          <td class="text-center"><?= $t['total']; ?></td>
                          <?=
                          $role_id = $this->session->role_id == 1 ?
                            "<td class=text-center>" .$status = $t['bukti'] ? $bukti  : 'Belum ada' . "</td>" :
                            "<td class=text-center>" . $status = $t['is_posted'] == 0 ? 'pending' : 'terpost' . "</td>";
                          
                          ?>
                          <td class="td-actions text-center">
                          <?php if($this->session->role_id == 1){?>

                            <a href="#" rel="tooltip" class="btn btn-info" data-toggle="tooltip" data-placement="top"  title="lihat profil pemosting">
                                    <i class="material-icons">person</i>
                                </a>
                            <a href="<?= base_url('admin/acc/'.$t['id_pekerjaan']); ?>" rel="tooltip" data-toggle="tooltip" data-placement="top" <?= $t['is_posted'] == 1 ? 'class="btn btn-success disabled"' : 'class="btn btn-success" title="Acc"'?>>
                                <i class="material-icons">check_circle</i>
                            </a>
                          <?php }else{ ?>
                            <a href="<?= base_url('petani/edit_post/'.$t['id_pekerjaan']); ?>" rel="tooltip" data-toggle="tooltip" data-placement="top" <?= $t['is_posted'] == 1 ? 'class="btn btn-success disabled"' : 'class="btn btn-success" title="Edit"'?>>
                              <i class="material-icons">check_circle</i>
                            </a>
                            <a href="<?= base_url('petani/delete_job/'.$t['id_pekerjaan']);?>" rel="tooltip" class="btn btn-danger delete_user" data-toggle="tooltip" data-placement="top" title="Hapus Post">
                                    <i class="material-icons">close</i>
                                </a>
                            <?php }?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end contents -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Coded with <i class="material-icons">favorite</i> by
            <a href="https://heartscode.net" target="_blank">Idiot Team</a> 
          </div>
        </div>
      </footer>
    </div>
  </div>

<?php $this->load->view('users/js.php'); ?>
