<?php $this->load->view('users/head.php'); ?>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/'); ?>/dash/img/sidebar-1.jpg">
      <div class="logo">
        <a href="<?= base_url();?>" class="simple-text logo-normal">
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
                      <th class="text-center"><b>tgl mulai</b></th>
                      <th class="text-center"><b>Harga</th>
                      <th class="text-center"><b>Biaya Admin</b></th>
                      <th class="text-center"><b>Total Biaya</th>
                      <?=
                      $role = $this->session->role_id == 1 ? '<th class="text-center"><b>Bukti</th>' : '<th class="text-center"><b>Status Postingan</th>';
                      ?>
                      <th colspan="3" class="text-center"><b>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <div id="preview"></div>
                      <?php
                      $i = 1; 

                      foreach ($transaksi as $t) {

                      if($this->session->role_id == 1){
                        $bukti = "<a href=" . base_url('assets/img/bukti/' . $t['bukti']) ."><img src=" . base_url('assets/img/bukti/' . $t['bukti']) ." style=width:59px></a>";
                      }
                      // print_r($bukti);
                      // die();  ?>
                        <tr>
                          <td class="text-center"><?= $i++; ?></td>
                            <?php 
                            if($this->session->role_id == 1){
                              echo '<td class="text-center">'. $t["Pemosting"] .'</td>';
                            } 
                            ?>
                          <td class="text-center"><?= $t['nama_pekerjaan']; ?></td>
                          <td class="text-center"><?= $t['tgl_awal']; ?></td>
                          <td class="text-center"><?= "Rp ".number_format($t['harga'],0,',','.'); ?></td>
                          
                          <?php
                            $sumUpah = $t['harga'];  
                            $admin = 30/100 * 200000;
                            $total = $sumUpah + $admin;

                            echo "<td class='text-center'> 30% = Rp ". number_format($admin,0,',','.'). "</td>";
                            echo "<td class='text-center'>Rp ". number_format($total,0,',','.')."</td>";
                          ?>

                          <?php
                            if($this->session->role_id == 1){ 

                              if($t['bukti']){ 
                                echo "<td class=text-center>".$bukti. "</td>";
                              } else { 
                                echo "<td class=text-center>Belum ada</td>"; 
                              }

                            } else {

                                if($t['is_posted'] == 0){
                                  echo "<td class=text-center>Pending</td>";

                                } else if($t['is_posted'] == 1){
                                  echo "<td class=text-center>Post</td>";

                                } else if($t['is_posted'] == 2){

                                  if($t['work_status'] == 0){
                                    echo "<td class=text-center>Diambil</td>";
                                  
                                  } else if($t['work_status'] == 1){
                                    echo "<td class=text-center>Dikerjakan</td>";
                                  
                                  } else {
                                    echo "<td class=text-center>Selesai Dikerjakan</td>";
                                  }
                                } else {
                                  echo "<td class=text-center>Tidak dikerjakan</td>";
                                }
                            }
                          // $role_id = $this->session->role_id == 1 ?
                          //   "<td class=text-center>" .$status = $t['bukti'] ? $bukti  : 'Belum ada' . "</td>" :
                          //   "<td class=text-center>" . $status = $t['is_posted'] == 0 ? 'pending' : ($t['is_posted'] == 1 ? 'post' : ($t['is_posted'] == 2 ? 'diambil' : ($t['is_posted'] == 3 ? 'dikerjakan' : 'selesai dikerjakan'))). "</td>";
                          
                          ?>
                          <td class="td-actions text-center">
                          <?php if($this->session->role_id == 1){?>

                            <a href="<?= base_url('admin/profil/'.$t['id_user']);?>" rel="tooltip" class="btn btn-info" data-toggle="tooltip" data-placement="top"  title="lihat profil pemosting">
                              <i class="material-icons">person</i>
                            </a>

                            <a href="<?= base_url('admin/acc/'.$t['id_pekerjaan']); ?>" rel="tooltip" data-toggle="tooltip" data-placement="top" <?= $t['is_posted'] >= 1 ? 'class="btn btn-success disabled"' : 'class="btn btn-success" title="Acc"'?>>
                                <i class="material-icons">check_circle</i>
                            </a>

                          <?php }else{ 
                            $disabled = "disabled";
                            ?>
                              <a href="<?= base_url('petani/detail_post/'.$t['id_pekerjaan']); ?>" rel="tooltip" data-placement="top" class="btn btn-primary <?php for($i=0; $i<count($post); $i++){ if($post[$i]['id_pekerjaan'] == $t['id_pekerjaan']){ echo 'disabled';} else {}}?>" title="Edit">
                                <i class="material-icons">edit</i>
                              </a>

                              <a href="<?= base_url("petani/pay_post/".$t["id_pekerjaan"]); ?>" rel="tooltip" data-placement="top" class="btn btn-success <?php for($i=0; $i<count($post); $i++){ if($post[$i]['id_pekerjaan'] == $t['id_pekerjaan']){ echo 'disabled';} else {}}?>" title="Upload">
                                <i class="material-icons">upload</i>
                              </a>
                              
                              <a href="<?= base_url("petani/detail_kerja/".$t['user_getid']."/".$t['id_pekerjaan']); ?>" rel="tooltip" data-placement="top" class="btn btn-primary" title="Lihat Pekerja" <?php if( $t['get_work'] == 0){ if($t['work_status'] == 2){ echo ''; } else { echo 'hidden'; }} else { echo '';} ?>>
                                <i class="material-icons">person</i>
                              </a>

                              <a href="<?= base_url('petani/delete_job/'.$t['id_pekerjaan']);?>" rel="tooltip" class="btn btn-danger <?= $t['work_status'] == 0 ? '' : ($t['work_status'] == 1 ? 'disabled' : '') ?>" data-placement="top" title="Hapus Post">
                                <i class="material-icons">close</i>
                              </a>
                            <?php 
                          }?>
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
