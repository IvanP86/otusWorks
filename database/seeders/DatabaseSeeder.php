<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
                \App\Models\Role::insert([
                    ['title' => 'Admin',
                     'created_at'=>date('Y-m-d H:i:s'),
                     'updated_at'=>date('Y-m-d H:i:s')],
                    ['title' => 'Manager',
                     'created_at'=>date('Y-m-d H:i:s'),
                     'updated_at'=>date('Y-m-d H:i:s')],
                    ['title' => 'User',
                     'created_at'=>date('Y-m-d H:i:s'),
                     'updated_at'=>date('Y-m-d H:i:s')]
                ]
                );

                \App\Models\Category::insert([
                ['name' => 'newCategory1',
                 'parent_id' => '1',
                 'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s')],
                ['name' => 'newCategory2',
                 'parent_id' => '1',
                 'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s')],
                ['name' => 'newCategory3',
                 'parent_id' => '2',
                 'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s')],
                ]);
             
        \App\Models\User::factory(10)->create();
        \App\Models\Element::factory(30)->create();
        \App\Models\Order::factory(30)->create();
        \App\Models\ElementOrder::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'email_verified_at' => now(),
            'password' => '12345678',
            'role_id' => 1,

        ]);

        // \App\Models\Category::factory(5)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
