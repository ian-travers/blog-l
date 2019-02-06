<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\CategoryDestroyRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Post;
use Illuminate\Http\Request;

class CategoriesController extends CoreController
{
    public function __construct()
    {
        parent::__construct();
        $this->activeMenuItem = 'Categories';
    }

    public function index()
    {
        $categories = Category::with('posts')->orderBy('title')->paginate($this->perPage);
        $categoriesCount = Category::count();

        $this->activeMenuSubItem = 'All Categories';

        return view('backend.categories.index', [
            'categories' => $categories,
            'categoriesCount' => $categoriesCount,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem
        ]);
    }

    public function create()
    {
        $this->activeMenuSubItem = 'Add Category';

        $category = new Category();

        return view('backend.categories.create', [
            'category' => $category,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('backend.categories.index')->with([
            'type' => 'success',
            'message' => 'The category has been created.',
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->activeMenuSubItem = 'Edit Category';

        $category = Category::findOrFail($id);

        return view('backend.categories.edit', [
            'category' => $category,
            'activeMenuItem' => $this->activeMenuItem,
            'activeMenuSubItem' => $this->activeMenuSubItem,
        ]);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        Category::findOrFail($id)->update($request->all());

        return redirect()->route('backend.categories.index')->with([
            'type' => 'success',
            'message' => 'The category has been updated.',
        ]);
    }

    public function destroy(CategoryDestroyRequest $request, $id)
    {
        Post::withTrashed()->where('category_id', $id)->update(['category_id' => config('cms.default_category_id')]);
        $category =  Category::findOrFail($id);
        $category->delete();

        return redirect()->route('backend.categories.index')->with([
            'type' => 'success',
            'message' => 'The category has been deleted.',
        ]);
    }
}
