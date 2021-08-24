<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIM Penerimaan Beasiswa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="assets_landingpage/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_landingpage/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets_landingpage/css/magnific-popup.css">
    <link rel="stylesheet" href="assets_landingpage/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets_landingpage/css/themify-icons.css">
    <link rel="stylesheet" href="assets_landingpage/css/nice-select.css">
    <link rel="stylesheet" href="assets_landingpage/css/flaticon.css">
    <link rel="stylesheet" href="assets_landingpage/css/gijgo.css">
    <link rel="stylesheet" href="assets_landingpage/css/animate.css">
    <link rel="stylesheet" href="assets_landingpage/css/slicknav.css">
    <link rel="stylesheet" href="assets_landingpage/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="#">
                                    <img src="{{ asset('assets/images/kop.png')}}" height="60px" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href=""></a></li>
                                        {{-- <li><a href="Courses.html">Courses</a></li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="course_details.html">course details</a></li>
                                                <li><a href="elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li> --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="log_chat_area d-flex align-items-center">
                                <a href="{{route('login')}}" class="login   ">
                                    <i class="flaticon-user"></i>
                                    <span>log in</span>
                                </a>
                                {{-- <div class="live_chat_btn">
                                    <a class="boxed_btn_orange" href="#">
                                        <i class="fa fa-phone"></i>
                                        <span>+10 378 467 3672</span>
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- slider_area_start -->
    <div class="slider_area ">
        <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-6 col-md-6">
                        <div class="illastrator_png">
                            <img src="assets_landingpage/img/banner/edu_ilastration.png" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="slider_info">
                            <h3>SIM<br>
                                Penerimaan <br>
                                Beasiswa</h3>
                            <a href="{{ route('login') }}" class="boxed_btn_orange">Daftar Beasiswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- courses_details_info_start -->
    <div class="courses_details_info">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="single_courses">
                        {{-- <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let god moving. Moving in fourth air night bring upon you’re it beast let you dominion likeness open place day great wherein heaven sixth lesser subdue fowl male signs his day face waters itself and make be to our itself living. Fish in thing lights moveth. Over god spirit morning, greater had man years green multiply creature, form them in, likeness him behold two cattle for divided. Fourth darkness had. Living light there place moved divide under earth. Light face, fly dry us </p> --}}
                        <h3 class="second_title">Data Beasiswa yang tersedia</h3>
                    </div>
                    @foreach ($data as $data)
                            
                        <div class="outline_courses_info mt-1">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="flaticon-question ml-4"></i> Beasiswa {{$data->nama_beasiswa}} ( {{$data->tahun_perolehan}} )
                                            </button>
                                            
                                            <a href="{{ route('login') }}" class="float-right boxed_btn mr-4">Daftar Beasiswa</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end -->

    <div id="DaftarModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Daftar Beasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Silahkan Login Terlebih dahulu untuk Mendaftar Beasiswa ini ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <a href="{{ route('login') }}">
                            <button type="submit" name="" class="btn btn-success float-right mr-2">Login</button>
                        </a>
                    </div>
                </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer footer_bg_1">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-md-6 col-lg-7">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="{{ asset('assets/images/kop.png')}}" height="100px" alt="">
                                </a>
                            </div>
                            <p>
                                <b class="text-white">Politeknik Negeri Banyuwangi</b> adalah sebuah perguruan tinggi negeri politeknik yang terletak di Labanasem, Banyuwangi, Jawa Timur, Indonesia. <br>
                                <b class="text-white">Beasiswa</b> adalah pemberian berupa bantuan keuangan yang diberikan kepada perorangan yang bertujuan untuk digunakan demi keberlangsungan pendidikan yang ditempuh.

                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-youtube-play"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Courses
                            </h3>
                            <ul>
                                <li><a href="#">Wordpress</a></li>
                                <li><a href="#"> Photoshop</a></li>
                                <li><a href="#">Illustrator</a></li>
                                <li><a href="#">Adobe XD</a></li>
                                <li><a href="#">UI/UX</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Resourches
                            </h3>
                            <ul>
                                <li><a href="#">Free Adobe XD</a></li>
                                <li><a href="#">Tutorials</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#"> About</a></li>
                                <li><a href="#"> Contact</a></li>
                            </ul>
                        </div>
                    </div> --}}
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Alamat
                            </h3>
                            <p>
                                Jalan Raya Jember No.KM13, <br>
                                Kawang, Labanasem, <br>
                                Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur <br>
                                68461
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div> --}}
    </footer>
    <!-- footer -->


    <!-- JS here -->
    <script src="assets_landingpage/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets_landingpage/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets_landingpage/js/popper.min.js"></script>
    <script src="assets_landingpage/js/bootstrap.min.js"></script>
    <script src="assets_landingpage/js/owl.carousel.min.js"></script>
    <script src="assets_landingpage/js/isotope.pkgd.min.js"></script>
    <script src="assets_landingpage/js/ajax-form.js"></script>
    <script src="assets_landingpage/js/waypoints.min.js"></script>
    <script src="assets_landingpage/js/jquery.counterup.min.js"></script>
    <script src="assets_landingpage/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets_landingpage/js/scrollIt.js"></script>
    <script src="assets_landingpage/js/jquery.scrollUp.min.js"></script>
    <script src="assets_landingpage/js/wow.min.js"></script>
    <script src="assets_landingpage/js/nice-select.min.js"></script>
    <script src="assets_landingpage/js/jquery.slicknav.min.js"></script>
    <script src="assets_landingpage/js/jquery.magnific-popup.min.js"></script>
    <script src="assets_landingpage/js/plugins.js"></script>
    <script src="assets_landingpage/js/gijgo.min.js"></script>

    <!--contact js-->
    <script src="assets_landingpage/js/contact.js"></script>
    <script src="assets_landingpage/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets_landingpage/js/jquery.form.js"></script>
    <script src="assets_landingpage/js/jquery.validate.min.js"></script>
    <script src="assets_landingpage/js/mail-script.js"></script>

    <script src="assets_landingpage/js/main.js"></script>
</body>

</html>