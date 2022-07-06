<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'code', 'description', 'image', 'id'];

    public function setRelation($relation, $value)
    {
        $this->relations[$relation] = $value;

        return $this;
    }

//    public function products()
//    {
//        return $this->hasMany(Product::class);
//    }
}
