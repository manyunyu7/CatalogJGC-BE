<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            <a href="{{url("/")}}">
                <img src="{{$bsbAsset}}s_icon.png" alt="" class="img-fluid">
            </a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <ul>
                    <li><a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li><a class="{{ Request::is('about-us') ? 'active' : '' }}" href="{{ url('/about-us') }}">About</a></li>
                    <li class="dropdown">
                        <a class="{{ Request::is('product*') ? 'active' : '' }}" href="#"><span>Product</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a class="{{ Request::is('/mru-gmbh') ? 'active' : '' }}" href="{{ url('/brand/mru-gmbh') }}">MRU</a></li>
                            <li><a class="{{ Request::is('brand/esc') ? 'active' : '' }}" href="{{ url('/brand/esc') }}">ESC</a></li>
                            <li class="dropdown"><a href="#"><span>BESTLAB</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="{{ url('/brand/bestlab-preparation') }}" {{ Request::is('brand/bestlab-preparation') ? 'active' : '' }}>Bestlab Preparation</a></li>
                                    <li><a href="{{ url('/brand/bestlab-instruments-environmental') }}" {{ Request::is('brand/bestlab-instruments-environmental') ? 'active' : '' }}>Bestlab Instruments Environment</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="{{ url('/category/environmental-laboratory-equipment') }}" class="{{ Request::is('/category/environmental-laboratory-equipment') ? 'active' : '' }}">Environmental Laboratory Equipment <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    @foreach($commonEnvironmental as $environmental)
                                        <li><a href="{{ url('/brand/'.$environmental->slug) }}">{{ $environmental->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a class="{{ Request::is('/mineral-and-coal-laboratory-equipment') ? 'active' : '' }}" href="{{ url('/category/mineral-and-coal-laboratory-equipment') }}">Mineral and Coal Laboratory Equipment <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    @foreach($commonMineral as $mineral)
                                        <li><a href="{{ url('/brand/'.$mineral->slug) }}">{{ $mineral->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="{{ Request::is('/general-laboratory-equipment') ? 'active' : '' }}" href="{{ url('/category/general-laboratory-equipment') }}">General Laboratory Equipment <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    @foreach($commonGeneral as $general)
                                        <li><a href="{{ url('/brand/'.$general->slug) }}">{{ $general->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="{{ Request::is('/water-purification-system') ? 'active' : '' }}" href="{{ url('/category/water-purification-system') }}">Water Purification System <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    @foreach($commonWaterPurification as $waterPurification)
                                        <li><a href="{{ url('/brand/'.$waterPurification->slug) }}">{{ $waterPurification->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a class="{{ Request::is('/products') ? 'active' : '' }}" href="{{ url('/products') }}">All Product</a></li>
                        </ul>
                    </li>
                    <li><a class="{{ Request::is('gallery') ? 'active' : '' }}" href="{{ url('/gallery') }}">Gallery</a></li>
                    <li><a class="{{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/#contact') }}">Contact</a></li>
                </ul>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>
<!-- End Header -->

