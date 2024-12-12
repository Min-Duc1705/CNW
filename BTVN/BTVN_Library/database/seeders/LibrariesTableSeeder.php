<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('libraries')->insert([
                'name' => $faker->name(),
                'address' => $faker->address(),
                'contact_number' => $faker->randomNumber(9, true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
