<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;
class BooksController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$books = Books::orderBy('title', 'ASC')->get();

		return view('books.index', compact('books'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$book = new Books();

		return view('books._books_form', compact('book'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$result = Validator::make(Input::all(), [
			'title' => 'required',
			'author' => 'required',
			'isbn' => "required|max:13|min:13|regex:/^[1-9][0-9]{12}$/"
		],
			[
				'title.required'=>'Book title is required',
				'author.required' => 'Book author is required',
				'isbn.required' => 'ISBN is required',
				'isbn.max' => 'ISBN must be exactly 13 characters',
				'isbn.min' => 'ISBN must be exactly 13 characters',
				'isbn.regex'=>'ISBN must contain numbers only.'
			]
		);
		if($result->fails())
		{
			$result->errors()->add('submitted', 1);
			$result->errors()->add('desc', (Input::get('description') !== "" ? TRUE : FALSE) );
			return redirect()->route('books.new')->withErrors($result->errors())->withInput();
		}

		$new_book = new Books();
		$new_book->title = $request->get("title");
		$new_book->author = $request->get("author");
		$new_book->isbn = $request->get("isbn");
		$new_book->description = $request->get('desciprition');
		$new_book->save();
		return redirect()->route('books.home')->with('status', "New book created");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
