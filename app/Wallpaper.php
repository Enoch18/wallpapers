<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    //
    public function details(){
        return $this->belongsTo(Detail::class, 'details_id');
    }
}
