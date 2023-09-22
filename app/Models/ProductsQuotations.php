<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsQuotations extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'quotation_id', 'value_total', 'value_unit', 'quantity'];
}
