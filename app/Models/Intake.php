<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'intakes';

    protected $fillable = ['student_id','programme_id','academic_term_id','status'];
	
}
