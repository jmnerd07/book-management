<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Books extends Model
{
    //
    protected $table = "books";
    public function booksCategories()
    {
        return $this->hasMany('App\Models\BookCategories', 'book_id', 'id');
    }
    public function author()
    {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }
    public function publisher()
    {
        return $this->hasOne('App\Models\Publisher', 'publisher_id', 'id');
    }
}