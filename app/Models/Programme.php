<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'programmes';

    protected $fillable = ['name','code','total_credit','total_semester','mara_status','institution_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany('App\Models\Application', 'programme_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentprofiles()
    {
        return $this->hasMany('App\Models\Studentprofile', 'programme_id', 'id');
    }

}
