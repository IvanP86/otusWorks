<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function showMe()
    {
        $user = JWTAuth::user();
        return new UserResource($user);
    }
    public function updateMe(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $user = JWTAuth::user();
        if (isset($data['password']) && $data['password'] != $user->password) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return new UserResource($user);
    }

    public function myOrders(){
        $user = JWTAuth::user();
        return response()->json($user->orders);
    }

    public function deleteMe(){
        $user = JWTAuth::user();
        $user->delete();
    }
}
