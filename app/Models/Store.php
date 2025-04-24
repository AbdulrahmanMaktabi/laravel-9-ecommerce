<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = "stores";

    protected $guareded = ['id', 'created_at', 'updated_at'];

    /**
     * Relation with users table
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
