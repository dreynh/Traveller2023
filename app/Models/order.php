<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function ticket()
    {
        return $this->belongsTo(ticket::class);
    }

    public function payment()
    {
        return $this->hasOne(payment::class);
    }

    public function transaction()
    {
        return $this->hasOne(transaction::class);
    }

    public function total()
    {
        return $this->hasOne(total::class);
    }

    public function passengers()
    {
        return $this->hasMany(passenger::class);
    }

    public function complaints()
    {
        return $this->hasMany(complaint::class);
    }
}
