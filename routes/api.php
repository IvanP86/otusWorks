<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ElementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::prefix('api')->group(function () {

    Route::resource('elements', ElementController::class)->except(['create', 'edit'])->names([
        'index' => 'element.index',
        'show' => 'element.show',
        'destroy' => 'element.delete',
        'store' => 'element.store',
        'update' => 'element.update'
    ]);

// });
