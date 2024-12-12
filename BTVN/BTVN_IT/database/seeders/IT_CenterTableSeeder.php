<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IT_CenterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('it_centers')->insert([
                'name' => $faker->company(),
                'location' => $faker->address(),
                'contact_email' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}
