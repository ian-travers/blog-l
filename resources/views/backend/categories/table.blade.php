<table class="table table-bordered">
    <thead>
    <tr>
        <td width="91">Action</td>
        <td>Category Name</td>
        <td width="120">Posts count</td>
    </tr>
    </thead>
    <tbody>

    @php /* @var App\Category $category */ @endphp
    @foreach($categories as $category)

        <tr>
            <td class="text-center">
                {!! Form::open([
                    'method' => 'delete',
                    'route' => ['backend.categories.destroy', $category->id],
                ]) !!}
                <a href="{{ route('backend.categories.edit', $category->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                @if($category->id == config('cms.default_category_id'))
                    <button type="submit" onclick="return false" class="btn btn-outline-danger btn-sm disabled">
                        <i class="fas fa-times"></i>
                    </button>
                @else
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm" title="Delete">
                        <i class="fas fa-times"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->posts->count() }}</td>
        </tr>

    @endforeach

    </tbody>
</table>

