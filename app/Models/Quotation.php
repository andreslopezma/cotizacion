<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quotation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['date_quotation', 'user_id', 'value_total', 'value_unit', 'quantity'];

    /**
     * Get the user for the quotation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
