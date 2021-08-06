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
                      <th><b>meter</b></th>
      								<th><b>Upah</th>
                      <th><b>Status</b></th>
                      <th><b>Pembayaran</b></th>
                      <th style="width:50px !important;"><b>Bukti</b></th>
                      <th><b>Action</b></th>
      							</tr>
			      				</thead>
			      				<tbody>
                      <?php
                      $i = 1;
                      $hitung = 0;

                      foreach($data as $d => $key){
                        
                        $date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
                        $format_date = $date->format('Y-m-d');
                        
                        if($key['tgl_awal'] == $format_date){
                          if($key['work_status'] == 0){
                            $status = "Belum Dikerjakan";

                          } else if($key['work_status'] == 1){
                            
                            if($key['tgl_awal'] != date('Y-m-d')){
                              $status = "pekerjaan belum di selesaikan";
                            } else {
                              $status = "Sedang Dikerjakan";
                            }
                          
                          } else {
                            $status = "Selesai Dikerjakan";
                          } 
                        } else {
                          if($key['work_status'] == 0){
                            $status = "Tanggal belum tersedia";

                          } else if($key['work_status'] == 1){
                            $status = "Pekerjaan belum diselesaikan";
                          
                          } else{
                            $status = "Selesai Dikerjakan";
                          } 
                        }
                      ?>
                        <tr class="text-center">
                          <td><?= $i++; ?></td>
                          <td><?= $key['nama_pekerjaan']; ?></td>
                          <td><?= $key['tgl_awal'];?></td>
                          <td><?= $key['tipe_kerja'];?></td>
                          <td><?= $key['meter'];?></td>
                          <td><?= "Rp ". number_format($key['harga'],0,',','.'); ?></td>
                          <td><?= $status; ?></td>
                          <td><?= $pembayaran[$d]['status_pembayaran'] == 0 ? 'Belum dibayar' : 'Sudah dibayar' ?></td>
                          <td><a href="<?= base_url('assets/img/bukti/'.$pembayaran[$d]['bukti_upload']);?>"><img src="<?= base_url('assets/img/bukti/'.$pembayaran[$d]['bukti_upload']);?>" class="w-50"></a></td>  
                          <td class="td-actions">
                            <?php 
                              if(date('Y-m-d') == $key['tgl_awal']){

                                  $link = base_url('mitra/start_work/'.$key['id']);
                                  $finish = base_url('mitra/finish_work/'.$key['id']);
                                  ?> 
                                    <a href="<?= $key['work_status'] == 1 ? "#" : $link ?>" rel="tooltip" data-placement="top" class="btn btn-danger" <?= $key['work_status'] == 1 ? 'hidden' : ($key['work_status'] == 2 ? 'hidden' : '')?> title="Kerja">
                                      <i class="material-icons">work</i>
                                    </a>
                                    <a href="<?= $finish; ?>" rel="tooltip" data-placement="top" class="btn btn-success <?= $key['work_status'] == 1 ? "" : "disabled" ?>" title="Selesai">
                                      <i class="material-icons">done</i>
                                    </a>  
                                  <?php
                                
                              } else {
                                  $report = base_url('mitra/finish_work/'.$key['id']);
                              
                                ?>
                                  <a href="<?= $key['work_status'] == 0 ? '#' :($key['work_status'] == 1 ? $report : '#')?>" rel="tooltip" class="btn <?= $key['work_status'] == 0 ? 'btn-warning' : ($key['work_status'] == 1 ? 'btn-danger' : 'btn-success disabled')?>" title="<?= $key['work_status'] == 0 ? 'pending' : ($key['work_status'] == 1 ? 'report' : 'selesai')?>"><i class="material-icons"><?= $key['work_status'] == 0 ? 'pending' : ($key['work_status'] == 1 ? 'report' : 'done') ?></i></a>
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
