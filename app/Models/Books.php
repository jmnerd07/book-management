<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    protected $table = "books";
    public function booksCategories()
    {
        return $this->hasMany('BookCategories', 'book_id', 'id');
    }
    public function author()
    {
        return $this->hasOne('Author', 'author_id', ' id');
    }
    public function publisher()
    {
        return $this->hasOne('Publisher', 'publisher_id', 'id');
    }
}