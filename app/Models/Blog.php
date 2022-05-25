<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $with = ['categoryName'];
    use HasFactory;

    protected $fillable = ['title','category_id','created_at','sample','body','countUser','pinBlog'];

    public function categoryName()
    {
        return $this->belongsTo(Genre::class,'category_id','id');
    }
}
