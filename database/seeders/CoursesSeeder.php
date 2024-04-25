<?php

namespace Database\Seeders;

use App\Models\CourseModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            CourseModel::create([
                'course_name' => $faker->name,
                'course_des' => $faker->sentence,
                'course_fee' => $faker->randomNumber(4),
                'course_totalenroll' => $faker->randomNumber(3),
                'course_totalclass' => $faker->randomNumber(2),
                'course_link' => $faker->url,
                'course_img' => $faker->imageUrl(),
            ]);
        }
    }
}
