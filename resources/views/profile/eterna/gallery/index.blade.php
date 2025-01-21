@extends('profile.eterna.eterna_template')

@php
    $eternaAsset = url("/")."/eterna/";
    $bsbAsset = url("/")."/bsb/";
@endphp

@section('page-content')


    <main id="main">


        <section class="reach-out-section mt-1" style="background-image: url('{{$bsbAsset}}bg_gradient_leaves.png')">
            <div class="reach-out-content">
                <h1>Gallery</h1>
            </div>
        </section>



        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center mt-3">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            @forelse($tagObjects as $item)
                                <li data-filter=".{{$item->tag_link}}">{{ $item->tag }}</li>
                            @empty
                                No tags found.
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container">


                    @forelse($datas as $item)
                        <div class="col-lg-4 col-md-6 portfolio-item {{$item->tag_link}}">
                            <div class="portfolio-wrap"  style="max-height: 200px">
                                <img src="{{$item->full_image_path}}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{$item->title}}</h4>
                                    <p>{{$item->description}}</p>
                                    <div class="portfolio-links">
                                        <a href="{{$item->full_image_path}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{$item->title}}"><i class="bx bx-show"></i></a>
{{--                                        <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No tags found.
                    @endforelse

                </div>

            </div>
        </section><!-- End Portfolio Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('profile.eterna.eterna_footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection
