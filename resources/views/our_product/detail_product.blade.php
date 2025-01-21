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

        /* Skeleton Loading Styles */
        .skeleton-loader {
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        .brand-highlight-content {
            /* Add any other styles for the content inside the container */
        }
    </style>
@endpush

@section('page-content')

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container mt-5">

            <div class="row">

                <div class="col-md-6 col-lg-6 col-12 text-center">
                    <a href="{{$main_image_url}}" class="image-link" data-magnify="gallery">
                        <img class="img-fluid mx-auto"
                             style="margin-left: 10px; margin-right: 10px"
                             src="{{$main_image_url}}"
                             alt="Your Image">
                    </a>
                </div>
{{--               <script>--}}

{{--                    if (typeof jQuery !== 'undefined') {--}}
{{--                        // jQuery is loaded--}}
{{--                        console.log('jQuery is installed!');--}}
{{--                    } else {--}}
{{--                        // jQuery is not loaded--}}
{{--                        console.log('jQuery is not installed!');--}}
{{--                    }--}}

{{--                    $(document).ready(function() {--}}
{{--                        $('.image-link').magnificPopup({--}}
{{--                            type: 'image',--}}
{{--                            zoom: {--}}
{{--                                enabled: true,--}}
{{--                                duration: 300, // duration of the effect, in milliseconds--}}
{{--                                easing: 'ease-in-out', // CSS transition easing function--}}
{{--                                opener: function(element) {--}}
{{--                                    return element.find('img');--}}
{{--                                }--}}
{{--                            }--}}
{{--                        });--}}
{{--                    });--}}

{{--                </script>--}}



                <div class="col-md-6">
                    <h1 class="value-card-title">{{$product->name}}</h1>
{{--                    <h1 class="text-white">{{$product->id}}</h1>--}}
                    <h4 class="detail-product-card-content">
                        {!! $shortDesc !!}
                    </h4>
                    <hr style="margin-left: 20px; margin-right: 20px">
                    <p style="margin-left: 20px; margin-right: 20px; font-size: 14px" class="d-none">Category : Anemometer,
                        <span class="ml-3">
                            Tag: 168Junction
                        </span>
                    </p>

{{--                    <a style="margin-left: 20px; margin-right: 20px;" href="{{$image_url}}" download="your-file-name.pdf" class="btn btn-primary">--}}
{{--                        <i class="fas fa-download"></i> Download PDF--}}
{{--                    </a>--}}
                </div>


                <div class="col-12 mt-5 mb-4">
                    <div class="container">
                        <h2 style="font-weight: 900; font-size: 20px" class="montserrat">Description</h2>
                    </div>
                    <div class="container mt-2">
                        {!!   ($desc) !!}
                    </div>
                </div>


                <div class="col-12 mt-5 mb-4 d-none">
                    <h1 style="font-weight: 900; font-size: 25px" class="montserrat">Related Products</h1>


                    <!-- HTML template -->
                    <div id="relatedProductsContainer" class="row">
                        <!-- Loading Indicator -->
                        <!-- Skeleton Loading Indicator -->
                        <div id="loadingIndicator" style="display: none;">Loading...</div>
                        <div id="skeletonLoadingIndicator" class="skeleton-loader"></div>
                    </div>

                    <script>
                        // Fetch data from the API
                        const apiUrl = `${window.location.origin}/product/620/related`;

                        // Show skeleton loading indicator
                        document.getElementById('skeletonLoadingIndicator').style.display = 'block';


                        // Show loading indicator
                        document.getElementById('loadingIndicator').style.display = 'block';

                        fetch(apiUrl)
                            .then(response => response.json())
                            .then(data => {
                                // Hide loading indicator
                                document.getElementById('loadingIndicator').style.display = 'none';

                                // Access the data and update the HTML
                                const relatedProductsContainer = document.getElementById('relatedProductsContainer');

                                data.forEach(product => {
                                    const productElement = document.createElement('div');
                                    productElement.className = 'col-lg-2 col-md-6 d-flex align-items-stretch';
                                    productElement.innerHTML = `
                                          <a href="${window.location.origin+"/"+product.slug}" target="_blank" rel="noopener noreferrer" class="icon-box-link">
                                            <div class="icon-box">
                                              <div class="icon-brand text-center">
                                                <img class="img-fluid img-brand" style="margin-left: 10px; max-height: 160px; margin-right: 10px; padding:10px; border-radius: 20px" src="${product.image}">
                                              </div>
                                              <h4 class="mt-5">${product.name}</h4>
                                            </div>
                                          </a>
                                        `;

                                    relatedProductsContainer.appendChild(productElement);
                                });

                                // Check if there are no related products
                                if (data.length === 0) {
                                    relatedProductsContainer.innerHTML = 'No related products found.';
                                }
                            })
                            .catch(error => {
                                // Handle error, e.g., display an error message
                                console.error('Error fetching related products:', error);

                                // Hide loading indicator
                                document.getElementById('loadingIndicator').style.display = 'none';
                            });
                    </script>

                </div>
            </div>

        </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Footer ======= -->
    @include('profile.eterna.eterna_footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection
