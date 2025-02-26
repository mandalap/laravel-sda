<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Jenis extends Model
{
    use SoftDeletes;
    //
    protected $table = "jenis";

    protected $fillable = [
        'jenis',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($jenis) {
            $jenis->slug = Str::slug($jenis->jenis);
        });

        static::updating(function ($jenis) {
            if ($jenis->isDirty('jenis')) {
                $jenis->slug = Str::slug($jenis->jenis);
            }
        });
    }

}
