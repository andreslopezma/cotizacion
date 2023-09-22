<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quotation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['date_quotation', 'user_id'];

    /**
     * Get the user for the quotation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Products
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_quotations')->withPivot('value_total');
    }
}
