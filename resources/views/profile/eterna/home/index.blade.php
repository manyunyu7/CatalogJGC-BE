@extends('profile.eterna.eterna_template')

@php
    $eternaAsset = url("/")."/eterna/";
    $bsbAsset = url("/")."/bsb/";
@endphp

@section('page-content')

    <!-- In your Blade view -->
    <main id="main">
        <!-- ======= Hero Section ======= -->
        <section id="hero" style="margin-bottom: 30px">
            <div class="hero-container">
                <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade"
                     data-bs-ride="carousel">

                    <div class="carousel-inner" role="listbox">

                        @forelse ($sliders as $sliderItem)
                            <!-- Slide 1 -->
                            <div class="carousel-item @if($loop->iteration==1) active @endif "
                                 style="background-image: url({{asset($sliderItem->image)}})">
                                <div class="carousel-container">
                                    <div class="carousel-content">

                                        @if($loop->iteration==1)
                                            <h2 class="animate__animated animate__fadeInDown">{{$sliderItem->title}}</h2>
                                        @endif
                                        <div style="padding-left: 20px; padding-right: 20px"
                                             class="text-center animate__animated mb-3 animate__fadeInDown">
                                            <img src="{{ url(asset($sliderItem->icon)) }}"
                                                 style="max-height: 112px; min-height: 50px"
                                                 class="img-thumbnail"
                                                 onerror="this.style.display='none'">
                                        </div>
                                        <p class="animate__animated animate__fadeInUp">{{$sliderItem->description}}</p>
                                        @if($sliderItem->action != null)
                                            <div class="text-center">
                                                <a href="{{$sliderItem->action_link}}"
                                                   class="btn-get-started animate__animated animate__fadeInUp">{{$sliderItem->action}}</a>

                                                @if($sliderItem->second_action_link!="")
                                                    <a href="{{$sliderItem->second_action_link}}"
                                                       class="btn-get-started animate__animated animate__fadeInUp">{{$sliderItem->second_action}}</a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse

                    </div>

                    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                    </a>

                    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                    </a>

                    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                </div>
            </div>
        </section>
        <!-- End Hero -->

        <!-- ======= Brands Section ======= -->
        <section id="brands" class="brands">
            <div class="container-fluid">

                <div class="section-title">
                    <h2 class=" d-lg-block d-sm-block mt-lg-5">Our Brands</h2>
                </div>

                <div class="">

                    {{--                    <div class="wrapper-our-brand position-absolute d-none d-xl-block d-md-block mr-4 ml-4">--}}
                    {{--                        <p class="font-weight-bold our-brand-text">Our Brands</p>--}}
                    {{--                    </div>--}}

                    <div class="brands-slider swiper position-relative">
                        <div class="swiper-wrapper align-items-center">
                            @foreach ($ourBrands as $item)
                                @if ($loop->iteration % 2 === 1)
                                    <div class="swiper-slide">
                                        @endif
                                        <a href="{{ url("/brand/")."/".$item['action_link'] }}" >
                                            <img src="{{ $item['full_image_path'] }}" class="my-img-brand img-fluid"
                                                 alt="{{ $item['title'] }}" style="margin-bottom: 5px">
                                        </a>
                                        @if ($loop->iteration % 2 === 0 || $loop->last)
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Clients Section -->


        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2 class="">About Us</h2>
                    <p class="font-montserrat">
                        BESTARI SARANA INSTRUMENT was established year 2023 in Jakarta the Capital of Indonesia. We are
                        one
                        of the leading companies in the field of importing, exporting, and supplying equipment for
                        various
                        projects.
                        Our product range completes selection instruments for General Laboratory equipment,
                        Environmental
                        and Pollution Monitoring Instrument, Mining Laboratory and Sample Preparation Machine, Labware
                        and
                        Consumable, etc.
                    </p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('/category/mineral-and-coal-laboratory-equipment') }}"
                           class="value-card">
                            <img class="why-us-img" src="{{$bsbAsset}}ic_lab_1.png" alt="Value Image 5">
                            <div class="">
                                <h2 class="value-card-title">MINERAL AND COAL LABORATORY EQUIPMENT</h2>
                                <p class="value-card-content">
                                    Our cutting-edge equipment for mineral and coal laboratories ensures accurate and
                                    reliable analysis, meeting the industry's highest standards for precision and
                                    efficiency.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/category/environmental-laboratory-equipment') }}"
                           class="value-card">
                            <img class="why-us-img" src="{{$bsbAsset}}ic_lab_2.png" alt="Value Image 5">
                            <div class="">
                                <h2 class="value-card-title">ENVIRONMENTAL LABORATORY EQUIPMENT</h2>
                                <p class="value-card-content">
                                    Explore our comprehensive range of environmental laboratory equipment designed to
                                    monitor and analyze environmental factors, contributing to a sustainable and
                                    healthier
                                    planet.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('/category/general-laboratory-equipment') }}"
                           class="value-card">
                            <img class="why-us-img" src="{{$bsbAsset}}ic_lab_3.png" alt="Value Image 5">
                            <div class="">
                                <h2 class="value-card-title">GENERAL LABORATORY EQUIPMENT</h2>
                                <p class="value-card-content">
                                    Elevate your laboratory's capabilities with our high-quality general laboratory
                                    equipment, facilitating precise and efficient scientific experiments across various
                                    disciplines.
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ url('/category/water-purification-system') }}"  class="value-card">
                            <img class="why-us-img" src="{{$bsbAsset}}ic_lab_4.png" alt="Value Image 5">
                            <div class="">
                                <h2 class="value-card-title">WATER PURIFICATION SYSTEM</h2>
                                <p class="value-card-content">
                                    Our advanced water purification systems ensure the delivery of clean and safe water,
                                    addressing the increasing demand for reliable water treatment solutions in diverse
                                    applications.
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <a  href="{{url("/")."/web_files/company_profile_bsa_2023.pdf"}}"
                           class="btn btn-outline-danger">
                            <i class="fa fa-file-pdf-o"></i> Download Company Profile
                        </a>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->


        <!-- ======= E-Catalog Section ======= -->
        <section id="catalogs" class="clients client-sec">
            <div class="container-fluid">

                <div class="section-title">
                    <h2 class="d-xl-block d-sm-block">E-Catalog</h2>
                    <p class="">Kunjungi halaman resmi E-Katalog kami untuk dengan<br>mudah menjelajahi dan memesan produk
                        terbaru untuk keperluan instansi anda,<a  href="https://bit.ly/ekatalogbestariabadi" >klik disini</a> atau scan QR Code dibawah untuk membuka e-katalog
                    </p>

                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-12 col-lg-12 col-md-12 text-center">
                            <img src="{{$eternaAsset}}assets/img/qr_ekatalog.png" class="img-fluid" style="height: 50vh" alt="Logo QR">
                        </div>

                    </div>
                </div>

                <div class="position-relative">
                    {{--                    <div class="wrapper-our-brand position-absolute d-none d-xl-block d-md-block mr-4 ml-4">--}}
                    {{--                        <h1 class="font-weight-bold our-brand-text">Our Clients</h1>--}}
                    {{--                    </div>--}}
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- E-Catalog Section -->


        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients client-sec">
            <div class="container-fluid">

                <div class="section-title">
                    <h2 class="d-xl-block d-sm-block">Our Clients</h2>
                    <p class="">PT. BESTARI SARANA INSTRUMENT has been working with and fulfilling the laboratory
                        equipment needs of our customers for a long time. We understand and believe that our company is
                        capable of meeting the needs of our customers both from various sides of the needs of our
                        customers. Thank you for continuing to trust and use our company as a trusted agent and
                        distributor of laboratory equipment for your needs.
                    </p>
                </div>

                <div class="position-relative">
                    {{--                    <div class="wrapper-our-brand position-absolute d-none d-xl-block d-md-block mr-4 ml-4">--}}
                    {{--                        <h1 class="font-weight-bold our-brand-text">Our Clients</h1>--}}
                    {{--                    </div>--}}
                    <div class="clients-container row justify-content-center">
                        @php $count = 0; @endphp
                        @foreach ($ourClients as $item)
                            @php
                                $image_height = '100%'; // default height
                                if ($item['height'] < 100) {
                                    $image_height = '160px'; // set minimum height to 150px
                                }
                            @endphp
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3" style="height: 200px;">
                                <a href="{{ $item['action_link'] }}" >
                                    <img src="{{ $item['full_image_path'] }}" class="my-img-brand img-fluid" alt="{{ $item['title'] }}" style="height: {{ $image_height }}; width: auto; object-fit: contain;">
                                </a>
                            </div>
                            @php
                                $count++;
                                if ($count % 5 == 0) {
                                    echo '</div><div class="row justify-content-center">';
                                }
                            @endphp
                        @endforeach
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- End Clients Section -->


        <!-- ======= Why Us Section ======= -->
        <div class="why-us-section blurred-container-xyz 1111">
            <div class="container">
                <div class="my-section-title">Reasons To Choose Us</div>
                <div class="my-section-subtitle">Why choose us as your partner</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <img class="why-us-img" src="{{$bsbAsset}}val-original-products.png"
                                     alt="Value Image 5">
                                <h5 class="card-title">Original Products</h5>
                                <p class="card-text">The laboratory equipment products that we sell are products with
                                    well-known brands and guaranteed authenticity.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <img class="why-us-img" src="{{$bsbAsset}}val-quality-product.png" alt="Value Image 5">
                                <h5 class="card-title">Quality Products</h5>
                                <p class="card-text">To increase convenience, we provide warranty information for the
                                    products we sell. Please contact our Contact Center.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <img class="why-us-img" src="{{$bsbAsset}}val-garansi-product.png" alt="Value Image 5">
                                <h5 class="card-title">Product Warranty</h5>
                                <p class="card-text">Our laboratory equipment products stand out for their superior
                                    quality, undergoing stringent standards to ensure top-notch performance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Why Us Section -->


        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact" style="margin-top: 120px">
            <div class="container">

                <div class="section-title">
                    <h2 class="">Hubungi Kami</h2>
                    <p class="font-montserrat">
                        Silakan hubungi kami untuk informasi lebih lanjut atau untuk memenuhi kebutuhan instansi Anda.
                        Kami
                        siap membantu!
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Our Address</h3>
                            <p>{!!  $profileData ?? ''->main_address!!}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Us</h3>
                            <p>{!!$profileData ?? ''->main_email!!}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Call Us</h3>
                            <p>{!!$profileData ?? ''->contact!!}</p>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-6 ">
                        <iframe class="mb-4 mb-lg-0"
                                src=
                                    "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.374825961805!2d106.84203497426606!3d-6.2141985608655945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f59eebcc31f7%3A0x709986dc9c9afe70!2sBestari%20Sarana%20Instrument.%20PT!5e0!3m2!1sen!2sid!4v1700399116527!5m2!1sen!2sid"
                                frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                    </div>

                    <div class="col-lg-6">
                        <form action="{{url("send-client-message")}}" method="post" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Your Name"
                                           required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                       placeholder="Subject"
                                       required>
                            </div>
                            <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                      required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const form = document.querySelector('.php-email-form');

                            form.addEventListener('submit', function (event) {
                                event.preventDefault();

                                const formData = new FormData(this);

                                fetch(this.action, {
                                    method: this.method,
                                    headers: {
                                        'X-CSRF-TOKEN': formData.get('_token'),
                                    },
                                    body: formData
                                })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        // Check if the response contains a message key
                                        if (data.message) {
                                            const sentMessage = document.querySelector('.sent-message');
                                            sentMessage.style.display = 'block';
                                            sentMessage.textContent = data.message;
                                        } else {
                                            const errorMessage = document.querySelector('.error-message');
                                            errorMessage.style.display = 'block';
                                            errorMessage.textContent = 'An error occurred. Please try again later.';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                    });
                            });
                        });
                    </script>
                </div>

            </div>
        </section><!-- End Contact Section -->


        <!--Google map-->
        <div id="map-container-google-1" class="z-depth-1-half map-container">
            <iframe
                src=
                    "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.374825961805!2d106.84203497426606!3d-6.2141985608655945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f59eebcc31f7%3A0x709986dc9c9afe70!2sBestari%20Sarana%20Instrument.%20PT!5e0!3m2!1sen!2sid!4v1700399116527!5m2!1sen!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!--Google Maps-->

        <!-- ======= Reach Out Section ======= -->
        <section class="reach-out-section" style="background-image: url('{{$bsbAsset}}bg_gradient_leaves.png')">
            <div class="reach-out-content">
                <h2>Reach Us Out</h2>
                <p>Feel free to contact us through WhatsApp Web for any inquiries or assistance.</p>
                <a id="whatsappButton2" href="#"
                   class="btn btn-lg btn-whatsapp">Open WhatsApp</a>
            </div>
        </section>

        <script>
            document.getElementById('whatsappButton2').addEventListener('click', function () {
                event.preventDefault();
                document.getElementById('contactList').style.display = 'block';
            });
        </script>
        <!-- ======= End of Reach Out Section ======= -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services mt-5 d-none">
            <div class="container">

                <div class="section-title">
                    <h2 class="">Produk Unggulan</h2>
                    <p class="font-montserrat">
                    </p>
                </div>

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
        </section><!-- End Services Section -->


    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('profile.eterna.eterna_footer')
    <!-- End Footer -->

    {{--    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i--}}
    {{--            class="bi bi-arrow-up-short"></i></a>--}}

@endsection
