<footer>
    <div class="footer-wrapper gray-bg">
      <div class="footer-area footer-padding">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-8">
              <div class="single-footer-caption mb-50">
                <div class="single-footer-caption mb-20">
                  <div class="footer-logo mb-35">
                    <a href={{ route('home') }}><img src="{{ asset('front/assets/img/logo/logo5.svg') }}" alt="" height="64"/></a>
                    <ul class="header-social" style="display: flex; gap: 8px;">
                      <li>
                          <a href="#"><i class="fab fa-facebook"></i></a>
                      </li>
                      <li>
                          <a href="#"><i class="fab fa-instagram"></i></a>
                      </li>
                      <li>
                          <a href="#"><i class="fab fa-twitter"></i></a>
                      </li>
                      <li>
                          <a href="#"><i class="fab fa-linkedin-in"></i></a>
                      </li>
                      <li>
                          <a href="#"><i class="fab fa-youtube"></i></a>
                      </li>
                  </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
              <div class="single-footer-caption mb-50">
                <div class="footer-tittle">
                  <h4>{{ __('Contact Us') }}</h4>
                  <ul>
                    <li><a href="#">{{$contacts[0]->tel_1}}</a></li>
                    <li><a href="#">{{$contacts[0]->tel_2}}</a></li>
                    <li><a href="#">{{$contacts[0]->email}}</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
              <div class="single-footer-caption mb-50">
                <div class="footer-tittle">
                  <h4>{{ __('Services') }}</h4>
                  <ul>
                    @foreach($services as $service)
                      <li><a href={{ route('services.show', ['service' => $service]) }}>{{ $service->getTranslation('title', App::getLocale()) }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
              <div class="single-footer-caption mb-50">
                <div class="footer-tittle">
                  <h4>{{ __('Categories') }}</h4>
                  <ul>
                    @foreach($categories as $category)
                      <li><a href={{ route('products.show', ['category' => $category]) }}>{{ $category->getTranslation('name', App::getLocale()) }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
              <div class="single-footer-caption mb-50">
                <div class="footer-tittle">
                  <h4>{{ __('Links') }}</h4>
                  <ul>
                    <li><a href={{ route('home') }}>{{ __('Home') }}</a></li>
                    <li><a href={{ route('about') }}>{{ __('About Us') }}</a></li>
                    <li><a href={{ route('services.index') }}>{{ __('Services') }}</a></li>
                    <li><a href={{ route('products.index') }}>{{ __('Products') }}</a></li>
                    <li><a href={{ route('blog.index') }}>{{ __('Blog') }}</a></li>
                    <li><a href={{ route('contact') }}>{{ __('Contact Us') }}</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom-area">
        <div class="container">
          <div class="footer-border">
            <div class="row">
              <div class="col-xl-12">
                <div class="footer-copy-right text-center">
                  <p>
                    Copyright &copy;
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    All rights reserved | This site is made with
                    <i
                      class="fa fa-heart color-danger"
                      aria-hidden="true"
                    ></i>
                    by
                    <a
                      href="https://www.linkedin.com/in/narmin-aghamirzali-61b114242/"
                      target="_blank"
                      rel="nofollow noopener"
                      >Narmin</a
                    >
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="back-top">
    <a class="wrapper" title="Go to Top" href="#">
      <div class="arrows-container">
        <div class="arrow arrow-one"></div>
        <div class="arrow arrow-two"></div>
      </div>
    </a>
  </div>
