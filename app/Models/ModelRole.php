<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRole extends Model
{
    use HasFactory;
    protected $table = 'model_has_roles';

    protected $fillable = ['role_id','model_type','user_id'];
    public function role()
    {
        return $this->hasOne('App\Models\Roles', 'id', 'role_id');
    }
}
