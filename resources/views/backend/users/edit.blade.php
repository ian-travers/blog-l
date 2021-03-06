@extends('layouts.backend.main')

@section('title', 'USERS edit user')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Users
                            <small>Edit User</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}">Users</a></li>
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

                {!! Form::model($user, [
                    'method' => 'put',
                    'route' => ['backend.users.update', $user->id],
                    'id' => 'user-form',
                ]) !!}

                @include('backend.users._form')

                {!! Form::submit('Update', ['class' => 'btn btn-outline-primary']) !!}
                <a href="{{ route('backend.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                {!! Form::close() !!}

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



