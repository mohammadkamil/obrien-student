<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'addresses';

    protected $fillable = ['address1','address2','address3','city','state','country','postcode'];
	
}
