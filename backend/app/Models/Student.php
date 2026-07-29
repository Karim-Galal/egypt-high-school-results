<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'seating_no';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'seating_no',
        'arabic_name',
        'total_degree',
        'student_case_desc',
    ];
}
