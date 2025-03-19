<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Constant;
use App\Models\Tps;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\VolunteerFamily;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    function randomCoordinatesBalikpapan()
    {
        // Define a list of specific latitude and longitude ranges that are only on land
        $landCoordinates = [
            ['latMin' => -1.25, 'latMax' => -1.20, 'lonMin' => 116.85, 'lonMax' => 117.00],
        ];

        // Randomly select one of the land ranges
        $selectedRange = $landCoordinates[array_rand($landCoordinates)];

        // Generate random latitude and longitude within the selected range
        $latitude = $selectedRange['latMin'] + mt_rand() / mt_getrandmax() * ($selectedRange['latMax'] - $selectedRange['latMin']);
        $longitude = $selectedRange['lonMin'] + mt_rand() / mt_getrandmax() * ($selectedRange['lonMax'] - $selectedRange['lonMin']);

        return [$latitude, $longitude];
    }

    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'relawan']);
        Role::create(['name' => 'surveyor']);

        User::create([
            'name' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('admin');

        User::create([
            'name' => "Agen 1",
            'email' => "agen1@gmail.com",
            'password' => bcrypt("00497318"),
        ])->assignRole('relawan');
        User::create([
            'name' => "Agen 2",
            'email' => "agen2@gmail.com",
            'password' => bcrypt("55006575"),
        ])->assignRole('relawan');
        User::create([
            'name' => "Agen 3",
            'email' => "agen3@gmail.com",
            'password' => bcrypt("69820485"),
        ])->assignRole('relawan');
        User::create([
            'name' => "Agen 4",
            'email' => "agen4@gmail.com",
            'password' => bcrypt("09047476"),
        ])->assignRole('relawan');
        User::create([
            'name' => "Agen 5",
            'email' => "agen5@gmail.com",
            'password' => bcrypt("26763242"),
        ])->assignRole('relawan');
        User::create([
            'name' => "Agen 6",
            'email' => "agen6@gmail.com",
            'password' => bcrypt("09144167"),
        ])->assignRole('relawan');
        User::create([
            'name' => "Agen 7",
            'email' => "agen7@gmail.com",
            'password' => bcrypt("36069799"),
        ])->assignRole('relawan');

        // for ($i = 1; $i <= 30; $i++) {
        //     // Generate random coordinates
        //     list($latitude, $longitude) = $this->randomCoordinatesBalikpapan();

        //     // Choose a random status
        //     $status = array_rand(
        //         Constant::VOLUNTEERS_STATUS
        //     );

        //     // Create a volunteer
        //     $volunteer = Volunteer::create([
        //         'user_id' => 1,
        //         'phone_number' => '081234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
        //         'rt' => str_pad($i, 3, '0', STR_PAD_LEFT),
        //         'house_number' => str_pad($i, 3, '0', STR_PAD_LEFT),
        //         'photo' => 'photo' . $i . '.jpg',
        //         'latitude' => $latitude,
        //         'longitude' => $longitude,
        //         'kelurahan' => 'Kelurahan ' . $i,
        //         'answer1' => 'answer1_' . $i,
        //         'answer2' => 'answer2_' . $i,
        //         'answer3' => 'answer3_' . $i,
        //         'answer4' => 'answer4_' . $i,
        //         'status' => Constant::VOLUNTEERS_STATUS[$status],
        //     ]);

        //     // Create associated family members
        //     VolunteerFamily::create([
        //         'volunteer_id' => $volunteer->id,
        //         'name' => 'Family ' . $i . ' Member 1',
        //         'age' => rand(20, 60),
        //         'position' => 'Kepala Keluarga',
        //     ]);

        //     VolunteerFamily::create([
        //         'volunteer_id' => $volunteer->id,
        //         'name' => 'Family ' . $i . ' Member 2',
        //         'age' => rand(18, 60),
        //         'position' => 'Istri',
        //     ]);
        // }
    }
}
