<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Image;

class BlogController extends CoreController
{
    protected $uploadPath;
    protected $perPage;

    public function __construct()
    {
        parent::__construct();
        $this->activeMenuItem = 'Blog';
        $this->perPage = 5;
        $this->uploadPath = public_path(config('cms.image.directory'));
    }


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

    public function create(Post $post)
    {
        $this->activeMenuSubItem = 'Add Post';

        return view('backend.blog.create', [
            'post' => $post,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);

        $request->user()->posts()->create($data);

        return redirect()->route('backend.blog.index')->with([
            'type' => 'success',
            'message' => 'The post has been created.',
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->activeMenuSubItem = 'Edit Post';

        $post = Post::findOrFail($id);

        return view('backend.blog.edit', [
            'post' => $post,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $this->handleRequest($request);

        $post->update($data);

        return redirect()->route('backend.blog.index')->with([
            'type' => 'success',
            'message' => 'The post has been updated.',
        ]);
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('backend.blog.index')->with([
            'type' => 'success',
            'message' => 'The post has been deleted.',
        ]);
    }

    private function handleRequest(PostRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = $image->move($destination, $fileName);
            if ($successUploaded) {
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }

            $data['image'] = $fileName;
        }

        return $data;
    }
}
