<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Relationship with the category links
    public function categorylinks(){
        return $this->hasMany(CategoryLink::class, 'category_id');
    }

    //Relationship with the sub categories
    public function subcategories(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    public function fontpagecategories(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
