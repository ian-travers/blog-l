<?php

namespace App\Providers;

use App\Views\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.sidebar', NavigationComposer::class);
    }
}
