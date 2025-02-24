<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Lokasi extends Model
{
    //
    use SoftDeletes;
    protected $table = 'lokasi';
    protected $fillable = [
        'province_id',
        'regency_id',
        'thumbnail',
        'slug',
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($lokasi) {
    //         $lokasi->slug = Str::slug($lokasi->nama_lokasi);
    //     });

    //     static::updating(function ($lokasi) {
    //         if ($lokasi->isDirty('nama_lokasi')) { // Hanya update jika kategori berubah
    //             $lokasi->slug = Str::slug($lokasi->nama_lokasi);
    //         }
    //     });
    // }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id'); // Menyebutkan relasi ke model Regency
    }
}
