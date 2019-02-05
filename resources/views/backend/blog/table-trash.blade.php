<table class="table table-bordered">
    <thead>
    <tr>
        <td width="91">Action</td>
        <td>Title</td>
        <td width="120">Author</td>
        <td width="150">Category</td>
        <td width="171">Date</td>
    </tr>
    </thead>
    <tbody>

    @php /* @var App\Post $post */ @endphp
    @foreach($posts as $post)

        <tr>
            <td class="text-center">
                {!! Form::open([
                    'class' => 'd-inline-block',
                    'method' => 'put',
                    'route' => ['backend.blog.restore', $post->id],
                ]) !!}
                <button type="submit" class="btn btn-outline-secondary btn-sm" title="Restore">
                    <i class="fas fa-trash-restore"></i>
                </button>
                {!! Form::close() !!}

                {!! Form::open([
                    'class' => 'd-inline-block',
                    'method' => 'delete',
                    'route' => ['backend.blog.force-destroy', $post->id],
                ]) !!}
                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete permanent" onclick="return confirm('You are aboiy to delete a post permanently. Are you sure?')">
                    <i class="fas fa-times"></i>
                </button>
                {!! Form::close() !!}
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
            </td>
        </tr>

    @endforeach

    </tbody>
</table>

