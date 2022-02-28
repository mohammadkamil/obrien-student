<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'lecturers';

    protected $fillable = ['institution_id','programme_id','subject_id','name','email','password','status'];

}
