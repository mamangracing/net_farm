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
      		<div class="row">
      			<div class="col-lg-12"><?= $this->session->flashdata('pesan');?>
      				<div class="card">
	      				<div class="card-header card-header-success">
	      					<h4 class="card-title">Riwayat Kerja</h4>
	      					<p class="card-category">Di perbarui pada <script>
          document.write(new Date().toLocaleString("en-GB", {timeZone: "Asia/Jakarta"}));	
        </script></p>
      					</div>
      					<div class="card-body table-responsive">
      						<table class="table table-hover" id="table-datatable">
      							<thead class="text-success">
      							<tr class="text-center">
      								<th><b>No</th>	
      								<th><b>Nama Pekerjaan</th>
                      <th><b>Tgl Mulai</b></th>
                      <th><b>Tipe Kerja</b></th>
                      <th><b>Juru</b></th>
      								<th><b>Upah</th>
                      <th><b>Status</b></th>
                      <th><b>Pembayaran</b></th>
                      <th><b>Action</b></th>
      							</tr>
			      				</thead>
			      				<tbody>
                      <?php
                      $i = 1;
                      $hitung = 0;

                      foreach($data as $d){

                        //var_dump($pembayaran[$d]);
                        if($d['tgl_awal'] == date('Y-m-d')){
                          if($d['work_status'] == 0){
                            $status = "Belum Dikerjakan";

                          } else if($d['work_status'] == 1){
                            
                            if($d['tgl_awal'] != date('Y-m-d')){
                              $status = "pekerjaan belum di selesaikan";
                            } else {
                              $status = "Sedang Dikerjakan";
                            }
                          
                          } else {
                            $status = "Selesai Dikerjakan";
                          } 
                        } else {
                          if($d['work_status'] == 0){
                            $status = "Tanggal belum tersedia";
                          
                          } else if($d['work_status'] == 1){
                            $status = "Pekerjaan belum diselesaikan";
                          
                          } else{
                            $status = "pekerjaan selesai";
                          } 
                        }
                      ?>
                        <tr class="text-center">
                          <td><?= $i++; ?></td>
                          <td><?= $d['nama_pekerjaan']; ?></td>
                          <td><?= $d['tgl_awal'];?></td>
                          <td><?= $d['tipe_kerja'];?></td>
                          <td><?= $d['juru'];?></td>
                          <td><?= "Rp ". number_format($d['harga'],0,',','.'); ?></td>
                          <td><?= $status ?></td>
                          <td></td>
                          <td class="td-actions">
                            <?php 
                              if(date('Y-m-d') == $d['tgl_awal']){

                                  $link = base_url('mitra/start_work/'.$d['id']);
                                  $finish = base_url('mitra/finish_work/'.$d['id']);
                                  ?> 
                                    <a href="<?= $d['work_status'] == 1 ? "#" : $link ?>" onclick="alert('<?= $d['work_status'] == 1 ? "ups sepertinya ada pekerjaan yang belum selesai nih, silahkan klik tombol report untuk menyelesaikan pekerjaan" : '' ?>')" rel="tooltip" data-placement="top" class="btn btn-danger" <?= $d['work_status'] == 1 ? 'hidden' : ($d['work_status'] == 2 ? 'hidden' : '')?> title="Kerja">
                                      <i class="material-icons">work</i>
                                    </a>
                                    <a href="<?= $finish; ?>" rel="tooltip" data-placement="top" class="btn btn-success <?= $d['work_status'] == 1 ? "" : "disabled" ?>" title="Selesai">
                                      <i class="material-icons">done</i>
                                    </a>  
                                  <?php
                                
                              } else {
                                  $report = base_url('mitra/report');
                              
                                ?>
                                  <a href="<?= $d['work_status'] == 0 ? '#' :($d['work_status'] == 1 ? $report : '#')?>" rel="tooltip" class="btn <?= $d['work_status'] == 0 ? 'btn-warning' : ($d['work_status'] == 1 ? 'btn-danger' : 'btn-success disabled')?>" title="<?= $d['work_status'] == 0 ? 'pending' : ($d['work_status'] == 1 ? 'report' : 'selesai')?>"><i class="material-icons"><?= $d['work_status'] == 0 ? 'pending' : ($d['work_status'] == 1 ? 'report' : 'done') ?></i></a>
                                <?php
                              }
                            ?>
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
