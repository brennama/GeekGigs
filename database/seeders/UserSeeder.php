<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UserSeeder
 *
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'first_name' => 'brett',
            'last_name' => 'gorden',
            'profile_name' => 'nedrog',
            'email' => 'bgorden@bu.edu',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
