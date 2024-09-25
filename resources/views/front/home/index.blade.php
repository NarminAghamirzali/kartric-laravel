@extends('front.layout.app')

@section('content')
    <section class="slider-area">
        <div class="slider-active">
            @foreach($banners as $banner)
                <div class="single-slider slider-height d-flex align-items-center" style="background: rgba(0, 0, 0, 0.5) url({{asset($banner->image)}});    background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;">
                    <div class="container">
                        <div class="rowr">
                            <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-8 col-sm-10">
                                <div class="hero-caption text-center">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">
                                        {{ $banner->getTranslation('title', App::getLocale()) }}
                                    </h1>
                                    <p data-animation="fadeInUp" data-delay="0.4s">
                                        {{ $banner->getTranslation('description', App::getLocale()) }}
                                    </p>
                                    <a href="#" class="btn_1 hero-btn" data-animation="fadeInUp" data-delay="0.7s">Apply now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="about-area pt-50">
        <div class="container">
            <div class="row">
                @foreach ($abouts as $about)
                    <div class="col-md-4">
                        <img src="{{asset($about->image)}}" alt=""  />
                    </div> 
                    <div class="col-md-8">
                        <h2> {{ $about->getTranslation('about', App::getLocale()) }} </h2>
                        <p>
                            {{ $about->getTranslation('mission', App::getLocale()) }} 
                        </p>
                        <a href={{ route('about') }} class="about-btn">{{ __('Read More') }}</a>
                    </div> 
                @endforeach
            </div>
        </div>
    </section>
    <div class="latest-items section-padding fix">
        <div class="row justify-content-center">
            <div class="cl-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle text-center mb-40">
                    <h2>{{ __('Trendy Products') }}</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                    <div class="latest-items-active">

                        @foreach ($products as $product)
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href={{ route('product.show', ['product' => $product]) }}>
                                            <img src={{ asset($product->image) }} alt="" style="max-width: 100%; height:300px; object-fit: scale-down"/>
                                        </a>
                                        <div class="socal_icon">
                                            <a href="#"><i class="ti-shopping-cart"></i></a>
                                            <a href="#"><i class="ti-heart"></i></a>
                                            <a href="#"><i class="ti-zoom-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3>
                                            <a href={{ route('product.show', ['product' => $product]) }}>{{ $product->getTranslation('title', App::getLocale()) }}</a>
                                        </h3>
                                        <div class="properties-footer">
                                            <div class="price">
                                                <span>{{ $product->price }} AZN</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="home-blog">
        <div class="container">
            <div class="row justify-content-center">
                <div class="cl-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle text-center mb-40">
                        <h2>{{ __('Latest Blogs') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-blogs mb-30">
                            <div class="blog-img">
                                <a href="{{ route('blog.show', ['blog' => $blog]) }}"><img src="{{asset($blog->image)}}" alt="" width="416" height="304"/></a>
                            </div>
                            <div class="blogs-cap">
                                <h5>
                                    <a href="{{ route('blog.show', ['blog' => $blog]) }}">{{$blog->getTranslation('title', App::getLocale())}}</a>
                                </h5>
                                <p class="ellipsis2">
                                    {{$blog->getTranslation('description', App::getLocale())}}
                                </p>
                                <a href="{{ route('blog.show', ['blog' => $blog]) }}" class="about-btn">{{ __('Read More') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="categories-area">
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                    <a href="{{ $service->getTranslation('slug', App::getLocale()) }}" class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-cat mb-50 wow fadeInUp text-center" data-wow-duration="1s" data-wow-delay=".2s">
                            <div class="cat-icon">
                                <img src="{{asset('front/assets/img/icon/services2.svg')}}" alt="" />
                            </div>
                            <div class="cat-cap">
                                <h5>{{ $service->getTranslation('title', App::getLocale()) }}</h5>
                                <p class="ellipsis">{{ $service->getTranslation('description', App::getLocale()) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <section class="latest-items section-padding fix">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle text-center mb-40">
                    <h2>{{ __('Partners') }}</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="latest-items-active" >

                @foreach ($partners as $partner)
                    
                    <div class="properties">
                        <div class="properties-card">
                            <div class="properties-img centerimg">
                                <img src="{{asset($partner->image)}}" alt="" style="    max-width: 200px !important;"/>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
