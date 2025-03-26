<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LecturersSeeder extends Seeder {
    public function run() {
        DB::table('lecturers')->insert([
            [
                'lecID' => '005698',
                'lecName' => 'Dr. Lim Ling Lin',
                'lecEmail' => 'lim@example.com',
                'lecCampus' => 'Kuala Lumpur Campus',
                'lecFaculty' => 'Faculty of Computer Science',
                'password' => Hash::make('password123')
            ],
            [
                'lecID' => '006325',
                'lecName' => 'Prof. Tan Mei Mei',
                'lecEmail' => 'tan@example.com',
                'lecCampus' => 'Malacca Campus',
                'lecFaculty' => 'Faculty of Business',
                'password' => Hash::make('password123')
            ],
        ]);
    }
}
