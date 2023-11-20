<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\CacheUserService;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct(public readonly CacheUserService $cacheUserService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $start = microtime(true);
        $this->authorize('anyManagerAndAdmin', auth()->user());
        if (Cache::store('memcached')->has('userKeys')) {
            $users = $this->cacheUserService->returnCacheUsersArray();
        } else {
            $users = User::all();
            $this->cacheUserService->createCacheUsers($users);
        }
        $time = microtime(true) - $start;
        print_r($time);
        return view('admin.user.index', compact('users'));
    }

    public function indexNoCache()
    {
        $start = microtime(true);
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $users = User::all();
        $time = microtime(true) - $start;
        print_r($time);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        if (Cache::has($id)) {
            $user = Cache::get($id);
        } else {
            $user = User::findOrFail($id);
        }
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $this->authorize('anyManagerAndAdmin', auth()->user());
        $data = $request->validated();
        if ($data['password'] != User::find($id)->password) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('user.index');
    }
}
