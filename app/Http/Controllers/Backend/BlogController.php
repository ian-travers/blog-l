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

    public function __construct()
    {
        parent::__construct();
        $this->activeMenuItem = 'Blog';
        $this->uploadPath = public_path(config('cms.image.directory'));
    }


    public function index(Request $request)
    {
        $onlyTrashed = false;

        if (($status = $request->get('status')) && $status == 'trash') {
            $posts = Post::onlyTrashed()->with('category', 'author')->latest()->paginate($this->perPage);
            $postsCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        } elseif ($status == 'published') {
            $posts = Post::published()->with('category', 'author')->latest()->paginate($this->perPage);
            $postsCount = Post::published()->count();
        } elseif ($status == 'scheduled') {
            $posts = Post::scheduled()->with('category', 'author')->latest()->paginate($this->perPage);
            $postsCount = Post::scheduled()->count();
        } elseif ($status == 'draft') {
            $posts = Post::draft()->with('category', 'author')->latest()->paginate($this->perPage);
            $postsCount = Post::draft()->count();
        } elseif ($status == 'own') {
            $posts = $request->user()->posts()->with('category', 'author')->latest()->paginate($this->perPage);
            $postsCount = $request->user()->posts()->count();
        } else {
            $posts = Post::with('category', 'author')->latest()->paginate($this->perPage);
            $postsCount = Post::count();
        }

        $this->activeMenuSubItem = 'All Posts';

        return view('backend.blog.index', [
            'posts' => $posts,
            'postsCount' => $postsCount,
            'onlyTrashed' => $onlyTrashed,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
            'statusList' => $this->statusList($request),
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
        $oldImage = $post->image;
        $data = $this->handleRequest($request);
        $post->update($data);

        if ($oldImage !== $post->image) $this->removeImage($oldImage);

        return redirect()->route('backend.blog.index')->with([
            'type' => 'success',
            'message' => 'The post has been updated.',
        ]);
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('backend.blog.index')->with('trash-message', [
            'The post has been moved to Trash.',
            $id,
        ]);
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image);

        return redirect()->route('backend.blog.index', ['status' => 'trash'])->with([
            'type' => 'success',
            'message' => 'The post has been deleted.',
        ]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $post->restore();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'The post has been restored from the Trash.',
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

    private function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

    private function statusList($request)
    {
        return [
            'own' => $request->user()->posts()->count(),
            'all' => Post::count(),
            'published' => Post::published()->count(),
            'scheduled' => Post::scheduled()->count(),
            'draft' => Post::draft()->count(),
            'trash' => Post::onlyTrashed()->count(),
        ];
    }
}
