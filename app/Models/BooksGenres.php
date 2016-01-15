<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksGenres  extends Model
{
	protected $table = "books_genres";
	public function genres()
	{
		return $this->hasMany('Genres','id','genre_id');
	}
	public function books()
	{
		return $this->hasMany('Books','id','genre_id');
	}
}
