<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?=$title?></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg"/>
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css"/>
    <link rel="stylesheet" href="assets/css/tiny-slider.css"/>
    <link rel="stylesheet" href="assets/css/glightbox.min.css"/>
    <link rel="stylesheet" href="assets/css/animate.css"/>
    <link rel="stylesheet" href="assets/css/lindy-uikit.css"/>
  </head>
  <body style="background: #E5E5E5">
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <!-- <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- ========================= preloader end ========================= -->






    <!-- ========================= hero-section-wrapper-2 start ========================= -->
    <section class="hero-section-wrapper-2 mb-100">

      <!-- ========================= header-2 start ========================= -->
      <header class="header header-2">
        <div class="navbar-area">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                  <a class="navbar-brand" href="index.html">
                    <img src="assets/images/logo/logo.png" alt="Logo" />
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent2">
                    <ul id="nav2" class="navbar-nav ml-auto">
                      <li class="nav-item">
                        <a class="page-scroll" href="index.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#0">About Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#0">Service</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#0">Feature</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="#0">Price</a>
                      </li>
                      <?php if ($loggedIn == false): ?>
                        <li class="nav-item">
                          <a class="page-scroll" href="index.php?login">Login</a>
                        </li>
                      <?php endif; ?>
                      <?php if ($loggedIn): ?>
                        <li class="nav-item">
                          <a class="page-scroll" href="index.php?admin/users">Dashboard</a>
                        </li>
                        <li class="nav-item">
                          <a class="page-scroll" href="index.php?logout">Logout</a>
                        </li>
                      <?php endif; ?>
                    </ul>
                    <?php if ($loggedIn == false): ?>
                      <a href="index.php?user/register" class="button button-sm radius-10 d-none d-lg-flex">Get Started</a>
                    <?php endif; ?>
                  </div>
                  <!-- navbar collapse -->
                </nav>
                <!-- navbar -->
              </div>
            </div>
            <!-- row -->
          </div>
          <!-- container -->
        </div>
        <!-- navbar area -->
      </header>
      <!-- ========================= header-2 end ========================= -->

      <?=$output?>

      <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.5.0.0.alpha-2-min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/imagesloaded.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/public-main.js"></script>

    <script>

      // ============= video popup
      GLightbox({
        'href': 'assets/video/video.mp4',
        'type': 'video',
        'source': 'local', //vimeo, youtube or local
        'width': 900,
        'autoplayVideos': true,
      });

      // header-2  toggler-icon
      let navbarToggler2 = document.querySelector(".header-2 .navbar-toggler");
      var navbarCollapse2 = document.querySelector(".header-2 .navbar-collapse");

      document.querySelectorAll(".header-2 .page-scroll").forEach(e =>
          e.addEventListener("click", () => {
              navbarToggler2.classList.remove("active");
              navbarCollapse2.classList.remove('show')
          })
      );
      navbarToggler2.addEventListener('click', function() {
          navbarToggler2.classList.toggle("active");
      })
      

      // header-4  toggler-icon
      let navbarToggler4 = document.querySelector(".header-4 .navbar-toggler");
      var navbarCollapse4 = document.querySelector(".header-4 .navbar-collapse");

      document.querySelectorAll(".header-4 .page-scroll").forEach(e =>
          e.addEventListener("click", () => {
              navbarToggler4.classList.remove("active");
              navbarCollapse4.classList.remove('show')
          })
      );
      navbarToggler4.addEventListener('click', function() {
          navbarToggler4.classList.toggle("active");
      }) 

    </script>
     <p class="text-center pb-30 pt-30">You are using free lite version - <a href="https://rebrand.ly/ud-lindy/">Get Full Version of Lindy UI Kit</a></p> 

  </body>
</html>
