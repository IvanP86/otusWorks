<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Element\UpdateApiElementRequest;
use App\Http\Resources\Element\ElementResource;
use App\Models\Element;
use App\Http\Requests\Api\Element\StoreApiElementRequest;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ElementResource::collection(Element::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApiElementRequest $request)
    {
        return new ElementResource(Element::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ElementResource(Element::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApiElementRequest $request, string $id)
    {
        $element = Element::findOrFail($id);
        $element->update($request->validated());
        return new ElementResource($element);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Element::findOrFail($id)->delete();
        return;
    }
}
