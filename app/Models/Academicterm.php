<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academicterm extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'academicterms';

    protected $fillable = ['name','start_date','end_date','status'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany('App\Models\Application', 'academic_term_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examresults()
    {
        return $this->hasMany('App\Models\Examresult', 'academic_term_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentdocs()
    {
        return $this->hasMany('App\Models\Studentdoc', 'student_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentprofiles()
    {
        return $this->hasMany('App\Models\Studentprofile', 'academic_term_id', 'id');
    }
    
}
