@extends('front.layout.app')

@section('content')
    <div class="hero-area section-bg2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Service Details</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Service Details</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{asset($service->image)}}" alt="Blog image">
                        </div>
                        <div class="blog_details">
                            <h2 style="color: #2d2d2d;">
                                {{ $service->getTranslation('title', App::getLocale()) }}
                            </h2>
                            <p class="excert">
                                {{ $service->getTranslation('description', App::getLocale()) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search Keyword">
                                        <div class="input-group-append d-flex">
                                            <button class="boxed-btn2" type="button">Search</button>
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
    </section>
@endsection
