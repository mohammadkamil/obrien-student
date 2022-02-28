<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'subjects';

    protected $fillable = ['name','code','programme_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examresults()
    {
        return $this->hasOne('App\Models\Examresult', 'subject_id', 'id');
    }
    public function survey()
    {
        return $this->hasOne('App\Models\Surveyansweredstudent', 'subject_id', 'id')->where('alumnis_id','=',auth()->user()->alumnis_id);
    } public function surveybystudent()
    {
        return $this->hasMany('App\Models\Surveyansweredstudent', 'alumnis_id', auth()->user()->alumnis_id);
    }
    public function lecturer()
    {
        return $this->hasOne('App\Models\Lecturer', 'subject_id', 'id');
    }
}
