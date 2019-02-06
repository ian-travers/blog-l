<div class="row">
    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0"><label>Category content</label></h5>
            </div>
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
                    {!! Form::text('slug') !!}
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->

