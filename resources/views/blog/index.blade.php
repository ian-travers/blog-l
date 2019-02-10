@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                @if(!$posts->count())
                    <div class="alert alert-warning">
                        Nothing found
                    </div>
                @else

                    @include('blog.alert')

                    @foreach($posts as $post)
                        @php /* @var App\Post $post */ @endphp

                        <article class="post-item">

                            @if($post->image_url)

                                <div class="post-item-image">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <img src="{{ $post->image_url }}" alt="">
                                    </a>
                                </div>

                            @endif


                            <div class="post-item-body">
                                <div class="padding-10">
                                    <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                    {!! $post->excerpt_html !!}
                                </div>

                                <div class="post-meta padding-10 clearfix">
                                    <div class="pull-left">
                                        <ul class="post-meta-group">
                                            <li><i class="fa fa-user"></i><a
                                                        href="{{ route('author', $post->author->slug) }}">{{ $post->author->name }}</a>
                                            </li>
                                            <li><i class="fa fa-clock"></i>Created {{ $post->date }}</li>
                                            <li><i class="fa fa-clock"></i>Published {{ $post->published_date }}</li>
                                            <li><i class="fa fa-folder"></i><a
                                                        href="{{ route('category', $post->category->slug) }}"> {{ $post->category->title }}</a>
                                            </li>
                                            <li><i class="fa fa-tags"></i>{!! $post->tags_html !!}</li>
                                            <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('blog.show', $post->slug) }}">Continue Reading &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                    @endforeach
                @endif


                <nav>
                    {{ $posts->appends(request()->only('term'))->links() }}
                </nav>
            </div>

            @include('layouts.sidebar')

        </div>
    </div>

@endsection
