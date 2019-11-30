<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLink extends Model
{
    //
    public function details(){
        return $this->belongsTo(Detail::class, 'details_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
