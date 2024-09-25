@extends('front.layout.app')

@section('content')
<div class="hero-area section-bg2">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="slider-area">
          <div
            class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center"
          >
            <div class="hero-caption hero-caption2">
              <h2>{{ __('Blog') }}</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item">
                    <a href={{ route('home') }}>{{ __('Home') }}</a>
                  </li>
                  <li class="breadcrumb-item"><a href={{ route('blog.index') }}>{{ __('Blog') }}</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="blog_area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mb-5 mb-lg-0">
        <div class="blog_left_sidebar">

          @foreach ($blogs as $blog)
            <article class="blog_item">
              <div class="blog_item_img">
                <img
                  class="card-img rounded-0"
                  src="{{asset($blog->image)}}"
                  alt=""
                />
                <a href="#" class="blog_item_date">
                  <h3>15</h3>
                  <p>Jan</p>
                </a>
              </div>
              <div class="blog_details">
                <a class="d-inline-block" href={{ route('blog.show', ['blog' => $blog]) }}>
                  <h2 class="blog-head" style="color: #2d2d2d">
                    {{$blog->getTranslation('title', App::getLocale())}}
                  </h2>
                </a>
                <p style="max-width: 700px;" class="ellipsis2">
                  {{$blog->getTranslation('description', App::getLocale())}}
                </p>
              </div>
            </article>
          @endforeach
          <nav class="blog-pagination justify-content-center d-flex">
            <ul class="pagination">
              <li class="page-item">
                <a href="#" class="page-link" aria-label="Previous">
                  <i class="ti-angle-left"></i>
                </a>
              </li>
              <li class="page-item">
                <a href="#" class="page-link">1</a>
              </li>
              <li class="page-item active">
                <a href="#" class="page-link">2</a>
              </li>
              <li class="page-item">
                <a href="#" class="page-link" aria-label="Next">
                  <i class="ti-angle-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="blog_right_sidebar">
          <aside class="single_sidebar_widget search_widget">
            <form action="#">
              <div class="form-group m-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder={{ __('Search') }}>
                  <div class="input-group-append d-flex">
                      <button class="boxed-btn2" type="button">{{ __('Search') }}</button>
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