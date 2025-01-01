<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sispert - Sistem Pengaduan RT RW</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
  <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">

  <link rel="icon" href="/img/logo.png" />

  <!-- Vendor CSS Files -->
  {{--
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> --}}

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/css/landing.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sispert
  * Template URL: https://bootstrapmade.com/Sispert-bootstrap-Sisperttics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center mr-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="/img/logo.png" alt=""> -->
        <h1 class="sitename">Sispert</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="active">Home<br></a></li>
          <li><a href="#cara-kerja">Cara Kerja</a></li>
          <li><a href="#fitur">Fitur</a></li>
          <li><a href="#testimonial">Testimonial</a></li>
          <li><a href="#faq">FAQ</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="/auth/login" target="_blank">Masuk</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="/img/world-dotted-map.png" alt="" class="hero-bg" data-aos="fade-in">

      <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2 data-aos="fade-up">Solusi Cepat untuk Pengaduan Warga di Lingkungan RT/RW Anda</h2>
            <p data-aos="fade-up" data-aos-delay="100">
                Mudah, Cepat, Transparan – Tingkatkan Pelayanan Warga dengan Sistem Informasi Pengaduan RT dan RW yang Terintegrasi.
            </p>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">

              <div class="col-lg-3 col-6">
                <div class="stats-item text-center w-100 h-100">
                  <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="0" class="purecounter">232</span>
                  <p>Diproses</p>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-3 col-6">
                <div class="stats-item text-center w-100 h-100">
                  <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="0" class="purecounter">521</span>
                  <p>Diterima</p>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-3 col-6">
                <div class="stats-item text-center w-100 h-100">
                  <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="0" class="purecounter">1453</span>
                  <p>Selesai</p>
                </div>
              </div><!-- End Stats Item -->

            </div>

            <a class="btn btn-primary btn-lg" href="/auth/register">
                Daftar Pengguna
            </a>

          </div>

          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="/img/undraw_feedback_tmp7.svg" class="img-fluid mb-3 mb-lg-0" alt="">
          </div>

        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-cart-flatbed"></i></div>
            <div>
              <h4 class="title">Efisiensi Proses Pengaduan</h4>
              <p class="description">Warga dapat dengan mudah menyampaikan laporan kapan saja, tanpa harus datang langsung.</p>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-truck"></i></div>
            <div>
              <h4 class="title">Mudah Digunakan</h4>
              <p class="description">Antarmuka sederhana yang ramah pengguna untuk warga dan pengurus RT/RW.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-truck-ramp-box"></i></div>
            <div>
              <h4 class="title">Rekam Jejak Pengaduan</h4>
              <p class="description">Simpan semua riwayat laporan untuk evaluasi dan perbaikan layanan di masa depan.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
            <img src="/img/about.jpg" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100" id="cara-kerja">
            <h3>Bagaimana Sistem Ini Bekerja?</h3>
            <p>
                Sispert adalah sistem informasi pengaduan RT dan RW yang terintegrasi.
            </p>
            <ul>
              <li>
                <i class="bi bi-diagram-3"></i>
                <div>
                  <h5>Warga Melapor</h5>
                  <p>Warga memasukkan laporan melalui aplikasi atau website.</p>
                </div>
              </li>
              <li>
                <i class="bi bi-fullscreen-exit"></i>
                <div>
                  <h5>Verifikasi oleh Pengurus RT/RW</h5>
                  <p>Pengurus menerima, memverifikasi, dan mendistribusikan laporan.</p>
                </div>
              </li>
              <li>
                <i class="bi bi-broadcast"></i>
                <div>
                  <h5>Tindak Lanjut</h5>
                  <p>Tim terkait menangani laporan sesuai prioritas.</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="/img/cta-bg.jpg" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>
                Ingin mencoba sispert?
              </h3>
              <p>
                Silahkan klik tombol berikut untuk mendaftar.
              </p>
              <a class="cta-btn" href="/auth/register">
                Daftar
              </a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    <!-- Features Section -->
    <section id="fitur" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Features</span>
        <h2>Features</h2>
        <p>
            Sispert adalah sistem informasi pengaduan RT dan RW yang terintegrasi.
        </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="/img/features-1.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <h3>Pengaduan Online</h3>
            <p class="fst-italic">
                Warga dapat dengan mudah mengajukan pengaduan melalui aplikasi atau website, tanpa perlu datang langsung ke kantor RT/RW.
            </p>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="/img/features-2.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
            <h3>Unggah Bukti Pendukung</h3>
            <p class="fst-italic">
                Warga dapat melampirkan foto, video, atau dokumen sebagai bukti pendukung untuk memberikan gambaran yang lebih jelas mengenai pengaduan mereka.
            </p>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
            <img src="/img/features-3.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up">
            <h3>Arsip dan Riwayat Pengaduan</h3>
            <p>Semua pengaduan yang pernah diajukan akan tersimpan dalam arsip digital, memudahkan pengurus RT/RW untuk melakukan evaluasi dan perencanaan di masa depan.</p>
          </div>
        </div><!-- Features Item -->

      </div>

    </section><!-- /Features Section -->

    <!-- Testimonials Section -->
    <section id="testimonial" class="testimonials section dark-background">

      <img src="/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Budi Santoso</h3>
                <h4>Ketua RW 02</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Dengan sistem ini, pengaduan warga jadi lebih mudah dikelola. Warga pun lebih puas dengan respon yang cepat dan terukur.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Rina</h3>
                <h4>Ketua RW 03</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Dulu saya sering kesulitan melapor. Sekarang, tinggal klik, semua tersampaikan dengan jelas.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->


            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Frequently Asked Questions</span>
        <h2>Frequently Asked Questions</h2>
        <p>Pertanyaan yang sering diajukan</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="faq-container">

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Apa itu Sistem Informasi Pengaduan RT dan RW?</h3>
                <div class="faq-content">
                  <p>
                    Sistem ini adalah platform digital yang dirancang untuk mempermudah warga dalam menyampaikan pengaduan terkait permasalahan di lingkungan RT/RW. Dengan sistem ini, laporan dapat dikelola secara efisien oleh pengurus RT/RW, mulai dari penerimaan hingga penyelesaian.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="300">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Bagaimana cara warga mengajukan pengaduan?</h3>
                <div class="faq-content">
                  <p>
                    Warga dapat mengakses sistem melalui aplikasi mobile atau website, lalu mengisi formulir pengaduan yang telah disediakan. Setelah pengaduan diajukan, warga akan mendapatkan nomor laporan untuk memantau status pengaduannya.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="400">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Siapa yang dapat mengakses laporan pengaduan?</h3>
                <div class="faq-content">
                  <p>
                    Hanya warga yang mengajukan laporan dan pengurus RT/RW yang berwenang dapat mengakses detail laporan tersebut. Sistem ini menjamin privasi dan keamanan data setiap pengguna.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Faq Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Sispert</span>
          </a>
          <p>Mudah, Cepat, Transparan – Tingkatkan Pelayanan Warga dengan Sistem Informasi Pengaduan RT dan RW yang Terintegrasi.</p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Sispert</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  {{-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script> --}}

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  {{-- <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> --}}

  <!-- Main JS File -->
  <script src="/js/landing.js"></script>

  <script>
    AOS.init();
  </script>

</body>

</html>
