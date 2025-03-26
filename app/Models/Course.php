<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'courseID';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [
        'courseID', 
        'lecID', 
        'courseName', 
        'creditHours', 
        'paperType'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'courseID', 'studID');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecID', 'lecID');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'courseID', 'courseID');
    }


}
