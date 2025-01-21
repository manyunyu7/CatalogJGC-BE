@extends('profile.eterna.eterna_template')

@php
    $eternaAsset = url("/")."/eterna/";
    $bsbAsset = url("/")."/bsb/";
@endphp

@section('page-content')


    <main id="main">


        <section class="reach-out-section mt-3" style="
        margin-bottom: 20px;
        background-image: url('{{$bsbAsset}}bg_gradient_leaves.png')">
            <div class="reach-out-content">
                <h1>About Us</h1>
            </div>
        </section>


        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2 class="">About Us</h2>
                </div>
                <div>
                    <div class="mt-2"></div>
                    <div class="col-12 mb-4 text-center">
                        <a href="{{url("/")}}" ><img style="max-width: 30%" src="{{$bsbAsset}}s_icon.png" alt="" class="img-fluid"></a>
                    </div>
                    <p class="font-montserrat">
                        {!!$profile->description!!}
                    </p>
                </div>

                <div class="row">

                    <div class="mt-5 mb-5"></div>
                    <div class="section-title">
                        <h2 class="">Vision & Mission</h2>
                    </div>
                    <div class="col-6">
                        <h3 class="font-montserrat font-weight-bold">Vission</h3>
                        <p class="font-montserrat">
                            {!!$profile->vision!!}
                        </p>
                    </div>
                    <div class="col-6">
                        <h3 class="font-montserrat font-weight-bold">Mission</h3>
                        <p class="font-montserrat">
                            {!!$profile->mission!!}
                        </p>
                    </div>
                </div>



            </div>
        </section>


        <!-- ======= Why Us Section ======= -->
        <div class="why-us-section blurred-container-xyz">
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
                                <p class="card-text">Our laboratory equipment products stand out for their superior quality, undergoing stringent standards to ensure top-notch performance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Why Us Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about mt-5" >
            <div class="container">

                <div class="section-title">
                    <h2 class="">Our Product</h2>
                    <p class="font-montserrat d-none">
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
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients client-sec">
            <div class="container-fluid">

                <div class="section-title">
                    <h2 class="d-xl-block d-sm-block">Our Clients</h2>
                    <p class="">PT. BESTARI SARANA INSTRUMENT has been working with and fulfilling the laboratory equipment needs of our customers for a long time. We understand and believe that our company is capable of meeting the needs of our customers both from various sides of the needs of our customers. Thank you for continuing to trust and use our company as a trusted agent and distributor of laboratory equipment for your needs.
                    </p>
                </div>

                <div class="position-relative">
                    {{--                    <div class="wrapper-our-brand position-absolute d-none d-xl-block d-md-block mr-4 ml-4">--}}
                    {{--                        <h1 class="font-weight-bold our-brand-text">Our Clients</h1>--}}
                    {{--                    </div>--}}
                    <div class="clients-container row justify-content-center">
                        @foreach ($ourClients as $item)
                            <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                <a href="{{ $item['action_link'] }}" >
                                    <img src="{{ $item['full_image_path'] }}" class="my-img-brand img-fluid" alt="{{ $item['title'] }}">
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- End Clients Section -->


    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('profile.eterna.eterna_footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection
