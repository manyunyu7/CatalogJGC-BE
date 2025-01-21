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

    <!-- In your Blade view -->
    <!-- ======= Hero Section ======= -->
    @if(Str::contains(request()->path(), 'category'))
        <section id="hero" style="margin-bottom: 10px">
            <div class="hero-container">
                <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade"
                     data-bs-ride="carousel">

                    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                    <div class="carousel-inner" role="listbox">

                        @forelse ($sliders as $sliderItem)
                            <!-- Slide 1 -->
                            <div class="carousel-item @if($loop->iteration==1) active @endif "
                                 style="background-image: url({{asset($sliderItem->image)}})">
                                <div class="carousel-container">
                                    <div class="carousel-content">
                                        <h2 class="animate__animated animate__fadeInDown">{{$sliderItem->title}}</h2>
                                        <p class="animate__animated animate__fadeInUp">{{$sliderItem->description}}</p>

                                        @if($sliderItem->action!=null)
                                            <a href="{{$sliderItem->action_link}}"
                                               class="btn-get-started animate__animated animate__fadeInUp">{{$sliderItem->action}}</a>
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

                </div>
            </div>
        </section>
        <!-- End Hero -->
    @endif

    @if(!Str::contains(request()->path(), 'category'))
        <!-- ======= Brand Highlight Section ======= -->
        <section class="brand-highlight-section">
            <div class="container brand-highlight-content">
                <div class="row">

                    @if($ourBrand->full_image_path!=null)
                        <div class="col-md-6 col-lg-6 col-12">

                            <div class="float-left">
                                {{--                                <h1 class="montserrat bold">{{$ourBrand->title}}</h1>--}}
                                <img class=""
                                     style="margin-right: 10px; max-height: 120px; min-height: 85px"
                                     src="{{$ourBrand->full_image_path}}">
                            </div>

                            <p class="montserrat
                         @if($ourBrand->description!="")
                         mt-5
                         @endif">{{$ourBrand->description}}</p>

                            <button type="button" class="btn d-none btn-outline-primary mt-5 montserrat">Lihat Produk
                            </button>

                        </div>
                    @endif

                    <div class="col-lg-1 col-md-1"></div>
                    <div class="col-md-5 col-lg-5 col-12">
                        <div class="float-right">
                            <img class="img-fluid"
                                 style="margin-left: 10px; margin-right: 10px; max-height: 89%; min-width: 45%"
                                 src="{{$ourBrand->full_poster_path}}">
                        </div>
                    </div>

                </div>
            </div>
            <!-- Background Image -->
            <div class="brand-highlight-background"></div>
        </section>
        <!-- End Brand Highlight Section -->
    @endif

    <!-- ======= Product List Section ======= -->
    <section id="services" style="margin-top: 100px;" class="services
        @if(!Str::contains(request()->path(), 'category'))
        mt-5
        @endif
    ">
        <div class="container">

            <div class="row">
                <div class="col-md-6 col-12">
                    <p class="montserrat bold text-primary" style="font-size: 32px">{{$ourBrand->title}} Product</p>
                    <p class="montserrat">Berikut merupakan produk-produk dari {{$ourBrand->title}} yang kami
                        sediakan</p>
                </div>
            </div>


            <!-- HTML -->
            <!-- Search Form -->
            <div style="max-width: 50%">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Search input -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                        </div>
                    </div>
                    <div class="col-md-4 {{ request()->is('products') ? '' : 'd-none' }}">
                        <!-- Brand filter dropdown -->
                        <div class="input-group mb-3 filter-prod-dropdown">
                            <select class="custom-select" id="brandFilter">
                                <option value="">All Brands</option>
                                @foreach($categoryOnWeb as $brand)
                                    <option value="{{ $brand['slug'] }}">{{ $brand['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="productList">
                @forelse ($products as $index => $data)
                    <div class="col-lg-2 col-md-6 d-flex align-items-stretch product-item"
                         data-name="{{ strtolower($data->name) }}"
                         data-categories="{{ strtolower(implode(',', collect($data->categories)->pluck('slug')->toArray())) }}"
                         data-index="{{ $index }}">
                        <a href="{{ url("/product")."/"."$data->slug" }}"  rel="noopener noreferrer"
                           class="icon-box-link">
                            <div class="icon-box">
                                <div class="icon-brand">
                                    <img class="img-fluid img-brand"
                                         style="margin-left: 10px; margin-right: 10px; padding:10px; border-radius: 20px; max-width: 200px; max-height: 200px!important;"
                                         src="{{ $data->images }}">
                                </div>
                                <!-- Show brand if product's categories match ourBrand -->
                                @foreach($data->categories as $category)
                                    @foreach($categoryOnWeb as $brand)
                                        @if($category->slug == $brand['slug'])
                                            <a href="#" style="color: #6c757d; text-decoration: none;">
                                                <p>{{ $brand['name'] }}</p>
                                            </a>
                                        @endif
                                    @endforeach
                                @endforeach
                                <div style="margin-left: 20px; margin-right: 20px">
                                    <h6 class="">{{ $data->name }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <!-- Handle empty products -->
                @endforelse
            </div>

            <div id="pagination" class="mt-4 d-none">
                <ul class="pagination justify-content-center">
                    <!-- Pagination links will be dynamically added here -->
                </ul>
            </div>

            <script>
                // JavaScript for filtering products based on search input, category, and pagination
                const productList = document.getElementById('productList');
                const pagination = document.querySelector('.pagination');
                const searchInput = document.getElementById('searchInput');
                const brandFilter = document.getElementById('brandFilter');
                let currentPage = 1;
                let itemsPerPage = 999999999; // Assuming 12 items per page, you can adjust as needed

                function updatePagination(totalPages) {
                    let paginationHTML = '';
                    for (let i = 1; i <= totalPages; i++) {
                        paginationHTML += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>`;
                    }
                    pagination.innerHTML = paginationHTML;
                }

                function changePage(page) {
                    event.preventDefault();
                    currentPage = page;
                    filterProducts();
                }

                function filterProducts() {
                    const query = searchInput.value.toLowerCase();
                    const selectedBrand = brandFilter.value.toLowerCase();

                    const productItems = document.querySelectorAll('.product-item');

                    let startIndex = (currentPage - 1) * itemsPerPage;
                    let endIndex = startIndex + itemsPerPage;

                    productItems.forEach(function (item) {
                        const productName = item.getAttribute('data-name');
                        const categories = item.getAttribute('data-categories').toLowerCase();
                        const index = parseInt(item.getAttribute('data-index'), 10);

                        // Check if product matches the search query, selected brand, and falls within the current page range
                        const matchesQuery = productName.includes(query) || categories.includes(query);
                        const matchesBrand = selectedBrand === '' || categories.includes(selectedBrand);
                        const withinPageRange = index >= startIndex && index < endIndex;

                        if (matchesQuery && matchesBrand && withinPageRange) {
                            item.classList.remove('d-none');
                        } else {
                            item.classList.add('d-none');
                        }
                    });

                    // Calculate total pages based on the number of items and itemsPerPage
                    const totalPages = Math.ceil(productItems.length / itemsPerPage);
                    updatePagination(totalPages);
                }

                // Initial call to set up pagination and filtering
                filterProducts();

                // Event listeners for search input and brand filter
                searchInput.addEventListener('input', function () {
                    currentPage = 1; // Reset page when search changes
                    filterProducts();
                });

                brandFilter.addEventListener('change', filterProducts);
            </script>
        </div>
    </section>

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


    <!-- Product List Section -->
    @include('profile.eterna.eterna_footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection
