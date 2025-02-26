<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements LaratrustUser
{
    //
    use HasRolesAndPermissions;
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

    public function getAuthIdentifierName()
    {
        return 'id'; // untuk mengenali ID dari tabel members
    }

}
