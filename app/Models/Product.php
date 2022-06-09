<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'price',
        'stock',
        'offer_price',
        'discount',
        'photo',
        'size',
        'conditions',
        'status',
        'brand_id',
        'vendor_id',
        'cat_id',
        'child_cat_id',
    ];

    /**
     * Get the brand that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function related_products()
    {
        return $this->hasMany(Product::class,'cat_id','cat_id')->where('status', 'active')->limit(10);
    }
}
