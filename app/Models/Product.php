<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category',
        'image',
        'stock',
        'is_active'
    ];

    /**
     * Get the formatted price with currency.
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        return asset('img/products/' . $this->category . '/' . $this->image);
    }

    /**
     * Scope for active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for category.
     */
    public function scopeByCategory($query, $category)
    {
        if ($category === 'all') {
            return $query;
        }
        return $query->where('category', $category);
    }

    /**
     * Get category label.
     */
    public function getCategoryLabelAttribute()
    {
        return match($this->category) {
            't-shirt' => 'T-Shirt',
            'shirt' => 'Shirt',
            'jacket' => 'Jacket/Sweater',
            default => ucfirst($this->category)
        };
    }
}