<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exam'; 

    protected $fillable = [
        'studID',
        'courseID',
        'marks',
        'grade',
        'avgStud',
        'avgSub',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studID', 'studID');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'courseID', 'courseID');
    }
}
