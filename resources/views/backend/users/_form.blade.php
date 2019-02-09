<div class="row">
    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0"><label>User details</label></h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('name') !!}
                    {!! Form::text('name', null, ['class' => [' form-control',$errors->has('name') ? 'is-invalid' : '']]) !!}
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group d-none">
                    {!! Form::text('slug') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email') !!}
                    {!! Form::text('email', null, ['class' => [' form-control',$errors->has('email') ? 'is-invalid' : '']]) !!}
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('password') !!}
                    {!! Form::password('password', ['class' => [' form-control',$errors->has('password') ? 'is-invalid' : '']]) !!}
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation') !!}
                    {!! Form::password('password_confirmation', ['class' => [' form-control',$errors->has('password-confirmation') ? 'is-invalid' : '']]) !!}
                    @if($errors->has('password-confirmation'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password-confirmation') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('role') !!}

                    @if($user->exists && ($user->id == config('cms.default_user_id')) || isset($hideRoleDropdown))
                        {!! Form::hidden('role', $user->roles()->first()->id) !!}
                        <p class="form-control-plaintext">{{ $user->roles()->first()->display_name }}</p>
                    @else
                        {!! Form::select(
                            'role',
                            App\Role::pluck('display_name', 'id'),
                            $user->exists ? $user->roles()->first()->id : null,
                            [
                                'class' => [
                                    ' form-control',
                                    $errors->has('role') ? 'is-invalid' : ''
                                ],
                                'placeholder' => '-- Choose a role --'
                            ]
                        ) !!}
                    @endif
                    @if($errors->has('role'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('role') }}</strong>
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    {!! Form::label('bio') !!}
                    {!! Form::textarea('bio', null, ['class' => 'form-control', 'rows' => 5]) !!}
                    @if($errors->has('bio'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('bio') }}</strong>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div><!-- /.row -->

