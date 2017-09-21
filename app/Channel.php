<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Discussion;

class Channel extends Model
{
    protected $fillable = ['title', 'slug'];

    public function discussions() {
    	return $this->hasMany(Discussion::class);
    }
}
