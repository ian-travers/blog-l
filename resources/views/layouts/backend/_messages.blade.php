@if(session('type'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        <strong>{{ ucfirst(session('type')) }}!</strong> {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session('trash-message'))
    <div class="alert alert-info">
        @php list($message, $postId) = session('trash-message')  @endphp
        {!! Form::open([
            'method' => 'put',
            'route' => ['backend.blog.restore', $postId]
        ]) !!}

        {{ $message }}

        <button type="submit" class="btn btn-sm btn-warning">
            <i class="fas fa-undo"></i>
            Undo
        </button>

        {!! Form::close() !!}
    </div>
@endif



