<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'overview',
        'original_language',
        'release_date',
        'poster_path'
    ];

    public function genres(){
       return $this->belongsToMany(Genre::class);
    }

}
