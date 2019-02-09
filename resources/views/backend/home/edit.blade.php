@extends('layouts.backend.main')

@section('title', 'Edit account')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Account
                            <small>Edit Account</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit account</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                @include('layouts.backend._messages')

                {!! Form::model($user, [
                    'method' => 'put',
                    'url' => '/edit-account',
                    'id' => 'user-form',
                ]) !!}

                @include('backend.users._form', ['hideRoleDropdown' => true])

                {!! Form::submit('Update', ['class' => 'btn btn-outline-primary']) !!}
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
                {!! Form::close() !!}

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



