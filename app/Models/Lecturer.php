<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lecturer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'lecturers'; // Specify table name
    protected $primaryKey = 'lecID'; // Set primary key
    public $incrementing = false; // Since 'lecID' is a string (not auto-increment)
    protected $keyType = 'string'; // Define primary key type

    protected $fillable = [
        'lecID',
        'lecEmail',
        'lecName',
        'lecCampus',
        'lecFaculty',
        'lecProgramme',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
    public function courses()
    {
        return $this->hasMany(Course::class, 'lecID', 'lecID');
    }
}
