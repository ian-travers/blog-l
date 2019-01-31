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

                <div class="row">
                    <div class="col">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('title') !!}
                                    {!! Form::text('title', null, ['class' => [' form-control',$errors->has('title') ? 'is-invalid' : '']]) !!}
                                    @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group d-none">
                                    {!! Form::label('slug') !!}
                                    {!! Form::text('slug') !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('excerpt') !!}
                                    {!! Form::textarea('excerpt', null, ['class' => [' form-control',$errors->has('excerpt') ? 'is-invalid' : ''], 'rows' => 4]) !!}
                                    @if($errors->has('excerpt'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('excerpt') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {!! Form::label('body') !!}
                                    {!! Form::textarea('body', null, ['class' => [' form-control',$errors->has('body') ? 'is-invalid' : '']]) !!}
                                    @if($errors->has('body'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">{!! Form::label('category_id', 'Category') !!}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::select('category_id', App\Category::pluck('title', 'id'), null, ['class' => ['form-control', $errors->has('category_id') ? 'is-invalid' : ''], 'placeholder' => '-- Choose Category --']) !!}
                                    @if($errors->has('category_id'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">{!! Form::label('image', 'Feature Image') !!}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::file('image', ['class' => ['form-control-file', $errors->has('image') ? 'is-invalid' : '']]) !!}
                                    @if($errors->has('image'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">{!! Form::label('published_at', 'Publish Date') !!}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::datetimeLocal('published_at', null, ['class' => [' form-control', $errors->has('published_at') ? 'is-invalid' : '']]) !!}
                                    @if($errors->has('published_at'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('published_at') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->

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
    </script>
@endsection


