<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Kelompok extends Model
{
    use SoftDeletes;
    //
    protected $table = "kelompok";

    protected $fillable = [
        'kelompok',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($kelompok) {
            $kelompok->slug = Str::slug($kelompok->kelompok);
        });

        static::updating(function ($kelompok) {
            if ($kelompok->isDirty('kelompok')) {
                $kelompok->slug = Str::slug($kelompok->kelompok);
            }
        });
    }
}
