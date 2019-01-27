<?php

namespace App\Http\Controllers\Backend;

class HomeController extends CoreController
{
    public function index()
    {
        return view('home');
    }
}
