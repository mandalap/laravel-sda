<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Project extends Model
{
    //
    use SoftDeletes;
    protected $table = "projects";

    protected $fillable = [
        'developer_id',
        'lokasi_id',
        'kategori_id',
        'jenis_id',
        'nama_project',
        'slug',
        'alamat_project',
        'url_video',
        'google_map',
        'latlang',
        'deskripsi',
        'sertifikat',
        'status_sertifikat',
        'transaksi',
        'status',
        'kelompok_id',
        'is_approved',
        'thumbnail',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['nama_project'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function developer() :BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function lokasi() :BelongsTo
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function kategori() :BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function jenis() :BelongsTo
    {
        return $this->belongsTo(Jenis::class);
    }
    public function kelompok() :BelongsTo
    {
        return $this->belongsTo(Kelompok::class);
    }

    protected static function booted()
    {
        static::creating(function ($project) {
            $project->slug = Str::slug($project->nama_project);
        });

        static::updating(function ($project) {
            if ($project->isDirty('nama_project')) { // Hanya update jika kategori berubah
                $project->slug = Str::slug($project->nama_project);
            }
        });
    }

    public function project_photos()
    {
        return $this->hasMany(ProjectPhoto::class);
    }

    public function project_fasilitas()
    {
        return $this->hasMany(ProjectFasilitas::class);
    }

    public function project_keterangan()
    {
        return $this->hasMany(ProjectKeterangan::class);
    }
    public function project_product()
    {
        return $this->hasMany(Product::class);
    }


}
