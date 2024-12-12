<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $cinemaIDs = DB::table('cinemas')->pluck('id')->toArray();

        $directorRandom = ['Steven Spielberg', 'Christopher Nolan', 'Quentin Tarantino', 'Martin Scorsese', 'Anthony và Joe Russo'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('movies')->insert([
                'title' => $faker->randomElement(['Avengers: Endgame', 'Titanic', 'The Godfather', 'Joker', 'Spider-Man: No Way Home']),
                'director' => $faker->randomElement($directorRandom),
                'release_date' => $faker->date(),
                'duration' => $faker->numberBetween(60, 120),
                'cinema_id' => $faker->randomElement($cinemaIDs),
            ]);
        }
    }
}
