<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Relationship with the details
    public function details(){
        return $this->belongsTo(Detail::class, 'details_id');
    }

    // Relationship with the Tag Details
    public function tagdetails(){
        return $this->hasMany(TagDetail::class, 'tag_name');
    }
}
