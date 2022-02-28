<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentdoc extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'studentdocs';

    protected $fillable = ['student_id','type_doc','url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function academicterm()
    {
        return $this->hasOne('App\Models\Studentprofile', 'id', 'student_id');
    }

}
