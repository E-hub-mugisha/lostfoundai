<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ config('app.name') }}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="new/assets/img/favicon.png" rel="icon">
  <link href="new/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="new/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="new/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="new/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="new/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="new/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="new/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">{{ config('app.name') }}</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Sign In</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="hero-content">
              <h1>{{ config('app.name', 'Lost & Found AI') }}</h1>
              <p>Quickly report and recover lost identification documents with AI-powered image recognition and OCR technology.</p>
              <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
              </div>
              <div class="hero-stats">
                <div class="stat-item">
                  <span class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $lostIdCount }}" data-purecounter-duration="1"></span>
                  <span class="stat-label">Lost IDs</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $foundIdCount }}" data-purecounter-duration="1"></span>
                  <span class="stat-label">Found IDs</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="{{ $userCount }}" data-purecounter-duration="1"></span>
                  <span class="stat-label">System Users</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="hero-visual">
              <div class="hero-image">
                <img src="new/assets/img/24751.jpg" alt="Digital Agency Hero" class="img-fluid" style="width: 100%; height: 25rem;">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="hero-bg-elements">
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
        <div class="bg-particles"></div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 align-items-center">

          <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
            <div class="content">
              <h6 class="subtitle">{{ config('app.name', 'Lost & Found AI') }}</h6>
              <h2>Innovative Solutions for a Digital-First World</h2>
              <p>
                Our platform leverages cutting-edge technology to streamline the process of reporting and recovering lost identification documents.
              </p>

              <ul class="features-list">
                <li><i class="bi bi-check-circle-fill"></i><span>AI-Powered Image Recognition</span></li>
                <li><i class="bi bi-check-circle-fill"></i><span>Advanced OCR Technology</span></li>
                <li><i class="bi bi-check-circle-fill"></i><span>Seamless User Experience</span></li>
              </ul>

              <a href="{{ route('login') }}" class="btn btn-primary">Discover More</a>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
            <div class="image-composition">
              <div class="image-main">
                <img src="new/assets/img/24751.jpg" alt="Modern office with a team working" class="img-fluid" loading="lazy" style="width: 100%; height: 25rem;">
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Explore the key features that make our platform unique and effective.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-palette"></i>
              </div>
              <h4><a href="#">Report Lost IDs</a></h4>
              <p>Easily submit lost identification documents with images and detailed information for fast recovery.</p> 
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-layout-text-window-reverse"></i>
              </div>
              <h4><a href="#">AI-Powered Matching</a></h4>
              <p>Quickly match lost and found documents using advanced AI algorithms for accurate results.</p>
              
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-code-slash"></i>
              </div>
              <h4><a href="#">Instant Notifications</a></h4>
              <p>Receive real-time alerts when a lost document matching your report is found.</p>
            </div>
          </div>

        </div>

        <div class="row mt-5">
          <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="400">
            <div class="services-cta">
              <h3>Ready to Transform Your Digital Presence?</h3>
              <p>Let's discuss your project and create something amazing together</p>
              <a href="#" class="btn btn-primary">Get Started Today</a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->


  </main>

  <footer id="footer" class="footer position-relative dark-background">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('app.name') }}</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="new/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="new/assets/vendor/php-email-form/validate.js"></script>
  <script src="new/assets/vendor/aos/aos.js"></script>
  <script src="new/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="new/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="new/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="new/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="new/assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="new/assets/js/main.js"></script>

</body>

</html>