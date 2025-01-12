<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class IndexElementsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $elements = Element::all();
        return view('index', compact('elements'));
    }
}
