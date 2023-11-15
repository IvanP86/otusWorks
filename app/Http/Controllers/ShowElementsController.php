<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ShowElementsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $id)
    {
        $element = Element::findOrFail($id);
        return view('show', compact('element'));
    }
}
