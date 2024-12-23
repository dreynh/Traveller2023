<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tags()
    {
        return $this->belongsToMany(tag::class, 'post_tag', 'post_id', 'tag_id');
    }
}
