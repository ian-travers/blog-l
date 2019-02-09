<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Http\Request;

class HomeController extends CoreController
{
    protected $activeMenuItem = 'Dashboard';
    protected $activeMenuSubItem = '';

    public function index()
    {
        return view('backend.home.index', [
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem
        ]);
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        return view('backend.home.edit', [
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
            'user' => $user,
        ]);
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = $request->user();
        $user->update($request->all());

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Saved.'
        ]);
    }
}
