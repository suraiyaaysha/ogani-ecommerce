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
        // User::create([
        //     [
        //         'name' => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12345678'), //password is '12345678'
        //         'is_admin' => 1,
        //         // 'profile_photo' => 'admin/assets/img/user2-160x160.jpg',
        //     ],
        //     [
        //         'name' => 'User',
        //         'email' => 'user@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12345678'), //password is '12345678'
        //         'is_admin' => 0,
        //         // 'profile_photo' => 'admin/assets/img/user2-160x160.jpg',
        //     ]
        // ]);

        //Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), //password is '12345678'
            'is_admin' => 1,
            // 'profile_photo' => 'admin/assets/img/user2-160x160.jpg',
        ]);

        // Default User
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), //password is '12345678'
            'is_admin' => 0,
            // 'profile_photo' => 'admin/assets/img/user2-160x160.jpg',
        ]);

        // Test Purpose User | Will remove later
        User::create([
            'name' => 'Jui Monika',
            'email' => 'jui@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), //password is '12345678'
            'is_admin' => 0,
            // 'profile_photo' => 'admin/assets/img/user3-160x160.jpg',
        ]);

        // Test Purpose User | Will remove later
        User::create([
            'name' => 'Jitu Moni',
            'email' => 'jitu@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), //password is '12345678'
            'is_admin' => 0,
            // 'profile_photo' => 'admin/assets/img/user4-160x160.jpg',
        ]);

        // Test Purpose User | Will remove later
        User::create([
            'name' => 'Suraiya Aysha Asa',
            'email' => 'asa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), //password is '12345678'
            'is_admin' => 0,
            // 'profile_photo' => 'admin/assets/img/user5-160x160.jpg',
        ]);

    }
}
