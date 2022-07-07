<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'image', 'price', 'description', 'category_id', 'hit', 'recommended', 'new'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function scopeHit($query) {
        return $query->where('hit', 1);
    }

    public function scopeNew($query) {
        return $query->where('new', 1);
    }

    public function scopeRecommended($query) {
        return $query->where('recommended', 1);
    }

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendedAttribute($value)
    {
        $this->attributes['recommended'] = $value === 'on' ? 1 : 0;
    }

    public function isAvailable()
    {
        return $this->count > 0;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isRecommended()
    {
        return $this->recommended === 1;
    }

    public function calculatePriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->price * $this->pivot->count;
        }
        return $this->price;
    }

    public function recalculateCountProducts($count)
    {
        $this->count -= $count;
        $this->save();
    }
}
