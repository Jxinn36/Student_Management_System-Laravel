<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
          [
            'studID' => '2209824',
            'email' => 'jx@example.com',
            'name' => 'Lee Jia Xin',
            'faculty' => 'Faculty of Computer Science',
            'programme' => 'Computer Science',
            'year' => 1, 
            'sem' => 1, 
            'group' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'studID' => '3309824',
            'email' => 'janesmith@example.com',
            'name' => 'Jane Smith',
            'faculty' => 'Faculty of Business',
            'programme' => 'Business Administration',
            'year' => 1, 
            'sem' => 1, 
            'group' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'studID' => '4409824',
            'email' => 'alicej@example.com',
            'name' => 'Alice Johnson',
            'faculty' => 'Faculty of Engineering',
            'programme' => 'Mechanical Engineering',
            'year' => 2, 
            'sem' => 1, 
            'group' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'studID' => '2208275',
            'email' => 'kk@example.com',
            'name' => 'King Kim Loong',
            'faculty' => 'Faculty of Computer Science',
            'programme' => 'Information Technology',
            'year' => 2, 
            'sem' => 2, 
            'group' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'studID' => '2208564',
            'email' => 'chris@example.com',
            'name' => 'Chris Tan',
            'faculty' => 'Faculty of Computer Science',
            'programme' => 'Information Security',
            'year' => 2, 
            'sem' => 2, 
            'group' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'studID' => '3305682',
            'email' => 'Mliss@example.com',
            'name' => 'Melissa',
            'faculty' => 'Faculty of Engineering',
            'programme' => 'Mechanical Engineering',
            'year' => 1, 
            'sem' => 3, 
            'group' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
    }
}
