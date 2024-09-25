<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title" style="color: #2d2d2d">{{ __('Categories') }}</h4>
    <ul class="list cat-list">
      @foreach($categories as $category)
        <li>
          <a href={{ route('products.show', ['category' => $category]) }} class="d-flex">
            <p>{{ $category->getTranslation('name', App::getLocale()) }}</p>
          </a>
        </li>
      @endforeach
    </ul>
</aside>