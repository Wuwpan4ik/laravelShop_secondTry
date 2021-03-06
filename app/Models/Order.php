<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function calculateFullPrice()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->calculatePriceForCount();
        }
        return $sum;
    }

    public function saveOrder($phone, $name)
    {
        if ($this->status == 0) {
            $this->update([
                'status' => 1,
                'name' => $name,
                'phone' => $phone
            ]);
            session()->forget('orderId');
            return True;
        } else {
            return False;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'status',
        'phone',
        'id',
        'user_id'
    ];
}
