<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- End Alpine JS -->

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- End -->

    <!-- CSS Customer -->
    <!-- <link rel="stylesheet" href="tmplt/css/main.css"> -->
    <!-- END -->

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Toko SRC Desi</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="tmplt/page/assets/img/973032153.png" rel="icon">
    <link href="tmplt/page/assets/img/973032153.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Fonts Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="tmplt/page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="tmplt/page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="tmplt/page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="tmplt/page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="tmplt/page/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="tmplt/page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="tmplt/page/assets/css/style.css" rel="stylesheet">


    <link href="tmplt/admin/libs/sweetalert2/sweetalert2.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
        <img src="tmplt/web/assets/logo/1615924238.png" alt="">
        <span>Toko SRC Desi</span>
      </a>

            <!-- Navbar -->
            <nav id="navbar" class="navbar">
                <ul>

                    <div class="search-form">
                        <input type="search" id="search-box" placeholder="search here...">
                        <label for="search-box"><i data-feather="search"></i></label>

                    </div>

                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#mitra">Mitra</a></li>
                    <li class="dropdown"><a class="nav-link scrollto" href="#profil"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a class="nav-link scrollto" href="#visi">Visi</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#info">Produk</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('user.login') }}"><i data-feather="shopping-cart"></i></a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>

            </nav>
            <!-- Navbar END -->

        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Toko Desi</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Belanja Murah dan Hemat Hanya di Toko Desi</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="{{ route('user.login') }}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="tmplt/page/assets/img/toko.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->

    <!-- ======= Clients Section ======= -->
    <section id="mitra" class="clients">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>Mitra</h2>
                <p>Mitra kami</p>
            </header>

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/152720908.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/42271369.jpg" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/1927435186.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/639048054.png" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/1269164333.jpg" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/1356926331.jpg" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="tmplt/web/assets/mitra/546420493.jpg" class="img-fluid" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </section>
    <!-- End Clients Section -->

    <main id="main">



        <!-- ======= Profil Section ======= -->

        <div class="profil" id="profil">
            <section id="visi" class="features">
                <div class="container" data-aos="fade-up">

                    <header class="section-header">
                        <h2>Profil</h2>
                        <p>VISI</p>
                    </header>

                    <!-- Feature Tabs -->
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center mb-1" data-aos="zoom-out">
                            <h3 class="align-middle m-3 mb-5" style="color:rgb(30, 7, 241); font-style: italic">"Menjadi toko kelontong modern dan terpercaya yang menyediakan kebutuhan sehari-hari dengan harga terjangkau, pelayanan ramah, serta pengalaman belanja yang nyaman dan menyenangkan bagi setiap pelanggan."</h3>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up">
                            <img src="tmplt/page/assets/img/aqil.jpg" class="img-fluid animated" alt="">
                        </div>

                    </div>
                    <!-- End Feature Tabs -->


                </div>
            </section>

            <section id="misi" class="features">
                <div class="container" data-aos="fade-up">

                </div>

        </div>
        <!-- / row -->

        </div>
        </section>
        </div>

        <!-- Feature Icons -->
        <section id="layanan" class="values">
            <div class="container" data-aos="fade-up">
                <header class="section-header">

                </header>


                <div class="layanan-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </section>
        <!-- End Values Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="info" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <p>Produk</p>
                </header>

                <div class="container mt-4">
                    <div class="row row-cols-2 row-cols-md-4 g-4">
                        <div class="col">
                            <div class="card text-center">
                                <img src="tmplt/page/assets/img/sunlight.jpg" class="card-img-top" alt="Sabun Sunlight">
                                <div class="card-body">
                                    <h5 class="fw-bold">Sabun Sunlight 800 ml</h5>
                                    <p class="text-muted">IDR 15.000</p>
                                    {{-- <a href="#"><i data-feather="shopping-cart"></i></a> --}}
                                    <a href="">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Recent Blog Posts Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Desa Kebulen <br> Kebulen, Indramayu 45273<br> Jawa Barat</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Telepon</h3>
                                    <p>082118897781</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-clock"></i>
                                    <h3>Jam Operasional</h3>
                                    <p>Senin - Minggu<br>08:00 - 21:00</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 ">
                        <h3 class="text-center" style="color:rgb(66, 11, 249); font-weight: 650">Kritik & Saran</h3>
                        <form action="tmplt/store" method="post" class="p-3">
                            <input type="hidden" name="_token" value="XLnv0yfYCpCVA2GWszVTVhovRO21YN4qOtrBUEOz">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama" required>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="pesan" rows="6" placeholder="Pesan" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </section>
        <!-- End Contact Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div data-aos="zoom-out" class="footer-newsletter">
            <iframe src="https://www.google.com/maps/embed?pb=!4v1741700280405!6m8!1m7!1s46_OVkzAWytvPkOl93NAIw!2m2!1d-6.458193321260522!2d108.2930449866286!3f17.2!4f-5.439999999999998!5f0.4000000000000002" width="100%" height="100%" style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="tmplt" class="logo d-flex align-items-center">
              <img src="tmplt/web/assets/logo/1615924238.png" alt="">
              <span>Toko Desi</span>
            </a>
                        <p>Belanja Murah dan Hemat Hanya di Toko Desi</p>
                        <div class="social-links mt-3">
                            <a href="fb" class="facebok"><i class="bi bi-facebook"></i></a>
                            <a href="lorem ipsum" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="lorem ipsum" class="youtube"><i class="bi bi-youtube"></i></a>
                            <a href="lorem ipsum" class=""><i class="bi bi-cart4"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Menu</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a class="scrollto" href="#hero">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a class="scrollto" href="#profil">Profil</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a class="scrollto" href="#blog">Info Produk</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a class="scrollto" href="#contact">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Layanan</h4>
                        <ul>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>
                            Desa Kebulen <br> Kebulen, Indramayu 45273<br> Jawa Barat <br><br>
                            <strong>Phone:</strong> 082118897781<br>
                            <strong>Email:</strong> desisrc@gmail.com<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                2025 Copyrights reserved by <strong><span>Toko SCR Desi</span></strong>.
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="tmplt/page/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="tmplt/page/assets/vendor/aos/aos.js"></script>
    <script src="tmplt/page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="tmplt/page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="tmplt/page/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="tmplt/page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="tmplt/page/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="tmplt/page/assets/js/main.js"></script>


    <script src="tmplt/admin/libs/sweetalert2/sweetalert2.js"></script>



    <script>
        feather.replace();
    </script>

</body>


</html>