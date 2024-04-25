<?php

namespace Database\Seeders;

use App\Models\ServicesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            ServicesModel::create([
                'services_name' => $faker->name,
                'services_des' => $faker->sentence,
                'services_img' => $faker->imageUrl(),
            ]);
        }
    }
}
