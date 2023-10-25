<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ElementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/static', function () {
    return view('static');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/role/{role}', function (\App\Models\Role $role) {
    $users = $role->users;
    dump($users);
    return "ok";
});

Route::get('/users/{user}', function (\App\Models\User $user) {
    $orders = $user->orders;
    dump($orders);
    return "ok";
});

Route::get('/orders/{order}', function (\App\Models\Order $order) {
    $elements = $order->elements;
    dump($elements);
    return "ok";
});

Route::get('/elements/{element}', function (\App\Models\Element $element) {
    $orders = $element->orders;
    dump($orders);
    return "ok";
});

Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class)->names([
    'index' => 'category.index',
    'create' => 'category.create',
    'show' => 'category.show',
    'edit' => 'category.edit',
    'destroy' => 'category.delete',
    'store' => 'category.store',
    'update' => 'category.update'
    ]);
    Route::resource('elements', ElementController::class)->names([
        'index' => 'element.index',
        'create' => 'element.create',
        'show' => 'element.show',
        'edit' => 'element.edit',
        'destroy' => 'element.delete',
        'store' => 'element.store',
        'update' => 'element.update'
        ]);
});
