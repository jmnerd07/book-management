<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
	protected $table = "genres";

	public function booksGenres()
	{
		return $this->hasMany('App\Models\BooksGenres','id','genre_id');
	}
}
