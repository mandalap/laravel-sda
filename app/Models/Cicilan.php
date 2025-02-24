<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cicilan extends Model
{
    //
    use SoftDeletes;
    protected $table = "cicilans";

    protected $fillable = [
        'booking_transaction_id',
        'member_id',
        'product_id',
        'jumlah_cicilan',
        'payment_via',
        'status',
        'is_paid',
        'bukti_cicilan'
    ];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function member() : BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
