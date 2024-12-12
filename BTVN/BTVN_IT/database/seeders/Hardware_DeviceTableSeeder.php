<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Hardware_DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $it_centerIDs = DB::table('it_centers')->pluck('id')->toArray();

        $deviceTypes = ['Mouse', 'Keyboard', 'Headset', 'Monitor', 'Printer'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('hardware_devices')->insert([
                'device_name' => $faker->word() . ' ' . $faker->randomElement(['Pro', 'Ultra', 'Max']),
                'type' => $faker->randomElement($deviceTypes),
                'status' => $faker->boolean(),
                'center_id' => $faker->randomElement($it_centerIDs),
            ]);
        }
    }
}
