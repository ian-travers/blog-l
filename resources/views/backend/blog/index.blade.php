@extends('layouts.backend.main')

@section('title', 'BLOG index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Blog
                            <small>Display All blog posts</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
                            <li class="breadcrumb-item active">All Posts</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @include('layouts.backend._messages')

                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('backend.blog.create') }}" class="btn btn-outline-success">Create Post ...</a>
                            </div>
                            <div class="card-body">

                                @if(!$posts->count())

                                    <div class="alert alert-warning">
                                        <h3>No record found</h3>
                                    </div>

                                @else

                                    <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td width="91">Action</td>
                                        <td>Title</td>
                                        <td width="120">Author</td>
                                        <td width="150">Category</td>
                                        <td width="171">Date</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php /* @var App\Post $post */ @endphp
                                    @foreach($posts as $post)

                                        <tr>
                                            <td class="text-center">
                                                <a href="{{ route('backend.blog.edit', $post) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a href="{{ route('backend.blog.destroy', $post->id) }}" class="btn btn-outline-danger btn-sm" title="Delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->author->name }}</td>
                                            <td>{{ $post->category->title }}</td>
                                            <td>
                                                <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
                                                {!! $post->publicationLabel() !!}
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>


                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3">
                                            {{ $posts->links() }}
                                        </div>
                                        <div class="mt-3">
                                            Total: {{ $postsCount }} {{ str_plural('item', $postsCount) }}
                                        </div>
                                    </div>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $("ul.pagination").addClass("pagination-sm");
    </script>
@endsection


