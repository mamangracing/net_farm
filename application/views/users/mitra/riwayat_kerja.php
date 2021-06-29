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
                      <th><b>Tgl Selesai</b></th>
                      <th><b>Tipe Kerja</b></th>
      								<th><b>Upah</th>
                      <th><b>Status</b></th>
                      <th><b>Action</b></th>
      							</tr>
			      				</thead>
			      				<tbody>
                      <?php
                      $i = 1;
                      foreach($data as $d){
                        if($d['work_status'] == 0){
                          $status = "Belum Dikerjakan";

                        } else if($d['work_status'] == 1){
                          $status = "Sedang Dikerjakan";
                        
                        } else {
                          $status = "Selesai Dikerjakan";
                        } 
                      ?>
                        <tr class="text-center">
                          <td><?= $i++; ?></td>
                          <td><?= $d['nama_pekerjaan']; ?></td>
                          <td><?= $d['tgl_awal'];?></td>
                          <td><?= $d['tgl_akhir'];?></td>
                          <td><?= $d['tipe_kerja'];?></td>
                          <td><?= "Rp ". number_format($d['harga'],0,',','.'); ?></td>
                          <td><?= $status; ?></td>
                          <td class="td-actions">
                            <?php 
                              if(date('Y-m-d') == $d['tgl_awal']){

                                if($d['work_status'] == 2){
                                  
                                } else {
                                  ?> 
                                    <a href="<?= base_url('mitra/start_work/'.$d['id_pekerjaan']);?>" rel="tooltip" data-placement="top" class="btn btn-danger <?= $d['work_status'] == 1 ? "disabled" : ""?>" title="Kerja">
                                      <i class="material-icons">work</i>
                                    </a>
                                    <a href="<?= base_url('mitra/finish_work/'.$d['id_pekerjaan']);?>" rel="tooltip" data-placement="top" class="btn btn-success <?= $d['work_status'] == 1 ? "" : "disabled" ?>" title="Selesai">
                                      <i class="material-icons">done</i>
                                    </a>  
                                  <?php
                                }
                              } else {
                                ?>
                                  <label rel="tooltip" class="btn btn-warning" title="Tanggal belum tersedia"><i class="material-icons">pending</i></label>
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
