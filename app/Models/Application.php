<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'applications';

    protected $fillable = ['name',
    'tel',
    'ic_no',
    'email',
    'gander',
    'current_status',
    'current_institution',
    'get_know_obrien',
    'funding',
    'notes',
    'programme_id',
    'academic_term_id',
    'status','year',
    'parent_name',
    'parent_tel',
    'considering_intake',
    'program',];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function academicterm()
    {
        return $this->hasOne('App\Models\Academicterm', 'id', 'academic_term_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programme()
    {
        return $this->hasOne('App\Models\Programme', 'id', 'programme_id');
    }

}
