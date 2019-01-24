<?php

namespace App\Providers;

use App\Category;
use App\Post;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            $categories = Category::with(['posts' => function ($query) {
                $query->published();
            }])->orderBy('title')->get();

            return $view->with('categories', $categories);
        });

        view()->composer('layouts.sidebar', function ($view) {
            $popularPosts = Post::published()->popular()->take(3)->get();
            return $view->with('popularPosts', $popularPosts);
        });
    }
}
