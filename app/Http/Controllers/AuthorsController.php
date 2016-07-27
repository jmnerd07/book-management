<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('type') == 'async')
        {
            $validator = Validator::make(Input::all(),
              [
                'author_name'=> 'required|min:5'
              ],
              [
                'author_name.required'=>'Author name is required. Author not saved.',
                'author_name.min'=>'Author name must be minimum of 5 characters'
              ]);
            if( $validator->fails())
            {
                $return['error'] = $validator->errors();
                $return['model'] = ['author_name'=>FALSE,'id'=>FALSE];
                echo json_encode( $return );
                return;
            }
            $return['error'] = $validator->errors();
            $author = new Author();
            $author->author_name = $request->get('author_name');
            $author->save();
            $author_id = $author->id;
            $author = new Author();
            $author->author_name = $request->get('author_name');
            $author->record_id = $author_id;
            $author->save();
            $return['model'] = ['author_name'=>$request->get('author_name'), 'id'=>$author_id];
            echo json_encode($return);
            return;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
