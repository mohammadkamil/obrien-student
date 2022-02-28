<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentprofile extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'parentprofile';

    protected $fillable = ['student_id','name','contact_no','address','email'];

}
