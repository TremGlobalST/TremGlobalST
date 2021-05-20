<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meet;

use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'theme', 'slug'];



    public function meets()
    {
        return $this->hasMany(Meet::class);
    }
}
