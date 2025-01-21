@extends('profile.eterna.eterna_template')

@php
    $eternaAsset = url("/")."/eterna/";
    $bsbAsset = url("/")."/bsb/";
@endphp

@push('my-style')
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .brand-highlight-section {
            position: relative;
            margin-top: 110px;
            padding-bottom: 100px; /* Adjust the height of the image as needed */
        }

        .brand-highlight-background {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: -9;
            height: 200px; /* Adjust the height of the image as needed */
            background: url('{{ $eternaAsset }}/assets/img/my_wavy.png') center no-repeat;
            background-size: cover;
        }

        .brand-highlight-content {
            /* Add any other styles for the content inside the container */
        }
    </style>
@endpush

@section('page-content')

    <!-- End Hero -->

    <!-- ======= Brand Highlight Section ======= -->
    <section class="brand-highlight-section">
        <div class="container brand-highlight-content">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-12">
                    <h1 class="montserrat bold">MRU Gmbh Product</h1>
                    <p class="montserrat mt-5">Kanomax adalah produsen instrumen untuk pengujian aliran udara, pemantauan
                        kualitas udara dalam ruangan
                        (IAQ), pemantauan debu, penghitungan partikel dan pemantauan partikel, pengujian otomotif, dan
                        banyak
                        lagi. Industri yang kami layani meliputi HVAC, medis, farmasi, konstruksi, manufaktur industri,
                        manufaktur semi-konduktor, teknik otomotif dan kedirgantaraan, dan banyak lagi.</p>


                    <button type="button" class="btn  btn-outline-primary mt-5 montserrat" >Lihat Produk</button>

                </div>

                <div class="col-md-6 col-lg-6 col-12">
                    <img class="img-fluid"
                         style="margin-left: 10px; margin-right: 10px"
                         src="https://totalenviro.co.id/wp-content/uploads/2023/03/kaniomax-all-768x569.png">
                </div>

            </div>
        </div>
        <!-- Background Image -->
        <div class="brand-highlight-background"></div>
    </section>
    <!-- End Brand Highlight Section -->


    <!-- ======= Product List Section ======= -->
    <section id="services" style="margin-top: 100px;"  class="services">
        <div class="container">

            <p class="montserrat bold" style="font-size: 32px">Kanomax Product</p>
            <p class="montserrat">Berikut merupakan produk-produk dari Kanomax yang kami sediakan</p>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4><a href="">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-file"></i></div>
                        <h4><a href="">Sed ut perspiciatis</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-tachometer"></i></div>
                        <h4><a href="">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-world"></i></div>
                        <h4><a href="">Nemo Enim</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-slideshow"></i></div>
                        <h4><a href="">Dele cardo</a></h4>
                        <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-arch"></i></div>
                        <h4><a href="">Divera don</a></h4>
                        <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- Product List Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-newsletter d-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post">
                            <input type="iemail" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>About Eterna</h3>
                        <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita
                            valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Eterna</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection
