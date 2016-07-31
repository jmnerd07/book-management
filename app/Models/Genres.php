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
	public function parentGenre()
	{
		return $this->hasOne('App\Models\Genres', 'id', 'parent_genre_id');
	}
	public function subGenres()
	{
		return $this->hasMany('App\Models\Genres','parent_genre_id','id')->where('record_id', NULL)->orderBy('name', 'ASC');
	}
}
