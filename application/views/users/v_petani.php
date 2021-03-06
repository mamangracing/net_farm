      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">view_list</i>
                  </div>
                  <p class="card-category">Posting Pekerjaan</p>
                  <h3 class="card-title"><?= $this->db->get('trans_post')->num_rows(); ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-xl-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Jumlah postingan</p>
                  <h3 class="card-title"><?= $this->db->get('Pekerjaan')->num_rows(); ?></h3></div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div>
                </div>
              </div>
            </div>