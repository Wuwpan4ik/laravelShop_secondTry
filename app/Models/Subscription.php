<?php

namespace App\Models;

use App\Mail\SendSubscriptionMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = ['email', 'product_id'];

    public function scopeActiveByProductId($query, $product_id) {
        return $query->where('status', 0)->where('product_id', $product_id);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function sendEmailBySubscription(Product $product)
    {
        $subscriptions = self::activeByProductId($product->id)->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMail($product));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
