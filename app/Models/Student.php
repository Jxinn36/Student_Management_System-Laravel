<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'studID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'studID',
        'email',
        'name',
        'campus',
        'faculty',
        'programme',
        'year',
        'sem',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'studID', 'courseID');

    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'studID', 'studID');
    }

}

