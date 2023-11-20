<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Category;
use App\Http\Requests\Element\StoreElementRequest;
use App\Http\Requests\Element\UpdateElementRequest; 

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $elements = Element::all();
        return view('element.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $categories = Category::all();
        return view('element.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreElementRequest $request)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        Element::create($request->validated());
        return redirect()->route('element.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $element = Element::findOrFail($id);
        return view('element.show', compact('element'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $element = Element::findOrFail($id);
        $categories = Category::all();
        return view('element.edit', compact('categories', 'element'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateElementRequest $request, string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $element = Element::findOrFail($id);
        $element->update($request->validated());
        return view('element.show', compact('element'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        Element::findOrFail($id)->delete();
        return redirect()->route('element.index');
    }
}
