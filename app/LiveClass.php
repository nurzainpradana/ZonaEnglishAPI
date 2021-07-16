<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{

    protected $fillable = [
        'code', 'tutor_code', 'title', 'date', 'time', 'link_zoom'
    ];

    public function tutor() {
        return $this->belongsTo('App\Tutor');
    }
}
