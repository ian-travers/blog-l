<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    protected $activeMenuItem;
    protected $activeMenuSubItem;

    public function __construct()
    {
        $this->middleware('auth');
    }
}
