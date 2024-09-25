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
                <h2>{{ __('Services') }}</h2>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item">
                      <a href={{ route('home') }}>{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item"><a href={{ route('services.index') }}>{{ __('Services') }}</a></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="categories-area">
  <div class="container">
      <div class="row">
          @foreach ($services as $service)
              <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="single-cat mb-50 wow fadeInUp text-center" data-wow-duration="1s" data-wow-delay=".2s">
                      <div class="cat-icon">
                          <img src="{{asset('front/assets/img/icon/services2.svg')}}" alt="" />
                      </div>
                      <div class="cat-cap">
                          <h5>{{ $service->getTranslation('title', App::getLocale()) }}</h5>
                          <p class="ellipsis2">{{ $service->getTranslation('description', App::getLocale()) }}</p>
                      </div>
                  </div>
              </div>
          @endforeach        
       
      </div>
  </div>
</div>
@endsection