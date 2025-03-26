<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        DB::table('course_student')->insert([
            ['courseID' => 'BA6847', 'studID' => 2208275],
            ['courseID' => 'BA6847', 'studID' => 2208564],
            ['courseID' => 'BA6847', 'studID' => 2209824],
            ['courseID' => 'CS1013', 'studID' => 2208275],
            ['courseID' => 'CS1013', 'studID' => 2208564],
            ['courseID' => 'BA1123', 'studID' => 3305682],
            ['courseID' => 'BA1123', 'studID' => 3309824],
            ['courseID' => 'BA6847', 'studID' => 2206894],
            ['courseID' => 'BA6847', 'studID' => 2204512],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
