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
            </div>
        </div>
    </div>
</div><!-- /.row -->

