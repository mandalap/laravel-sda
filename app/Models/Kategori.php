<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Kategori extends Model
{
    //
    use SoftDeletes;
    protected $table = 'kategori';
    protected $fillable = [
        'kategori',
        'icon',
        'status',
        'jenis',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->kategori);
        });

        static::updating(function ($kategori) {
            if ($kategori->isDirty('kategori')) { // Hanya update jika kategori berubah
                $kategori->slug = Str::slug($kategori->kategori);
            }
        });
    }
}
