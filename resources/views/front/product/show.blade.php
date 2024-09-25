@extends('front.layout.app')

@section('content')
    <div class="hero-area section-bg2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>{{ $product->getTranslation('title', App::getLocale()) }}</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href={{ route('home') }}>{{ __('Home') }}</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href={{ route('products.index') }}>{{ __('Products') }}</a></li>
                                        <li class="breadcrumb-item"><a
                                                href={{ route('product.show', ['product' => $product]) }}>{{ $product->getTranslation('title', App::getLocale()) }}</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="all-products">
        <div class="container pt-30 pb-30 ">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ asset($product->image) }}" alt={{ $product->image }} style="max-width: 90%" />
                </div>
                <div class="col-lg-6">
                    <h2> {{ $product->getTranslation('title', App::getLocale()) }} </h2>
                    <p>
                        {{ $product->getTranslation('description', App::getLocale()) }}
                    </p>
                    <p>
                      {{ $product->getTranslation('technical_description', App::getLocale()) }}
                  </p>
                    {{-- <a href={{ route('about') }} class="about-btn">Etrafli</a> --}}
                </div>
            </div>
        </div>
    @endsection
