<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'mime_type', 'original_name', 'original_extension', 'path'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
