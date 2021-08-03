<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?= $title; ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <!-- CSS Files -->
  <link href="<?= base_url('assets/'); ?>css/material-kit.css?v=2.0.6" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url('assets/'); ?>demo/demo.css" rel="stylesheet" />
  <style type="text/css">
      #loading {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('<?= base_url('assets/'); ?>img/preloader.gif') 50% 50% no-repeat #fff;
    }
  </style>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
   
  <!-- Preloader -->
  <script type="text/javascript">
    // $(window).load(function() { $("#loading").delay(1000000).fadeOut("slow"); })
    $(window).load(function() { $("#loading").fadeOut("slow"); })
  </script>

</head>
</head>
<body class="login-page sidebar-collapse">
 <!--  <div id="loading"></div> -->
   <div class="page-header header-filter" style="background-image: url('<?= base_url('assets/'); ?>img/bg02.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="post" action="<?= base_url('login'); ?>">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title"> Silakan Masukan Email dan Password Anda</h4>
                <!-- <div class="social-line">

      
                </div> -->
              </div>
              <div class="card-body">

                <?= $this->session->flashdata('pesan'); ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="Email...">
                  <?= form_error('email','<small class="text-danger pl-3 error-message">','</small>'); ?>
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password..." name="password">
                  <?= form_error('password','<small class="text-danger pl-3 error-message">','</small>'); ?>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-wd btn-lg">Masuk</button>
              </div>
              <div class="text-center">
                <a href="<?= base_url('Daftar');?>">Belum Punya Account !!</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://heartscode.net">
              Coded with <i class="material-icons">favorite</i> by Heartscode
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
       NETFARM &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="<?= base_url('assets/'); ?>js/core/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>js/plugins/moment.min.js"></script>
  <!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="<?= base_url('assets/'); ?>js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?= base_url('assets/'); ?>js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('assets/'); ?>js/material-kit.js?v=2.0.6" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });
    $('.alert-message').alert().delay(3000).slideUp('slow');
    $('.error-message').alert().delay(1500).slideUp('slow');

    // function scrollToDownload() {
    //   if ($('.section-download').length != 0) {
    //     $("html, body").animate({
    //       scrollTop: $('.section-download').offset().top
    //     }, 1000);
    //   }
    // }

  </script>
</body>

</html>