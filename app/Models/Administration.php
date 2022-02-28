<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'administration';

    protected $fillable = ['student_id','vaccine_type','second_dose','address','flight_routing','date_arrival'];
 /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }
}
