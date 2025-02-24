<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectPhoto extends Model
{
    //
    use SoftDeletes;

    protected $table = "project_photos";

    protected $fillable = [
        'project_id',
        'photo',
    ];

    public function project()
{
    return $this->belongsTo(Project::class);
}
}
