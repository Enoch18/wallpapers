<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    //Relationship with the images
    public function wallpapers(){
        return $this->hasMany(Wallpaper::class, 'details_id');
    }

    // Relationship with the categories
    public function categorylinks(){
        return $this->hasMany(CategoryLink::class, 'details_id');
    }

    // Relationship with the sub categories
    public function subcategorylinks(){
        return $this->hasMany(SubcategoryLink::class, 'details_id');
    }

    // Relationship with the Tags
    public function tags(){
        return $this->hasMany(Tag::class, 'details_id');
    }
}
