<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CinemaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('cinemas')->insert([
                'name' => $faker->company(),
                'location' => $faker->address(),
                'total_seats' => $faker->numberBetween(50, 400),
            ]);
        }
    }
}
