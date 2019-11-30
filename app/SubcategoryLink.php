<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoryLink extends Model
{
    //
    public function details(){
        return $this->belongsTo(Detail::class, 'details_id');
    }
}
