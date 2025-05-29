<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelCart\Cartable;

class Product extends Model implements Cartable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
    ];

    /**
     * Get the price of the item.
     * The documentation example shows `getPrice(): int`.
     * If your price is stored as a decimal (e.g., 49.99), you might need to return it as cents (e.g., 4999).
     * For now, returning the decimal value directly. Adjust if cart calculation issues arise.
     */
    public function getPrice(): float
    {
        return (float) $this->price;
    }

    // If the package requires other methods from Cartable, they would be added here.
    // For example, sometimes a getName() or getId() might be part of such an interface implicitly or explicitly.
}
