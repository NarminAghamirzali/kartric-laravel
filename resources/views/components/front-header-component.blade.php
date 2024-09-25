<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{asset('front/assets/img/logo/logo-color-single.svg')}}" alt="loder" />
            </div>
        </div>
    </div>
</div>
<header>
    <div class="header-area">
        
        <div class="header-mid header-sticky">
            <div class="container">
                <div class="menu-wrapper">
                    <div class="logo">
                        <a href={{ route('home') }}><img src="{{ asset('front/assets/img/logo/logo2.svg') }}" alt="" height="48"/></a>
                    </div>

                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a href={{ route('home') }}>{{ __('Home') }}</a></li>
                                <li><a href={{ route('about') }}>{{ __('About Us') }}</a></li>
                                <li><a href={{ route('services.index') }}>{{ __('Services') }}</a></li>
                                <li>
                                    <a href={{ route('products.index') }}>{{ __('Products') }} <i class="fas fa-angle-down"></i></a>
                                    <ul class="submenu">
                                        @foreach($categories as $category)
                                            <li><a href={{ route('products.show', ['category' => $category]) }}>{{ $category->getTranslation('name', App::getLocale()) }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href={{ route('blog.index') }}>{{ __('Blog') }}</a></li>
                                <li><a href={{ route('contact') }}>{{ __('Contact Us') }}</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="header-right">
                        <ul>
                            <li>
                                <div class="nav-search search-switch hearer_icon">
                                    <a id="search_1" href="javascript:void(0)">
                                        <span class="flaticon-search"></span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <form action="{{ LaravelLocalization::getLocalizedURL(null, null, [], true) }}" method="GET">
                                    <select class="form-select" name="locale" onchange="window.location.href=this.value">
                                        @foreach ($langs as $lang)
                                            <option value="{{ LaravelLocalization::getLocalizedURL($lang) }}" {{ App::getLocale() == $lang ? 'selected' : '' }}>
                                                {{ $lang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="search_input" id="search_input_box">
                    <form class="search-inner d-flex justify-content-between">
                        <input type="text" class="form-control" id="search_input" placeholder="Search Here" />
                        <button type="submit" class="btn"></button>
                        <span class="ti-close" id="close_search" title="Close Search"></span>
                    </form>
                </div>

                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
        {{-- <div class="header-bottom text-center">
            <p>
                Sale Up To 50% Biggest Discounts. Hurry! Limited Perriod Offer
                <a href="#" class="browse-btn">Shop Now</a>
            </p>
        </div> --}}
    </div>
</header>
