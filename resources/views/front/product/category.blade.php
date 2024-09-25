@extends('front.layout.app')

@section('content')
    <div class="hero-area section-bg2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>{{ $category->getTranslation('name', App::getLocale()) }}</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href={{ route('home') }}>{{ __('Home') }}</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href={{ route('products.index') }}>{{ __('Products') }}</a></li>
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
        <div class="container pt-30">
            <div class="row">
                <div class="col-lg-9">
                    <div class="products">
                        @foreach ($products as $product)
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href={{ route('product.show', ['product' => $product]) }}><img
                                                src="{{ asset($product->image) }}" alt=""
                                                style="max-width: 100%" /></a>
                                        <div class="socal_icon">
                                            <a href="#"><i class="ti-shopping-cart"></i></a>
                                            <a href="#"><i class="ti-heart"></i></a>
                                            <a href="#"><i class="ti-zoom-in"></i></a>
                                        </div>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3>
                                            <a
                                                href={{ route('product.show', ['product' => $product]) }}>{{ $product->getTranslation('title', App::getLocale()) }}</a>
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
                <div class="col-lg-3">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search Keyword" />
                                        <div class="input-group-append d-flex">
                                            <button class="boxed-btn2" type="button">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </aside>
                        <x-category-widget />
                        <x-blog-widget />
                    </div>
                </div>
            </div>
        </div>
    @endsection
