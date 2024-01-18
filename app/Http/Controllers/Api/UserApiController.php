<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\ApiUserService;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserApiController extends Controller
{
    public function __construct(public readonly ApiUserService $apiUserService)
    {
    }
    public function showMe()
    {
        $user = JWTAuth::user();
        return new UserResource($user);
    }
    public function updateMe(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $user = JWTAuth::user();
        return new UserResource($this->apiUserService->updateApiUser($data, $user));
    }

    public function myOrders()
    {
        $user = JWTAuth::user();
        return response()->json($user->orders);
    }

    public function deleteMe()
    {
        $user = JWTAuth::user();
        $user->delete();
    }
}
