<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table("computers")->insert([
                "computer_name" => $faker->word, // Tạo tên thuốc ngẫu nhiên (ví dụ: "Paracetamol")
                "model" => $faker->word, // Tạo tên thương hiệu ngẫu nhiên (ví dụ: "Roche")
                "operating_system" => $faker->word, // Chọn liều lượng ngẫu nhiên từ danh sách
                "processsor" => $faker->word, // Chọn dạng bào chế ngẫu nhiên từ danh sách
                "memory" => $faker->randomElement([4, 8, 16, 32]), // Tạo giá ngẫu nhiên từ 10 đến 500
                "available" => $faker->boolean, // Tạo số lượng tồn kho ngẫu nhiên (tối đa 3 chữ số) 
            ]);
      }
    }
}
