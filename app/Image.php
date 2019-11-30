<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //Establishing relationship with the Details
    public function details(){
        return $this->belongsTo(Detail::class, 'details_id');
    }
}
