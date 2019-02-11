<div class="col-3">
    <aside class="right-sidebar">
        <div class="search-widget">
            <form action="{{ route('blog.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" value="{{ request('term') }}" name="term" placeholder="Search for...">
                    <button class="btn btn-lg border ml-0 input-group-append" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div><!-- /input-group -->
            </form>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">

                    @foreach($categories as $category)
                        @php /* @var App\Category $category */ @endphp

                        <li>
                            <div>
                                <a href="{{ route('category', $category->slug) }}"><i
                                            class="fas fa-angle-right"></i> {{ $category->title }}</a>
                                <span class="badge badge-secondary float-right">{{ $category->posts->count() }}</span>
                            </div>

                        </li>

                    @endforeach

                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">

                    @foreach($popularPosts as $post)

                        <li>

                            @if($post->image_thumb_url)

                                <div class="post-image">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <img src="{{ $post->image_thumb_url }}"/>
                                    </a>
                                </div>

                            @endif

                            <div class="post-body">
                                <h6><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h6>
                                <div class="post-meta">
                                    <span>{{ $post->date }}</span>
                                </div>
                            </div>
                        </li>

                    @endforeach

                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">

                    @foreach($tags as $tag)

                        <li><a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a></li>

                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Archives</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">

                    @foreach($archives as $archive)

                        <li>
                            <a href="{{ route('blog.index', ['month' => $archive->month, 'year' => $archive->year]) }}">{{ $archive->month . ' ' . $archive->year }}</a>
                            <span class="badge badge-secondary float-right">{{ $archive->post_count }}</span>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>

