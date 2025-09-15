<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'size',
        'backup_date',
        'description',
        'backups_data_path'
    ];

    protected $casts = [
        'backup_date' => 'datetime'
    ];
}