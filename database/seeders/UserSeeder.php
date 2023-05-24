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
            // 'profile_photo' => 'https://images.pexels.com/photos/8993561/pexels-photo-8993561.jpeg?auto=compress&cs=tinysrgb&w=1600',
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
            // 'profile_photo' => 'https://images.pexels.com/photos/5384445/pexels-photo-5384445.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
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
            'first_name' => 'Jui',
            'last_name' => 'Monika',
            'email' => 'jui@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password is '12345678'
            // 'profile_photo' => 'https://img.freepik.com/free-photo/playful-brunette-girl-circlet-flowers-standing-indoor-shot-jocund-woman-with-wavy-hair-posing-cute-dress_197531-20586.jpg?w=1060&t=st=1684916970~exp=1684917570~hmac=a638f24b176c2542024323c1a5bf678109b24efaba7db55a9b633027566e0b3b',
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
            'first_name' => 'Jitu',
            'last_name' => 'Moni',
            'email' => 'jitu@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password is '12345678'
            // 'profile_photo' => 'https://img.freepik.com/free-photo/young-beautiful-woman-pink-warm-sweater-natural-look-smiling-portrait-isolated-long-hair_285396-896.jpg?w=1060&t=st=1684916953~exp=1684917553~hmac=77adf5956a5b59ef31f3e2bae3f2aff34c57e5d253e56ef31e09f80c47e10fcc',
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
            // 'profile_photo' => 'https://img.freepik.com/free-photo/pretty-smiling-joyfully-female-with-fair-hair-dressed-casually-looking-with-satisfaction_176420-15187.jpg?w=1060&t=st=1684916955~exp=1684917555~hmac=16cfb3963373471ea10d6de5c5f7f5582e0b2ace0141a7b2f55a5c19944530dd',
            // 'phone' => '',
            // 'country' => '',
            // 'address_1' => '',
            // 'address_2' => '',
            // 'city' => '',
            // 'state' => '',
            // 'zip' => '',
            'is_admin' => 0,
        ]);

    }
}
