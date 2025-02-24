<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Product extends Model
{
    //
    use SoftDeletes;
    protected $table = "products";
    protected $fillable = [
        'project_id',
        'code_product',
        'nama_product',
        'panjang',
        'lebar',
        'luas',
        'harga',
        'discount',
        'pembayaran',
        'fee',
        'status',
        'jenis',
        'slug',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->code_product);
        });

        static::updating(function ($product) {
            if ($product->isDirty('code_product')) { // Hanya update jika kategori berubah
                $product->slug = Str::slug($product->code_product);
            }
        });
    }
}
