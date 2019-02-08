<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    protected $perPage = 6;

    protected $activeMenuItem;
    protected $activeMenuSubItem;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permissions');
    }
}
