<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tickets()
    {
        return $this->hasMany(ticket::class);
    }
}
