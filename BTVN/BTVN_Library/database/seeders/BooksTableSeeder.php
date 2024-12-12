<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $libraryIds = DB::table('libraries')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3),
                'author' => $faker->name(),
                'publication_year' => $faker->numberBetween(1900, 2024),
                'genre' => $faker->word(),
                'library_id' => $faker->randomElement($libraryIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
