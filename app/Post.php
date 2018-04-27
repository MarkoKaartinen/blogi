<?php

namespace App;

use App\Traits\Uuids;
use Parsedown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Uuids, SoftDeletes;

    public $incrementing = false; //we use UUIDs

    public function user(){
		return $this->belongsTo('App\User');
	}

    public function getBodyAttribute($original)
    {
        return (new Parsedown())->text($original);
    }

    public function getMarkdownAttribute()
    {
        return $this->getOriginal('body');
    }

}
