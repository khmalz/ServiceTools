<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Service Tools</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('user/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('user/assets/img/workle-touch-icon.png') }}" rel="workle-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('user/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/toastify/toastify.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('user/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    @auth
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your
                        current
                        session.</div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center container">

            <h1 class="logo me-auto"><a href="{{ route('home') }}">Service Tools</a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#contact">Contact</a></li>
                    @auth
                        <li class="dropdown"><a href="#"><span>Welcome</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard') }}">{{ auth()->user()->name }}</a>
                                </li>
                                <li>
                                    <a role="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="getstarted">Login</a></li>
                    @endauth
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active"
                    style="background-image: url({{ asset('user/assets/img/slide/slide-1.jpg') }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Pelayanan Servis Terpercaya</h2>
                            <p class="animate__animated animate__fadeInUp">Kami memberikan layanan servis alat
                                elektronik yang dapat Anda andalkan. Dengan tim teknisi berkualitas, kami siap
                                memperbaiki perangkat Anda dengan cepat dan efisienz.</p>
                            <a href="{{ url('#about') }}"
                                class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item"
                    style="background-image: url({{ asset('user/assets/img/slide/slide-2.jpg') }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Solusi Servis Komprehensif</h2>
                            <p class="animate__animated animate__fadeInUp">Dari perbaikan hingga pemeliharaan berkala,
                                kami menyediakan beragam solusi servis untuk semua jenis alat elektronik. Percayakan
                                perangkat Anda kepada kami untuk kinerja yang optimal.</p>
                            <a href="{{ url('#about') }}"
                                class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item"
                    style="background-image: url({{ asset('user/assets/img/slide/slide-3.jpg') }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Pelayanan Pelanggan Utama</h2>
                            <p class="animate__animated animate__fadeInUp">Kepuasan pelanggan adalah prioritas utama
                                kami. Kami memberikan servis yang ramah pelanggan, transparan, dan berorientasi pada
                                kebutuhan Anda. Lihatlah apa yang bisa kami lakukan untuk Anda.</p>
                            <a href="{{ url('#about') }}"
                                class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="{{ url('#heroCarousel') }}" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="{{ url('#heroCarousel') }}" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row content">
                    <div class="col-lg-6">
                        <h2>Tentang Kami</h2>
                        <h3>Platform Layanan Servis Alat Elektronik</h3>
                    </div>
                    <div class="col-lg-6 pt-lg-0 pt-4">
                        <p>
                            Solusi terpercaya untuk kebutuhan servis alat elektronik Anda. Kami berkomitmen untuk
                            memberikan pelayanan servis yang berkualitas tinggi dengan teknisi berpengalaman, sehingga
                            Anda dapat memperoleh alat elektronik dalam kondisi optimal secepat mungkin. Kami menawarkan
                            beragam layanan servis elektronik, yang bahkan bisa dilakukan di rumah anda!. Dengan layanan
                            pelanggan terbaik dan fokus pada kepuasan
                            Anda, Service Tools hadir untuk memudahkan Anda dalam menjaga kinerja alat elektronik Anda.
                        </p>
                        <ul>
                            <li><i class="bx bx-check-double"></i>Membuat Permintaan Layanan</li>
                            <li><i class="bx bx-check-double"></i>Penjadwalan dan Konfirmasi</li>
                            <li><i class="bx bx-check-double"></i>Layanan Profesional</li>
                            <li><i class="bx bx-check-double"></i>Pembayaran Mudah</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-work">Work</li>
                            <li data-filter=".filter-home">Home</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-1.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 1</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-1.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 1"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-3.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 2</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-3.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 2"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-4.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 3</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-4.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 3"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-home">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-2.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Home 1</h4>
                                <p>Home</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-2.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Home 1"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-home">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-5.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Home 2</h4>
                                <p>Home</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-5.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Home 2"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 4</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-7.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 4"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 5</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-8.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 5"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-home">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-6.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Home 3</h4>
                                <p>Home</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-6.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Home 3"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-10.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 6</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-10.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 6"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-home">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-11.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Home 4</h4>
                                <p>Home</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-11.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Home 4"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-work">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-13.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Work 7</h4>
                                <p>Work</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-13.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Work 7"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-home">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Home 5</h4>
                                <p>Home</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-9.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Home 5"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-home">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('user/assets/img/portfolio/portfolio-12.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-info">
                                <h4>Home 6</h4>
                                <p>Home</p>
                                <div class="portfolio-links">
                                    <a href="{{ url('assets/img/portfolio/portfolio-12.jpg') }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Home 6"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="{{ url('portfolio-details.html') }}" class="portfolio-details-lightbox"
                                        data-glightbox="type: external" title="Portfolio Details"><i
                                            class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Portfolio Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Jalan Pemuda Raya, Jakarta Timur, DKI Jakarta</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>servicetools.work@gmail.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>+62 878 8125 4931</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8 mt-lg-0 mt-5">

                        <form action="" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-md-0 mt-3">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>

                    </div>

                </div>

            </div>
        </section>
        <!-- End Contact Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>Service Tools</h3>
                            <p class="d-flex flex-column">
                                <span class="mb-2">Jalan Pemuda Raya <br> Jakarta Timur, DKI Jakarta</span>
                                <span><strong>Phone:</strong> +62 878 8125 4931</span>
                                <span><strong>Email:</strong> servicetools.work@gmail.com</span>
                            </p>
                            <div class="social-links mt-3">
                                <a href="{{ url('#') }}" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="{{ url('#') }}" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="{{ url('#') }}" class="instagram"><i class="bx bxl-instagram"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Section Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">Terms of
                                    service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">Privacy policy</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">TV</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">Kulkas</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">Setrika</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">AC</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('#') }}">Lainnya</a></li>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy;Copyright <strong><span>Service Tools</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="{{ url('#') }}" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('user/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/toastify/toastify.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
</body>

</html>
