<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LaptopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $renterID = DB::table('renters')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('laptops')->insert([
                'brand' => $faker->company(),
                'model' => $faker->word() . ' ' . $faker->word(),
                'specifications' => $faker->sentence(),
                'rental_status' => $faker->boolean(),
                'renter_id' => $faker->randomElement($renterID),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
