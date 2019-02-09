<table class="table table-bordered">
    <thead>
    <tr>
        <td width="91">Action</td>
        <td>Name</td>
        <td>Email</td>
        <td>Role</td>
    </tr>
    </thead>
    <tbody>

    @php
        /* @var App\User $user */

        $currentUser = auth()->user();
    @endphp
    @foreach($users as $user)

        <tr>
            <td class="text-center">

                <a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>

                @if($user->id == config('cms.default_user_id') || $user->id == $currentUser->id)
                    <button type="submit" onclick="return false" class="btn btn-outline-danger btn-sm disabled">
                        <i class="fas fa-times"></i>
                    </button>
                @else
                    <a href="{{ route('backend.users.confirm', $user->id) }}" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-times"></i>
                    </a>
                @endif

            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles()->first()->display_name }}</td>
        </tr>

    @endforeach

    </tbody>
</table>

