<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table("medicine")->insert([
                "name" => $faker->word, // Tạo tên thuốc ngẫu nhiên (ví dụ: "Paracetamol")
                "brand" => $faker->company, // Tạo tên thương hiệu ngẫu nhiên (ví dụ: "Roche")
                "dosage" => $faker->randomElement(['10mg tablets', '20ml syrup', '500mg capsules']), // Chọn liều lượng ngẫu nhiên từ danh sách
                "form" => $faker->randomElement(['tablet', 'syrup', 'capsule', 'injection']), // Chọn dạng bào chế ngẫu nhiên từ danh sách
                "price" => $faker->randomFloat(2, 10, 500), // Tạo giá ngẫu nhiên từ 10 đến 500
                "stock" => $faker->randomNumber(3), // Tạo số lượng tồn kho ngẫu nhiên (tối đa 3 chữ số) 
            ]);
      }
    }
}
