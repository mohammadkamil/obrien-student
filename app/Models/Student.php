<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'students';

    protected $fillable = ['student_profile_id','programme_id','institution_id','academic_term_id','campus_id','status','year'];

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
        return $this->hasOne('App\Models\Alumni', 'student_id', 'id');
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
    public function institution()
    {
        return $this->hasOne('App\Models\Institution', 'id', 'institution_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programme()
    {
        return $this->hasOne('App\Models\Programme', 'id', 'programme_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentdocs()
    {
        return $this->hasMany('App\Models\Studentdoc', 'student_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentprofile()
    {
        return $this->hasOne('App\Models\Studentprofile', 'id', 'student_profile_id');
    }
    public function parentprofile()
    {
        return $this->hasOne('App\Models\Parentprofile', 'student_id', 'id');
    }
}
