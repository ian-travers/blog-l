<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;

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
        $postAuthorPostsCount = $post->author->posts()
            ->published()
            ->count();

        return view('blog.show', compact('post', 'postAuthorPostsCount'));
    }

    public function category(Category $category)
    {
        $categoryName = $category->title;

        $posts = $category->posts()
            ->with('author')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'categoryName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()
            ->with('category')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'authorName'));
    }
}
