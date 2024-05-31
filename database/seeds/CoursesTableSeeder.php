<?php

use App\Course;
use App\Discipline;
use App\Institution;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('Ru_RU');
        $courses = [
            [
                'name' => 'Веб-разработка',
                'description' => "Описание курса",
                'institution_id' => 1,
                'material' => "material",
                'homework' => "homework",
                'status' => "Не запущен",
            ],
            [
                'name' => 'Разработка UX/UI дизайна',
                'description' => "Описание курса",
                'institution_id' => 2,
                'material' => "material",
                'homework' => "homework",
                'status' => "Не запущен",
            ],
            [
                'name' => 'Разработка ПО',
                'description' => "Описание курса",
                'institution_id' => 3,
                'material' => "material",
                'homework' => "homework",
                'status' => "Не запущен",
            ],
        ];

        foreach ($courses as $id => $courses) {
            $id++;
            $course = Course::create($courses);
            $course->addMedia(public_path("img/course/course_$id.png"))->preservingOriginal()->toMediaCollection('photo');
            $course->disciplines()->sync([$id]);
        }
    }
}
