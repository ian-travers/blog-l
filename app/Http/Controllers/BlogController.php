<?php

namespace App\Http\Controllers;

use App\Post;

class BlogController extends Controller
{
    protected $postsPerPage = 3;

    public function index()
    {
        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }
}
