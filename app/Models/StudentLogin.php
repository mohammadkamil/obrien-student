<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLogin extends Model
{
    use HasFactory;
    protected $table = 'studentlogin';


    protected $fillable = ['alumnis_id','email','password'];
}
