<?php $this->load->view('users/head.php'); ?>



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
      <!-- contents -->
      <div class="content">
      	<div class="container-fluid">
      		<div class="row">
      			<div class="col-lg-12">
      				<div class="card">
	      				<div class="card-header card-header-success">
	      					<h4 class="card-title">Daftar Pekerjaan Yang telah di selsaikan</h4>
	      					<p class="card-category">Di perbarui pada <script>
          document.write(new Date().toLocaleString("en-GB", {timeZone: "Asia/Jakarta"}));	
        </script></p>
      					</div>
      					<div class="card-body table-responsive">
      						<table class="table table-hover" id="table-datatable">
      							<thead class="text-success">
      							<tr>
      								<th><b>No</th>	
      								<th><b>Nama pekerjaan</th>
      								<th><b>Pengambil pekerjaan</th>
      								<th><b>No hp</th>
      								<th><b>No rekening</th>
      								<th><b>waktu & tgl pengambilan</th>
      							</tr>
			      				</thead>
			      				<tbody>
                      <?php
                      $i = 1;
                      foreach($detail as $d){ 
                        $date = new Datetime($d['created_at']);
                        $waktu = $date->format('h:i:s [d/m/Y]');
                      ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $d['nama']; ?></td>
                        <td><?= $d['nama_petani']; ?></td>
                        <td><?= $d['nohp']; ?></td>
                        <td><?= $d['rekening']; ?></td>
                        <td><?= $waktu; ?></td>
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
