<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Order;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

if (!class_exists('Memcached')) {
    include("memcached.php");
}

class UserTest extends TestCase
{
    public function test_get_user_informations(): void
    {
        $user = User::where('email', 'admin@admin')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', env('APP_URL_TEST ') . '/api/me', []);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ]
        ]);

        $this->assertEquals($response->json('data')['id'], $user->id);
    }

    public function test_get_user_without_login_informations(): void
    {
        $user = User::where('email', 'admin@admin')->first();
        $response = $this->actingAs($user)->json('GET', env('APP_URL_TEST ') . '/api/me', []);
        $response->assertStatus(401);
    }

    public function test_user_update(): void
    {
        $user = User::where('email', 'admin@admin')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('PUT', env('APP_URL_TEST ') . '/api/updateMe', [
            'name' => 'adminTEST',
            'password' => '12345678'
        ]);

        $response->assertStatus(200);
        $newOldUser = User::where('email', 'admin@admin')->first();
        $this->assertEquals($response->json('data')['name'], $newOldUser->name);
    }

    public function test_user_orders(): void
    {
        $user = User::create([
            'name' => 'TestApiUser',
            'email' => 'test@test',
            'email_verified_at' => now(),
            'password' => '12345678',
            'role_id' => 1,

        ]);
        $token = JWTAuth::fromUser($user);
        $order = Order::create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', env('APP_URL_TEST ') . '/api/myOrders', []);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                "id",
                "user_id",
                "deleted_at",
                "created_at",
                "updated_at",
            ]
        ]);
    }

    public function test_user_delete(): void
    {
        $user = User::where('email', 'test@test')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('DELETE', env('APP_URL_TEST ') . '/api/deleteMe', []);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
