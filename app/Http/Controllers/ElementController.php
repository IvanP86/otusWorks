<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Category;
use App\Http\Requests\Element\StoreRequest;
use App\Http\Requests\Element\UpdateRequest; 

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
    public function store(StoreRequest $request)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $data = $request->validated();
        Element::create($data);
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
    public function update(UpdateRequest $request, string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $data = $request->validated();
        $element = Element::findOrFail($id);
        $element->update($data);
        return view('element.show', compact('element'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        Element::find($id)->delete();
        return redirect()->route('element.index');
    }
}
