<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    //
    use SoftDeletes;
    protected $table = "members";

    protected $fillable = [
        'sapaan',
        'nama',
        'email',
        'telepon',
        'password',
        'recovery_code',
        'status',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'kota_id',
        'alamat',
        'thumbnail',
    ];
}
