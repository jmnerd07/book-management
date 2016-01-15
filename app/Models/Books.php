<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    protected $table = "book_list";
    public function bookGenre()
    {
        return $this->hasMany('BookGenres', 'book_id', 'id');
    }
}