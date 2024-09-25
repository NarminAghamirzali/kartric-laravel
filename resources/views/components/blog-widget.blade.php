<aside class="single_sidebar_widget popular_post_widget">
    <h3 class="widget_title" style="color: #2d2d2d">
        {{ __('Recent Blogs') }}
    </h3>
    @foreach ($blogs as $blog)
        <div class="media post_item">
            <img src="{{ asset($blog->image) }}" alt="post" width="80" height="80"/>
            <div class="media-body">
                <a href={{ route('blog.show', ['blog' => $blog]) }}>
                    <h3 style="color: #2d2d2d">
                        {{$blog->getTranslation('title', App::getLocale())}}
                    </h3>
                </a>
                <p>{{$blog->created_at}}</p>
            </div>
        </div>
    @endforeach
</aside>
