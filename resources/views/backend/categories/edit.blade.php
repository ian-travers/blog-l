@extends('layouts.backend.main')

@section('title', 'BLOG edit category')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Categories
                            <small>Edit Category</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.categories.index') }}">Blog</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                {!! Form::model($category, [
                    'method' => 'put',
                    'route' => ['backend.categories.update', $category->id],
                    'id' => 'category-form',
                ]) !!}

                @include('backend.categories._form')

                {!! Form::submit('Update', ['class' => 'btn btn-outline-primary']) !!}
                <a href="{{ route('backend.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                {!! Form::close() !!}

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



