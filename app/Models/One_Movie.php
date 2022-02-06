<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class One_Movie extends Model
{
    use HasFactory;

    protected $with=['main_movie'];

    public function main_movie(){
        return $this->belongsTo(Movie::class);
    }
}
