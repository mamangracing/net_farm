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
<body class="index-page sidebar-collapse">
  <div id="loading"></div>
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="">
          NETFARM </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      
      <?php

      if($this->session->userdata('email')){

      } else {
        ?>
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('login'); ?>" onclick="scrollToDownload()">
                  <i class="material-icons">assignment_returned</i> Masuk
                </a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="<?= base_url('daftar'); ?>"><?= $this->session->role_id == 2 ? 'Dashboard' : ($this->session->role_id == 3 ? 'Dashboard' : 'Daftar User' )?>
              <i class="material-icons">assignment_returned</i> 
              </a>
            </li>
              
              <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Follow us on Twitter">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/Heartscode_" target="_blank" data-original-title="Like us on Facebook">
                  <i class="fa fa-facebook-square"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/Heartscode_" target="_blank" data-original-title="Follow us on Instagram">
                  <i class="fa fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        <?php
      }
      ?>
    </div>
  </nav>