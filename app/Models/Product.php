<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['active', 'product_code', 'product_image', 'product_name', 'product_price'];

    /**
     * Get the Quotations
     */
    public function quotations(): BelongsToMany
    {
        return $this->belongsToMany(Quotation::class, 'products_quotations')->withPivot('value_total');
    }
}
