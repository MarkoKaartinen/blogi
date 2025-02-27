<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'file',
        'created_at',
        'updated_at'
    ];

    protected function casts(): array
    {
        return [
            'updated_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }
}
