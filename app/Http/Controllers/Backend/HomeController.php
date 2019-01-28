<?php

namespace App\Http\Controllers\Backend;

class HomeController extends CoreController
{
    protected $activeMenuItem = 'Dashboard';
    protected $activeMenuSubItem = '';

    public function index()
    {
        return view('backend.home', [
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem
        ]);
    }
}
