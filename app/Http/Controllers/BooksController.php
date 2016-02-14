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
		$action_route = 'books.save_new';
		return view('books._books_form', compact('book', 'action_route'));
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
			'publisher'=>'required',
			'isbn' => "required|max:13|min:13|regex:/^[1-9][0-9]{12}$/"
		],
			[
				'title.required'=>'Book title is required',
				'author.required' => 'Book author is required',
				'isbn.required' => 'ISBN is required',
				'isbn.max' => 'ISBN must be exactly 13 characters',
				'isbn.min' => 'ISBN must be exactly 13 characters',
				'isbn.regex'=>'ISBN must contain numbers only.',
				'publisher.required'=>'Publisher is required'
			]
		);
		if($result->fails())
		{
			$result->errors()->add('submitted', 1);
			$result->errors()->add('desc', (Input::get('description') !== "" ? TRUE : FALSE) );
			return redirect()->route('books.new')->withErrors($result->errors())->withInput();
		}

		$book = new Books();
		$book->title = $request->get("title");
		$book->author = $request->get("author");
		$book->isbn = $request->get("isbn");
		$book->description = $request->get('desciprition');
		$book->save();
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

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$book = Books::find($id);
		return view('books._books_form', compact('book'))->with('action_route', 'books.update_save');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$id = $request->get('id');
		$book = Books::find($id);
		$this->validate($request
				,[
				'title' => 'required',
				'author' => 'required',
				'isbn' => "required|max:13|min:13|regex:/^[1-9][0-9]{12}$/"
				]
				,[
						'title.required'=>'Book title is required',
						'author.required' => 'Book author is required',
						'isbn.required' => 'ISBN is required',
						'isbn.max' => 'ISBN must be exactly 13 characters',
						'isbn.min' => 'ISBN must be exactly 13 characters',
						'isbn.regex'=>'ISBN must contain numbers only.'
				]
		);
		$book->title = $request->get("title");
		$book->author = $request->get("author");
		$book->isbn = $request->get("isbn");
		$book->description = $request->get('desciprition');
		$book->save();
		return redirect()->route('books.home')->with('status', "Update successful")->withInput();
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
