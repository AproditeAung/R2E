<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $with = ['genres','one_movie','series','user'];

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function one_movie(){
        return $this->hasMany(One_Movie::class);
    }

    public function series(){
        return $this->hasMany(Serie::class);
    }
}
