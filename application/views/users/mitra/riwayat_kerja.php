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
      			<div class="col-lg-12">
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
      							<tr>
      								<th><b>No</th>	
      								<th><b>Nama Pekerjaan</th>
      								<th><b>Upah</th>
      								<th><b>Total</th>
                      <th><b>Status</b></th>
                      <th class="td-action"><b>Action</b></th>
      							</tr>
			      				</thead>
			      				<tbody>
                      <?php
                      $i = 1;
                      foreach($data as $d){
                        $total = $d['upah'];
                        $status = $d['work_status'] == 0 ? "belum di kerjakan" : "sedang di kerjakan";
                      ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $d['nama_pekerjaan']; ?></td>
                        <td><?= $d['upah']; ?></td>
                        <td><?= $total; ?></td>
                        <td><?= $status; ?></td>
                        <td>
                          <a href="#" rel="tooltip" data-placement="top" class="btn btn-primary" title="Edit">
                            <i class="material-icons">assignment</i>
                          </a>
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
