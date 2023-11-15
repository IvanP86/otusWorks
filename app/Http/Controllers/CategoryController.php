<?php

namespace App\Http\Controllers;

use App\Traits\CacheCategories;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use CacheCategories;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $categories = $this->createAndReturnCacheCategories(Category::all());
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $data = $request->validated();
        Category::create($data);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $categories = Category::all();
        $category = $categories->where('id', $id)->first();
        return view('category.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $data = $request->validated();
        $category = Category::findOrFail($id);
        $category->update($data);
        return view('category.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        Category::findOrFail($id)->delete();
        return redirect()->route('category.index');
    }
}
