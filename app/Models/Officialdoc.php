<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officialdoc extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'officialdocs';

    protected $fillable = ['name','url'];
	
}
