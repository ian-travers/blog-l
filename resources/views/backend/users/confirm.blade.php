@extends('layouts.backend.main')

@section('title', 'Delete confirmation User')

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
                            <small>Delete confirmation</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Delete Confirmation</li>
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
                    'method' => 'delete',
                    'route' => ['backend.users.destroy', $user->id],
                ]) !!}

                <div class="card">
                    <div class="card-header">
                        You have specified this user for deletion
                    </div>
                    <div class="card-body">
                        <p>ID #{{ $user->id }}: {{ $user->name }}</p>
                        <p>What should be done with content own by this user?</p>
                        <p>
                            <input type="radio" name="delete_option" value="delete" checked> Delete All Content
                        </p>
                        <p>
                            <input type="radio" name="delete_option" value="attribute"> Attribute content to:
                            {!! Form::select('selected_user', $users, null) !!}
                        </p>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Confirm Deletion', ['class' => 'btn btn-outline-danger']) !!}
                        <a href="{{ route('backend.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



