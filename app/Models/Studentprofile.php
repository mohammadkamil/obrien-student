<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentprofile extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'studentprofiles';

    protected $fillable = ['name','tel','ic_no','email','gander','funding','student_no','fees','programme_id','academic_term_id','campus_id','passport_no'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function academicterm()
    {
        return $this->hasOne('App\Models\Academicterm', 'id', 'academic_term_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alumnis()
    {
        return $this->hasMany('App\Models\Alumni', 'student_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function campus()
    {
        return $this->hasOne('App\Models\Campus', 'id', 'campus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examresults()
    {
        return $this->hasMany('App\Models\Examresult', 'student_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programme()
    {
        return $this->hasOne('App\Models\Programme', 'id', 'programme_id');
    }

}
