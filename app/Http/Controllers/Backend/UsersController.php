<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;

class UsersController extends CoreController
{
    protected $perPage = 6;

    public function __construct()
    {
        parent::__construct();
        $this->activeMenuItem = 'Users';
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate($this->perPage);
        $usersCount = User::count();

        $this->activeMenuSubItem = 'All Users';

        return view('backend.users.index', [
            'users' => $users,
            'usersCount' => $usersCount,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem
        ]);
    }

    public function create()
    {
        $this->activeMenuSubItem = 'Add User';

        $user = new User();

        return view('backend.users.create', [
            'user' => $user,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug(str_random() . '-' . $data['name']);

        $user = User::create($data);
        $user->attachRole($request->role);


        return redirect()->route('backend.users.index')->with([
            'type' => 'success',
            'message' => 'The user has been created.',
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->activeMenuSubItem = 'Edit User';

        $user = User::findOrFail($id);

        return view('backend.users.edit', [
            'user' => $user,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $user->detachRoles();
        $user->attachRole($request->role);

        return redirect()->route('backend.users.index')->with([
            'type' => 'success',
            'message' => 'The user has been updated.',
        ]);
    }

    public function destroy(UserDestroyRequest $request, $id)
    {
        $user =  User::findOrFail($id);

        $deleteOption = $request->delete_option;
        $selectedUser = $request->selected_user;

        if ($deleteOption == 'delete') {
            // delete user posts
            $user->posts()->withTrashed()->forceDelete();
        } elseif ($deleteOption == 'attribute') {
            $user->posts()->update(['author_id' => $selectedUser]);
        }
//        $user->delete();

        return redirect()->route('backend.users.index')->with([
            'type' => 'success',
            'message' => 'The user has been deleted.',
        ]);
    }

    public function confirm(UserDestroyRequest $request, $id)
    {
        $this->activeMenuSubItem = 'All Users';

        $user =  User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->pluck('name', 'id');

        return view('backend.users.confirm', [
            'user' => $user,
            'users' => $users,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }
}
