<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFasilitas extends Model
{
    //

    use SoftDeletes;
    protected $table = 'project_fasilitas';

    protected $fillable = [
        'project_id',
        'fasilitas',
    ];
}
