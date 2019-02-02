@extends('layouts.backend.main')

@section('title', 'BLOG create post')

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
                            <small>Create new post</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                {!! Form::model($post, [
                    'method' => 'post',
                    'route' => 'backend.blog.store',
                    'files' => true,
                ]) !!}

                @include('backend.blog._form')

                {!! Form::submit('Create Post', ['class' => 'btn btn-outline-primary']) !!}
                {!! Form::close() !!}

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $("ul.pagination").addClass("pagination-sm");

        var simplemde1 = new SimpleMDE({ element: $('#excerpt')[0] });
    </script>
@endsection


