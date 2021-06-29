<?php $this->load->view('users/head.php'); ?>


<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/'); ?>/dash/img/sidebar-1.jpg">
      <div class="logo">
        <a href="<?= base_url('dashboard');?>" class="simple-text logo-normal">
          <?php if($this->session->userdata('role_id') == 1){ echo "Admin"; } else if($this->session->userdata('role_id') == 2){ echo "Petani";} else { echo "Mitra";}?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <?php
        $this->load->view('users/menu.php'); 
        ?>
      </div>
    </div>
    <div class="main-panel ps-container ps-theme-default" lass="main-panel">
    <!-- menu -->
    <?php $this->load->view('users/nav'); ?>
    <!-- end menu -->
      <!-- contents -->
      <?php 
      if($this->session->role_id == 1):
        $this->load->view('users/v_admin');
      elseif($this->session->role_id == 2):
        $this->load->view('users/v_petani');
      else:
        $this->load->view('users/v_buruh');
      endif;
      ?>
      <!-- end contents -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Coded with <i class="material-icons">favorite</i> by
            <a href="https://heartscode.net" target="_blank">Team Hore</a> 
          </div>
        </div>
      </footer>
    </div>
  </div>

<?php $this->load->view('users/js'); ?>