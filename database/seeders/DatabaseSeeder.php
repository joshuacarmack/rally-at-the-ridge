<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (change in prod)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // 10 demo TEST cars (IDs 1..10) for training
        Car::factory()->count(10)->state(['is_test' => true])->create();
    }
}
