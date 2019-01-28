<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BlogController extends CoreController
{
    protected $activeMenuItem = 'Blog';

    protected $perPage = 5;


    public function index()
    {
        $this->activeMenuSubItem = 'All Posts';
        $posts = Post::with('category', 'author')->latest()->paginate($this->perPage);
        $postsCount = Post::count();

        return view('backend.blog.index', [
            'posts' => $posts,
            'postsCount' => $postsCount,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function create()
    {
        dd('Create post');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
