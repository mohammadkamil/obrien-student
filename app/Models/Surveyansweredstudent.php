<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveyansweredstudent extends Model
{
    use HasFactory;

    protected $table = 'surveyanswered';

    protected $fillable = ['alumnis_id','subject_id','answer', 'a1', 'a2', 'a3','a4', 'b1', 'b2', 'b3','c1', 'c2', 'c3', 'c4','d1', 'd2', 'd3', 'e1','e2', 'e3'];
    public function subject()
    {
        return $this->hasMany('App\Models\Subject', 'id', 'subject_id');
    }public function programme()
    {
        return $this->hasOne('App\Models\Programme', 'id', 'programme_id');
    }
}
