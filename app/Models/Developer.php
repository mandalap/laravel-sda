<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Developer extends Model
{
    //
    use SoftDeletes;
    protected $table = "developers";

    protected $fillable = [
        'member_id',
        'nama',
        'thumbnail',
        'alamat',
        'telepon',
        'email',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function member() :BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

}
