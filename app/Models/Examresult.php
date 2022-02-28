<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examresult extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examresults';

    protected $fillable = ['student_id','academic_term_id','subject_id','mark'];
	
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
    public function studentprofile()
    {
        return $this->hasOne('App\Models\Studentprofile', 'id', 'student_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }
    
}
