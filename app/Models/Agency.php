<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Agency extends Model
{
    use SoftDeletes;
    protected $table = "agency";

    protected $fillable = [
        'member_id',
        'sapaan',
        'nama',
        'telepon',
        'email',
        'gender',
        'tanggal_lahir',
        'negara',
        'kota_id',
        'kode_pos',
        'alamat',
        'photo',
        'status',
        'agency_code',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        $slug = Str::slug($value);
        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = $slug;
    }

    protected static function booted()
    {
        static::creating(function ($agency) {
            $agency->slug = Str::slug($agency->agency_code);
        });

        static::updating(function ($agency) {
            if ($agency->isDirty('agency_code')) { // Hanya update jika kategori berubah
                $agency->slug = Str::slug($agency->agency_code);
            }
        });
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
