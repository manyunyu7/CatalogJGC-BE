<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $eternaAsset = url("/")."/eterna/";
        $bsbAsset = url("/")."/bsb/";
    @endphp
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Bestari Setia Abadi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <meta name="title" content="Bestari Sarana Instrument">
    <meta name="description" content="General Instrument, Mining Laboratory, Environment  & Pollution Monitoring, Parts and Labwares, etc.">
    <meta name="keywords" content="Peralatan Lab, Environmental Laboratory Equipment, WATER PURIFICATION SYSTEM, GENERAL LABORATORY EQUIPMENT">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="">

    <!-- Primary Meta Tags -->
    <title>Bestari Sarana Instrument - Your Partner for Laboratory Solutions</title>
    <meta name="title" content="Bestari Sarana Instrument - Your Partner for Laboratory Solutions" />
    <meta name="description" content="Perusahaan yang berfokus pada impor, ekspor, dan penyediaan peralatan untuk berbagai proyek. Kami menawarkan solusi lengkap untuk kebutuhan peralatan laboratorium, termasuk peralatan untuk Laboratorium Umum, Pemantauan Lingkungan dan Polusi, Laboratorium Pertambangan, dan Mesin Persiapan Sampel." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url("/")}}" />
    <meta property="og:title" content="Bestari Sarana Instrument - Your Partner for Laboratory Solutions" />
    <meta property="og:description" content="Perusahaan yang berfokus pada impor, ekspor, dan penyediaan peralatan untuk berbagai proyek. Kami menawarkan solusi lengkap untuk kebutuhan peralatan laboratorium, termasuk peralatan untuk Laboratorium Umum, Pemantauan Lingkungan dan Polusi, Laboratorium Pertambangan, dan Mesin Persiapan Sampel." />
    <meta property="og:image" content="{{url("/")."/web_files/og_thumbnail.png"}}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{url("/")}}" />
    <meta property="twitter:title" content="Bestari Sarana Instrument - Your Partner for Laboratory Solutions" />
    <meta property="twitter:description" content="Perusahaan yang berfokus pada impor, ekspor, dan penyediaan peralatan untuk berbagai proyek. Kami menawarkan solusi lengkap untuk kebutuhan peralatan laboratorium, termasuk peralatan untuk Laboratorium Umum, Pemantauan Lingkungan dan Polusi, Laboratorium Pertambangan, dan Mesin Persiapan Sampel." />
    <meta property="twitter:image" content="{{url("/")."/web_files/og_thumbnail.png"}}" />

    <!-- Meta Tags Generated with https://metatags.io -->


    <!-- Favicons -->
    <link href="{{$eternaAsset}}/{{$eternaAsset}}/assets/img/favicon.png" rel="icon">
    <link href="{{$eternaAsset}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{$eternaAsset}}assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{$eternaAsset}}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{$eternaAsset}}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{$eternaAsset}}assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{$eternaAsset}}assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{$eternaAsset}}assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{$eternaAsset}}assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <!-- =======================================================
    * Template Name: Eterna
    * Updated: Sep 18 2023 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css"
          integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #principals {
            overflow-x: auto;
        }


        .brand-item img {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .brand-item:hover img {
            transform: scale(1.1); /* Add scaling effect on hover */
        }

        .whatsapp-button {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .whatsapp-icon {
            margin-top: 16px;
        }

        .contact-list-container {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            margin-left: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 2px 2px 5px #999;
            z-index: 200;
        }

        .contact-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .contact-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%; /* Make it circular */
            margin-right: 15px;
            object-fit: cover; /* Maintain aspect ratio and cover container */
            padding: 15px; /* Add padding around the image */
        }

        .contact-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .whatsapp-icon-header {
            width: 30px;
            height: 30px;
            margin-left: 10px;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            margin-left: 5px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .contact-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .contact-list-container {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 2px 2px 5px #999;
            z-index: 200;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .whatsapp-icon-header {
            width: 30px;
            height: 30px;
            margin-left: 10px;
        }

        .contact-icon {
            width: 20px;
            height: 20px;
            margin-left: 5px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            cursor: pointer;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 2px 2px 5px #999;
        }

        .contact-color-bar {
            width: 10px;
            height: 100%;
            background-color: #25d366; /* Adjust the color as needed */
        }

        .contact-content {
            display: flex;
            flex-grow: 1;
            padding: 15px;
        }

        .contact-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .contact-details {
            flex-grow: 1;
        }

        .contact-list-container {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #fff;
            border-radius: 15px;
            z-index: 200;
        }

        .custom-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .filter-prod-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .filter-prod-dropdown select {
            width: 100%;
            padding: 7px;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            cursor: pointer;
        }

        .filter-prod-dropdown select:focus {
            outline: none;
            border-color: #66afe9;
        }

        .filter-prod-dropdown::after {
            content: '\25BC';
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

    </style>


    @stack('my-style')

</head>

<body>

<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a
                        href="{{ $profileData->main_email}}">{{ $profileData->main_email}}</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{ $profileData->contact}}</span></i>
        </div>
{{--        <div class="social-links d-none d-md-flex align-items-center d-none">--}}
{{--            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>--}}
{{--            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>--}}
{{--            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>--}}
{{--            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>--}}
{{--        </div>--}}
    </div>
</section>


@include('profile.eterna.eterna_header')


<div class="page-content">
    @yield('page-content')
</div>

<a href="#" class="whatsapp-button" id="whatsappButton">
    <i class="fa fa-whatsapp whatsapp-icon"></i>
</a>



<div class="contact-list-container" id="contactList">
    <span class="contact-close" style="font-size: 11px" onclick="closeContactList()">Close</span><br>

    @forelse ($commonWhatsapp as $item)
        <a target="_blank" href="https://api.whatsapp.com/send?phone={{$item->contact}}&text=" class="contact-item">
            <div class="contact-color-bar"></div>
            <div class="contact-content">
                <img src="{{$eternaAsset}}assets/img/icon_whatsapp.png" alt="Contact 1" class="contact-avatar">
                <div class="contact-details">
                    <strong>{{$item->name}}</strong><br>
                    {{$item->description}}
                </div>
                {{--            <div class="contact-icons">--}}
                {{--                <img src="start_icon.png" alt="Start Icon" class="contact-icon">--}}
                {{--                <img src="end_icon.png" alt="End Icon" class="contact-icon">--}}
                {{--            </div>--}}
            </div>
        </a>
    @empty

    @endforelse

    <!-- Add more contact items as needed -->
</div>



<script>
    function closeContactList() {
        document.getElementById('contactList').style.display = 'none';
    }

    document.getElementById('whatsappButton').addEventListener('click', function() {
        event.preventDefault();
        document.getElementById('contactList').style.display = 'block';
    });
</script>

<script>

    document.getElementById('whatsappButton').addEventListener('click', function() {
        event.preventDefault();
        document.getElementById('contactList').style.display = 'block';
    });

    document.getElementById('contactList').addEventListener('click', function(e) {
        if (e.target.classList.contains('contact-item')) {
            const phoneNumber = e.target.getAttribute('data-number');
            const message = 'Hola! Quisiera más información sobre Varela 2.';
            const whatsappLink = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(message)}`;
            window.open(whatsappLink, '_blank');
        }
        document.getElementById('contactList').style.display = 'none';
    });
</script>



@stack("myscript")

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Vendor JS Files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.js"
        integrity="sha512-wq5c217NlwsLqaLisr94LAkhrGiTqBSmJDwHyA3nmoBEbswI7nFZ5TtuDiRsLgq1bOaZKmqaWs8M213ESYAe6g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Magnific Popup core JS file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"
        integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{$eternaAsset}}assets/vendor/purecounter/purecounter_vanilla.js"></script>
<!-- jQuery -->
<script src="{{$eternaAsset}}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{$eternaAsset}}assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{$eternaAsset}}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{$eternaAsset}}assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="{{$eternaAsset}}assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="{{$eternaAsset}}assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="{{$eternaAsset}}assets/js/main.js"></script>



</body>

</html>
