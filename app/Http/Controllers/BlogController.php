<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

class BlogController extends Controller
{
    protected $postsPerPage = 3;

    public function index()
    {
        $categories = Category::with(['posts' => function ($query) {
            $query->published();
        }])->orderBy('title')->get();

        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }

    public function category(Category $category)
    {
        $categories = Category::with(['posts' => function ($query) {
            $query->published();
        }])->orderBy('title')->get();

        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->where('category_id', $category->id)
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'categories'));
    }
}
