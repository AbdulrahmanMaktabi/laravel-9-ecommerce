<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAbility extends Model
{
    use HasFactory;

    protected $guarded = ['creatd_at', 'updated_at', 'id'];

    public $timestamps = false;
}
