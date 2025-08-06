<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'type'
    ];
}
