<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'code', 'name', 'title', 'country', 'experience', 'experience_detail',
        'rating', 'price', 'discount' , 'photo', 'education', 'interest', 'spoken', 'video'
    ];
}
