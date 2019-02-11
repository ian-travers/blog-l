@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <article class="post-item post-detail">

                @php /* @var App\Post $post */ @endphp

                @if($post->image_url)

                    <div class="post-item-image">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                    </div>

                @endif

                <div class="post-item-body">
                    <div class="padding-10">
                        <h1>{{ $post->title }}</h1>

                        <div class="post-meta no-border">
                            <ul class="post-meta-group">
                                <li><i class="fa fa-user"></i><a href="{{ route('author', $post->author->slug) }}">{{ $post->author->name }}</a></li>
                                <li><i class="fa fa-clock-o"></i>
                                    <time> {{ $post->date }}</time>
                                </li>
                                <li><i class="fa fa-folder"></i><a href="{{ route('category', $post->category->slug) }}"> {{ $post->category->title }}</a></li>
                                <li><i class="fa fa-tags"></i>{!! $post->tags_html !!}</li>
                                <li>
                                    <i class="fa fa-comments"></i>
                                    <a href="#post-comments"> {{ $post->commentsNumber() }}</a>
                                </li>
                            </ul>
                        </div>
                         {!! $post->body_html !!}
                    </div>
                </div>
            </article>

            <article class="post-author padding-10">
                <div class="media">
                    <div class="media-left">
                        @php $author = $post->author @endphp
                        <a href="{{ route('author', $author->slug) }}">
                            <img height="100" width="100" alt="{{ $author->name }}" src="{{ $author->gravatar() }}" class="media-object">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{{ route('author', $author->slug) }}">{{ $author->name }}</a></h4>
                        <div class="post-author-count">
                            <a href="{{ route('author', $author->slug) }}">
                                <i class="fas fa-clone"></i>
                                {{ $postAuthorPostsCount }} {{ str_plural('post', $postAuthorPostsCount) }}
                            </a>
                        </div>
                        {!! $author->bio_html !!}
                    </div>
                </div>
            </article>

            @include('blog.comments')
        </div>

        @include('layouts.sidebar')

    </div>
</div>

@endsection
