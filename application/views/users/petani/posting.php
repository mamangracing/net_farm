  <?php $this->load->view('users/head'); ?>
  <link rel="stylesheet" type="text/css" href="https://demos.creative-tim.com/material-kit/assets/css/material-kit.min.css?v=2.0.4">
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="col-xl-12"><?= $this->session->flashdata('pesan');?></div>
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
                        <label class="bmd-label-static">*Mulai Pengerjaan</label>
                        <input type="date" id="datepicker" name="tglAwal" class="form-control" min="<?= $date;?>">
                        <div id="ingfo"></div>
                        <?= form_error('batas','<small class="text-danger pl-3 alert-message">','</small>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-static">*Luas Ladang</label>
                        <input name="juru" id="juru" class="form-control" type="number" min="1" max="4" onchange="sum();" placeholder="juru">
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
                        <label class="bmd-label-static">*Harga</label>
                        <input type="text" class="form-control" id="upah" readonly>
                        <input type="number" name="upah" id="harga" hidden>
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
  //$('.alert-message').alert().delay(40000).slideUp('slow');
  
  function sum(){
    let juru = document.getElementById('juru').value;
    let admin = 30/100 * 200000;
    let harga = 200000 - admin;
    let result = parseInt(juru) * harga;
    document.getElementById('harga').value = result;  

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

  // function booking(){
  //   let input = document.getElementById('datepicker');
  //   let date = new Date();

  //   input.min = "2021-07-07";   
  // }

  // booking();

  // var bookedDates;
  // var dateToday = new Date();

  // $.ajax({
  //   type : "GET",
  //   url : "/netfarm/petani/bookings",
  //   success : function(data){
  //     bookedDates = JSON.stringify(data);
  //     console.log(bookedDates);
  //     $('#datepicker').datepicker({
  //       minDate : dateToday,
  //       beforeShowDay : function(date){
  //         var string = jQuery.datepicker.formatDate('yy-mm-dd',date);
  //         return [bookedDates.indexOf(string) == -1];
  //       }
  //     })
  //   }
  // })

  // $(document).ready(function(){
  //   $('#datepicker').click(function(){
  //     $.ajax({
  //       type: "GET",
  //       url : "http://localhost/netfarm/petani/ajax",
  //       dataType: "html",
  //       success : function(response){
  //         $('#ingfo').html(response);
  //       }
  //     })
  //   })
  // })
 
  // jQuery(document).ready(function(){
  //   jQuery('#datepicker').datepicker({
  //     minDate : new Date(2021, 1, 1),
  //     dateFormat : 'dd-mm-yy',
  //     changeMonth : true,
  //     changeYear : true,
  //     constrainInput : true,
  //     beforeShowDay : nationalDays
  //   })

  //   function my_check(in_date){
  //     in_date = in_date.getDate() + '-' + (in_date.getMonth()+1) + '-' + in_date.getFullYear();
  //     let my_array = new Array('9-6-2021','10-6-2021');

  //     //tidak bisa melakukan booking pada tanggal yang sudah lampau
  //     console.log(in_date);

  //     //cek apakah sudah ada yang booking jika sudah ada yang booking maka tidak bisa booking di tanggal yang sama
  //     if(my_array.indexOf(in_date) >= 0){
  //       return [false, "notav", 'Not Available'];
  //     } else {
  //       return [true, "av", 'Available'];
  //     }
  //   }
  // })
  
  // let disabled = ["01-01-2021"];

  // function nationalDays(date){
  //   let m = date.getMonth()
  //   let d = date.getDate()
  //   let y = date.getFullYear()

  //   for(i = 0; i < disabled.length; i++){
  //     if($.inArray((m+1) + '-' + d + '-' +y,disabled) != -1 || new Date() > date){
  //       return [false];
  //     }
  //   }
  //   console.log(new Date());
  //   return [true];
  // }

  // function noWeekendsOrHolidays(date){
  //   let noWeekend = jQuery.datepicker.noWeekends(date);
  //   return noWeekend[0 ] ? nationalDays(date) : noWeekend;
  // }

  // jQuery(document).ready(function(){
  //   jQuery('#date').datepicker({
  //     minDate : new Date(2021, 0, 1),
  //     maxDate : new Date(2021, 12, 31),
  //     dateFormat : 'DD, MM, d, yy',
  //     constrainInput : true,
  //     beforeShowDay : noWeekendsOrHolidays
  //   })
  // })


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