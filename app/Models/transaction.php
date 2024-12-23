<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    public function method()
    {
        return $this->belongsTo(method::class);
    }
}
