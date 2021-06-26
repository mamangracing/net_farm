      <?php $this->load->view('users/head'); ?>
        <link rel="stylesheet" type="text/css" href="https://demos.creative-tim.com/material-kit/assets/css/material-kit.min.css?v=2.0.4">
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Posting Pekerjaan</h4>
                <p class="card-category">Silahkan Lengkapi Form Tertera</p>
              </div>
              <div class="card-body">
                <?= form_open_multipart('petani/posting');?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-static">*Nama Pekerjaan</label>
                        <input type="text" class="form-control" name="nama" required="">
                        <?= form_error('nama','<small class="text-danger pl-3 alert-message">','</small>'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-static">*Batas Waktu Pengerjaan</label>
                        <input type="text" class="form-control datepicker" name="batas" id="date">
                        <?= form_error('batas','<small class="text-danger pl-3 alert-message">','</small>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-static">*Panjang Ladang</label>
                        <input name="juru" id="juru" class="form-control" type="number" min="1" max="100" onchange="sum();" placeholder="juru">
                        <?= form_error('juru','<small class="text-danger pl-3 alert-message">','</small>');?>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <input type="text" class="form-control" value="Rp" disabled>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="bmd-label-static">*Upah</label>
                        <input type="text" class="form-control" name="upah" id="upah" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="fileinput">
                        <label class="bmd-label-floating">*Gambar sawah/ladang</label>
                        <?= form_error('image','<small class="text-danger pl-3 alert-message">','</small>'); ?>                        
                        <input type="file" class="file-input form-control" name="image" required="">

                      </div>
                    </div>
                  </div>
                  <p class="text-warning">Semua form yang bertanda * harus di isi !</p>
                  <button type="submit" class="btn btn-primary pull-right">Posting</button>
                  <div class="clearfix"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script>
  
  function sum(){
    let juru = document.getElementById('juru').value;
    let result = parseInt(juru) * 285000; 

    let number = result.toString();
    let sisa = number.length % 3;
    let rupiah = number.substr(0, sisa);
    let ribuan = number.substr(sisa).match(/\d{3}/g);

    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    if(!isNaN(result)){
      document.getElementById('upah').value = rupiah;
    }
  }

  //booking tanggal
  let tanggal = new Datepicker(document.getElementById('date'));

</script>

<!-- <script type="text/javascript">
  $(function () {
  $('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});
});
</script> -->
<?php $this->load->view('users/js.php'); ?>