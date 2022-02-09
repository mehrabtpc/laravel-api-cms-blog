<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Http\Requests\Category\StoreCategoryRequest;
use Modules\Blog\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Category::query()->get();

        return response()->success('', compact('category'));

    }

    public function store(StoreCategoryRequest $request)
    {
        $category=Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->success('', compact('category'));

    }

    public function show(Category $category)
    {
        return response()->success('', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name'=> $request->name,
            'description' => $request->description,
        ]);

        return response()->success('', compact('category'));

    }

    public function destroy(Category $category)
    {
        $category->destroy;
        return response()->success('', compact('category'));

    }
}
