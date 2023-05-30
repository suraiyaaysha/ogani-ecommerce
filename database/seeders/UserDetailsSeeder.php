<?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// use App\Models\UserDetails;
// use App\Models\User;

// class UserDetailsSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run()
//     {
//         // Retrieve users
//         $users = User::all();

//         // Create user details for each user
//         foreach ($users as $user) {
//             UserDetails::create([
//                 'user_id' => $user->id,
//                 'profile_photo' => 'admin/images/face1.jpg',
//                 'phone' => '123456789',
//                 'country' => 'Country',
//                 'address_1' => 'Address 1',
//                 'address_2' => 'Address 2',
//                 'city' => 'City',
//                 'state' => 'State',
//                 'zip' => '12345',
//             ]);
//         }
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;
use App\Models\UserDetails;

class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $faker = Faker::create();

        // Create user details for Admin
        UserDetails::create([
            'user_id' => 1,
            'profile_photo' => 'admin/images/face1.jpg',
            'phone' => '123456789',
            'country' => 'Bangladesh',
            'address_1' => 'Doulatpur',
            'address_2' => 'Khalishpur 2',
            'city' => 'Khulna',
            'state' => 'State',
            'zip' => '12345',
        ]);

        // Create user details for Default User
        UserDetails::create([
            'user_id' => 2,
            'profile_photo' => 'admin/images/face2.jpg',
            'phone' => '123456789',
            'country' => 'Canada',
            'address_1' => 'Gulshan 1',
            'address_2' => 'Banani 2',
            'city' => 'Dhaka',
            'state' => 'State',
            'zip' => '12345',
        ]);

        // Create user details for Default User
        UserDetails::create([
            'user_id' => 3,
            'profile_photo' => 'admin/images/face3.jpg',
            'phone' => '123456789',
            'country' => 'Australia',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'city' => 'City',
            'state' => 'State',
            'zip' => '12345',
        ]);

        // Generate additional random user details
        // for ($i = 0; $i < 5; $i++) {
        //     UserDetails::create([
        //         'user_id' => $i + 3, // Assuming user IDs 3 onwards
        //         'profile_photo' => $faker->image('public/storage/profiles', 200, 200, null, false),
        //         'phone' => $faker->phoneNumber,
        //         'country' => $faker->country,
        //         'address_1' => $faker->streetAddress,
        //         'address_2' => $faker->secondaryAddress,
        //         'city' => $faker->city,
        //         'state' => $faker->state,
        //         'zip' => $faker->postcode,
        //     ]);
        // }
    }
}
