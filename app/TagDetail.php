<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagDetail extends Model
{
    // Relationship with the Tags
    public function tags(){
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
