<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;

class BlogController extends Controller
{
    protected $postsPerPage = 5;

    public function index()
    {
        $posts = Post::with('author', 'tags', 'category', 'comments')
            ->latestFirst()
            ->published()
            ->filter(request()->only(['term', 'month', 'year']))
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
//         #1
//         update posts SET views_count (needs $fillable for model class)
//        $viewsCount = $post->views_count + 1;
//        $post->update(['views_count' => $viewsCount]);

//        #2
        $post->increment('views_count');

        $postComments = $post->comments()->simplePaginate(3);


        $postAuthorPostsCount = $post->author->posts()
            ->published()
            ->count();

        return view('blog.show', compact('post', 'postAuthorPostsCount', 'postComments'));
    }

    public function category(Category $category)
    {
        $categoryName = $category->title;

        $posts = $category->posts()
            ->with('author', 'tags', 'comments')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'categoryName'));
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->name;

        $posts = $tag->posts()
            ->with('author', 'category', 'comments')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'tagName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()
            ->with('category', 'tags', 'comments')
            ->latestFirst()
            ->published()
            ->paginate($this->postsPerPage);

        return view('blog.index', compact('posts', 'authorName'));
    }
}
