<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Books extends Model
{
    //
    protected $table = "books";
    public function booksGenres()
    {
        return $this->hasMany('App\Models\BooksGenres', 'book_id', 'id');
    }
    public function author()
    {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }
    public function publisher()
    {
        return $this->hasOne('App\Models\Publisher', 'id', 'publisher_id');
    }
}