<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Admin User
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Main',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password is '12345678'
            // 'profile_photo' => '',
            // 'phone' => '',
            // 'country' => '',
            // 'address_1' => '',
            // 'address_2' => '',
            // 'city' => '',
            // 'state' => '',
            // 'zip' => '',
            'is_admin' => 1,
        ]);

        // Default User
        User::create([
            'first_name' => 'User',
            'last_name' => 'Default',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password is '12345678'
            // 'profile_photo' => '',
            // 'phone' => '',
            // 'country' => '',
            // 'address_1' => '',
            // 'address_2' => '',
            // 'city' => '',
            // 'state' => '',
            // 'zip' => '',
            'is_admin' => 0,
        ]);

        // Test Purpose User | Will remove later
        User::create([
            'first_name' => 'Suraiya Aysha',
            'last_name' => 'Asa',
            'email' => 'asa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password is '12345678'
            // 'profile_photo' => null,
            // 'phone' => '',
            // 'country' => '',
            // 'address_1' => '',
            // 'address_2' => '',
            // 'city' => '',
            // 'state' => '',
            // 'zip' => '',
            'is_admin' => 0,
        ]);

        // Test Purpose User | Will remove later
        // User::create([
        //     'first_name' => 'Jui',
        //     'last_name' => 'Monika',
        //     'email' => 'jui@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'), // password is '12345678'
        //     // 'profile_photo' => null,
        //     // 'country' => '',
        //     // 'address_1' => '',
        //     // 'address_2' => '',
        //     // 'city' => '',
        //     // 'state' => '',
        //     // 'zip' => '',
        //     'is_admin' => 0,
        // ]);

        // Test Purpose User | Will remove later
        // User::create([
        //     'first_name' => 'Jitu',
        //     'last_name' => 'Moni',
        //     'email' => 'jitu@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'), // password is '12345678'
        //     // 'profile_photo' => null,
        //     // 'phone' => '',
        //     // 'country' => '',
        //     // 'address_1' => '',
        //     // 'address_2' => '',
        //     // 'city' => '',
        //     // 'state' => '',
        //     // 'zip' => '',
        //     'is_admin' => 0,
        // ]);

        // Create 10 Blog Post
        // User::factory()->count(5)->create();

    }
}
