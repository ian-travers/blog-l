<?php

namespace App\Http\Controllers;

use App\Post;

class BlogController extends Controller
{
    protected $postsPerPage = 4;

    public function index()
    {
        $posts = Post::with('author')->latestFirst()->paginate($this->postsPerPage);

        return view('blog.index', compact('posts'));
    }
}
