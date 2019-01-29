@if (session('type'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        <strong>{{ ucfirst(session('type')) }}!</strong> {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif



