@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                @if(!$posts->count())
                    <div class="alert alert-warning">
                        Nothing found
                    </div>
                @else
                    @if(isset($categoryName))
                        <div class="alert alert-info">
                            Category: <strong>{{ $categoryName }}</strong>
                        </div>
                    @endif

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
                                            <li><i class="fa fa-user"></i><a href="#">{{ $post->author->name }}</a></li>
                                            <li><i class="fa fa-clock-o"></i>Created {{ $post->date }}</li>
                                            <li><i class="fa fa-clock-o"></i>Published {{ $post->published_date }}</li>
                                            <li><i class="fa fa-folder"></i><a href="{{ route('category', $post->category->slug) }}"> {{ $post->category->title }}</a></li>
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
                    {{ $posts->links() }}
                </nav>
            </div>

            @include('layouts.sidebar')

        </div>
    </div>

@endsection
