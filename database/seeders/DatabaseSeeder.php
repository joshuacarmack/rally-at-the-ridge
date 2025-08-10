<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Car;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update the admin user (won't duplicate)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // change in prod
                'email_verified_at' => now(),
            ]
        );

        // Ensure there are exactly 10 TEST cars (IDs may vary if you’ve seeded before)
        $have = Car::where('is_test', true)->count();
        $need = max(0, 10 - $have);
        if ($need > 0) {
            Car::factory()->count($need)->state(['is_test' => true])->create();
        }
    }
}
