<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'campuses';

    protected $fillable = ['name','address','link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentprofiles()
    {
        return $this->hasMany('App\Models\Studentprofile', 'campus_id', 'id');
    }

}
