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

    @php
        /* @var App\Post $post */

        $request = request();
    @endphp

    @foreach($posts as $post)

        <tr>
            <td class="text-center">
                {!! Form::open([
                    'method' => 'delete',
                    'route' => ['backend.blog.destroy', $post->id],
                ]) !!}

                @if(check_user_permission($request, "Blog@edit", $post->id))
                    <a href="{{ route('backend.blog.edit', $post) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                @else
                    <a href="#" class="btn btn-outline-secondary btn-sm disabled">
                        <i class="fas fa-edit"></i>
                    </a>
                @endif

                @if(check_user_permission($request, "Blog@destroy", $post->id))
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Move to Trash">
                        <i class="fas fa-trash"></i>
                    </button>
                @else
                    <button type="button" onclick="return false;" class="btn btn-outline-danger btn-sm disabled">
                        <i class="fas fa-trash"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
                {!! $post->publicationLabel() !!}
            </td>
        </tr>

    @endforeach

    </tbody>
</table>

