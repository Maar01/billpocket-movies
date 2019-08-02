<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'movie_id',
    ];
    //

    public function movie() {
        return $this->hasOne(Movie::class, 'id', 'movie_id');
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}
