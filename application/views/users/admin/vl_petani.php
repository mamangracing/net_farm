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
            <div class="col-xl-12"><?= $this->session->flashdata('pesan');?></div>
      			<div class="col-lg-12">
      				<div class="card">
	      				<div class="card-header card-header-success">
	      					<h4 class="card-title">Daftar Petani</h4>
	      					<p class="card-category">New employees on 15th September, 2019</p>
      					</div>
      					<div class="card-body table-responsive">
      						<table class="table table-hover" id="table-datatable">
      							<thead class="text-success">
      							<tr>
      								<th><b>No</th>	
      								<th><b>Nama</th>
      								<th><b>Alamat</th>
      								<th><b>No hp</th>
      								<th><b>No rekening</th>
      								<th><b>Action</th>
      							</tr>
			      				</thead>
			      				<tbody>
			      					<?php
			      					$i = 1;
			      					$arr = json_decode($json,true);
			      					foreach($arr as $value){ ?>
			      						<tr>
			      							<td><?= $i++ ?></td>
			      							<td><?= $value['nama']; ?></td>
			      							<td><?= $value['alamat']; ?></td>
			      							<td><?= $value['nohp']; ?></td>
			      							<td><?= $value['rekening']; ?></td>
			      							<td class="td-actions">
			      								<a rel="tooltip" href="<?= base_url('admin/prof_petani/'.$value['id_user']);?>" class="btn btn-info">
								                    <i class="material-icons">person</i>
								                </a>
								                <button type="button" rel="tooltip" class="btn btn-success" data-target="#ModalEdit<?= $value['id_user']; ?>" data-toggle="modal">
								                    <i class="material-icons">edit</i>
								                </button>
								                <a href="<?= base_url('admin/hapus/'.$value['id_user']); ?><?php echo '/'.$value['role_id']; ?>" rel="tooltip" class="btn btn-danger delete_user">
                                    <i class="material-icons">close</i>
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
  <script type="text/javascript">
    $ ('.delete_user').on("click", function (e) {
    e.preventDefault ();
      // swal("Good job!", "You clicked the button!", "success");
      var url = $ (this).attr('href');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm : false  
      }).then((result) => {
        if (result.value) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          setTimeout(
          function() 
          {
            window.location.replace(url);
          }, 1500);
        
        }
      })

    });
  </script> 
<?php $this->load->view('users/admin/modal'); ?>

<?php $this->load->view('users/js.php'); ?>
