<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Discount extends Model
{
    //
    use SoftDeletes;
    protected $table = 'discounts';

    protected $fillable = [
        'nama_diskon',
        'jumlah_diskon',
        'status',
        'start_date',
        'end_date',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['nama_diskon'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
