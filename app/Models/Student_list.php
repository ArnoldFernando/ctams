<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_list extends Model
{
    use HasFactory;

    // protected $table = 'Student_list';

    protected $fillable = [
        'student_id', // Add 'student_id' to the fillable array
        'name',
        'course',
        'barcode',
        'image',
    ];
}
