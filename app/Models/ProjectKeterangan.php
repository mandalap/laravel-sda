<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectKeterangan extends Model
{
    //
    use SoftDeletes;

    protected $table = "project_keterangans";

    protected $fillable = [
        'project_id',
        'keterangan',
    ];


}

