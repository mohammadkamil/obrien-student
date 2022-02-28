<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'prospects';

    protected $fillable = ['name','tel','parent_name','parent_tel','program','considering Intake','currentstatus','source','notes','status','year','considering_intake','program'];

}
