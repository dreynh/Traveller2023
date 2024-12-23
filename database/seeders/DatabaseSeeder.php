<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(1)->create();

        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'cstraveller24@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admintraveller12345'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);
    }
}
