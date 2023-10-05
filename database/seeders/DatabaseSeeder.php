<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([PermissionSeeder::class]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $admin->assignRole('admin');

        for ($i = 1; $i <= 8; $i++) {
            $technician = User::create([
                'name' => "Technician $i",
                'email' => "technician$i@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            ]);
            $technician->assignRole('technician');
        }
    }
}
