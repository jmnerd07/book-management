<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksCategories  extends Model
{
	protected $table = "books_categories";
	public function genres()
	{
		return $this->hasMany('Categories','id','category_id');
	}
	public function books()
	{
		return $this->hasMany('Books','id','book_id');
	}
}
