<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    use HasFactory;
    protected $table = 'tracerstudystudent';

    protected $fillable = ['alumnis_id','study_status','current_address', 'phone_no', 'employer_info', 'working_info','salary', 'futher_study'
    , 'employer_name', 'employer_address', 'working_status', 'working_jobposition'];
    public function alumni()
    {
        return $this->hasMany('App\Models\Alumni', 'id', 'alumnis_id');
    }
}
