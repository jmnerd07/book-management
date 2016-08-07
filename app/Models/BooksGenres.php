<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksGenres  extends Model
{
	protected $table = "books_genres";
	public function genres()
	{
		return $this->hasOne('App\Models\Genres','id','category_id');
	}
	public function books()
	{
		return $this->hasMany('App\Models\Books','id','book_id');
	}
}
