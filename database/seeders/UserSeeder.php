<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a teacher
        User::create([
            'name' => 'Prof. Rahim Uddin',
            'email' => 'rahim.uddin@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Create a student
        User::create([
            'name' => 'Sonia Begum',
            'email' => 'sonia@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create another student
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}