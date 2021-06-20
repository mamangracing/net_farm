  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://heartscode.net">
              Heartscode
            </a>
          </li>
          <li>
            <a href="<?= base_url(); ?>about-us">
              About Us
            </a>
          </li>
          <li>
            <a href="https://heartscode.net">
              Blog
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://heartscode.net" target="_blank">Heartscode</a>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="<?= base_url('assets/'); ?>js/core/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
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

    // function scrollToDownload() {
    //   if ($('.section-download').length != 0) {
    //     $("html, body").animate({
    //       scrollTop: $('.section-download').offset().top
    //     }, 1000);
    //   }
    // }
    $('.alert-message').alert().delay(3000).slideUp('slow');
  </script>
</body>

</html>