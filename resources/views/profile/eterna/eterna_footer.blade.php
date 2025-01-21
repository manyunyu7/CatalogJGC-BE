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
            <div class="row justify-content-center">
                {{--                    <img class="footer-img img-fluid" style="max-height: 60px; max-width: 30%;" src="{{$bsbAsset}}s_icon.png" alt="Bestari Setia Instrument">--}}
            </div>
        </div>


        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-6 footer-links text-left">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/category/general-laboratory-equipment') }}">General Laboratory Equipment</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/category/environmental-laboratory-equipment') }}">Environmental Laboratory Equipment</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/category/mineral-and-coal-laboratory-equipment') }}">Mineral and Coal Laboratory Equipment</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/category/water-purification-system') }}">Water Purification System</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact text-center">
                    <h4>Contact Us</h4>
                    <p>
                        {!!   $profileData->main_address!!} <br>
                        <strong>Phone:</strong> {!! $profileData->contact !!}<br>
                        <strong>Email:</strong> {!! $profileData->main_email !!}<br>
                    </p>
                </div>

{{--                <div class="col-lg-3 col-md-6 footer-info text-center">--}}
{{--                    <h3>About {{$profileData->company_title}}</h3>--}}
{{--                    {!! $profileData->description !!}--}}
{{--                    <div class="social-links mt-3">--}}
{{--                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>--}}
{{--                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>--}}
{{--                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>--}}
{{--                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>--}}
{{--                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span> {!!   $profileData->company_title!!}</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
{{--            <!-- Licensing information: https://bootstrapmade.com/license/ -->--}}
{{--            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/ -->--}}
{{--            Designed by <a href="https://bootstrapmade.com/">BestariLab</a>--}}
        </div>
    </div>
</footer>
<!-- End Footer -->
