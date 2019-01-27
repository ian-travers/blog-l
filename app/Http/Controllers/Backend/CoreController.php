<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
