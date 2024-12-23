<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orders()
    {
        return $this->hasMany(order::class);
    }

    public function travel()
    {
        return $this->belongsTo(travel::class);
    }

    public function type()
    {
        return $this->belongsTo(type::class);
    }

    public function track()
    {
        return $this->belongsTo(track::class);
    }

    public function price()
    {
        return $this->hasOne(price::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['travel_id'] ?? false, function ($query, $travel_id) {
            return $query->where('travel_id', '=', $travel_id);
        });
    }
}
