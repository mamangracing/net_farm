       <ul class="nav">
          <li class="nav-item <?php if($this->uri->segment(2) == ''){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- menu dashboard -->
          <?php if($this->session->role_id == 1): ?>
          <li class="nav-item <?php if($this->uri->segment(2) == 'd_petani'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('admin/d_petani'); ?>">
              <i class="material-icons">person</i>
              <p>Daftar Petani</p>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'd_buruh'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('admin/d_buruh'); ?>">
              <i class="material-icons">content_paste</i>
              <p>Daftar buruh tani</p>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'transaksi'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('admin/transaksi'); ?>">
              <i class="material-icons">library_books</i>
              <p>Transaksi Petani</p>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'postingan'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('admin/postingan'); ?>">
              <i class="material-icons">bubble_chart</i>
              <p>Pekerjaan buruh tani</p>
            </a>
          </li>

          <!-- menu petani -->
          <?php elseif($this->session->role_id == 2): ?>          
          <li class="nav-item <?php if($this->uri->segment(2) == 'edit_profile'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('petani/edit_profile'); ?>">
              <i class="material-icons">account_circle</i>
              <p> Profile</p>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'posting'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('petani/posting'); ?>">
              <i class="material-icons">work</i>
              <p>Posting Pekerjaan</p>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'daftar_pekerjaan'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('petani/daftar_pekerjaan'); ?>">
              <i class="material-icons">assignment</i>
              <p>Daftar Pekerjaan</p>
            </a>
          </li>
          
          <!-- menu untuk mitra/buruh tani -->
          <?php else: ?>
          <li class="nav-item <?php if($this->uri->segment(2) == 'riwayat'){ echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('mitra/riwayat'); ?>">
              <i class="material-icons">assignment</i>
              <p>Riwayat Kerja</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./upgrade.html">
              <i class="material-icons">unarchive</i>
              <p>Refund</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./upgrade.html">
              <i class="material-icons">unarchive</i>
              <p>Refund</p>
            </a>
          </li> -->
        <?php endif; ?>
        </ul>