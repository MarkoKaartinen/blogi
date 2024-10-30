<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestbookMessage extends Model
{
    protected $fillable = ['nickname', 'message', 'homepage'];

    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
        ];
    }
}
