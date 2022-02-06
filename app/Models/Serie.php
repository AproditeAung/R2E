<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $with=['quality'];
//
    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public function quality(){
        return $this->hasMany(SerieQuality::class);
    }
}
