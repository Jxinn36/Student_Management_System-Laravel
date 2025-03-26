<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course; // Ensure you have a Course model
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            
            [
                'courseID' => 'CS1013', 
                'lecID' => '005698',
                'courseName' => 'Introduction to Programming', 
                'creditHours' => 3, 
                'paperType' => false, // false = Main, true = Elective
            ],
            [
                'courseID' => 'BA1123', 
                'lecID' => '006325',
                'courseName' => 'Intoduction to Business', 
                'creditHours' => 3, 
                'paperType' => false,
            ],
            [
                'courseID' => 'MM1034', 
                'lecID' => '005698',
                'courseName' => 'Probability and Statistics', 
                'creditHours' => 4, 
                'paperType' => true, // Elective course
            ],
            [
                'courseID' => 'MPU1203', 
                'lecID' => '005698',
                'courseName' => 'Pendidikan Moral', 
                'creditHours' => 2, 
                'paperType' => true, // false = Main, true = Elective
            ],
            [
                'courseID' => 'BA2143', 
                'lecID' => '006325',
                'courseName' => 'Business Administration', 
                'creditHours' => 3, 
                'paperType' => false,
            ],
            [
                'courseID' => 'MA1013', 
                'lecID' => '006325',
                'courseName' => 'Introduction to Marketing', 
                'creditHours' => 4, 
                'paperType' => false, // false = Main, true = Elective
            ],
            [
                'courseID' => 'BA6847', 
                'lecID' => '005698',
                'courseName' => 'Programming C', 
                'creditHours' => 4, 
                'paperType' => false,
            ]
        ]);
    }
}
