<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Genres;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $genres = Genres::whereNull('record_id')->where('parent_genre_id', NULL)->orderBy('parent_genre_id','ASC')->orderBy('name', 'ASC')->get();

        if($request->ajax())
        {
            if(!$request->has('_requestType'))
            {
                return response()->json(['error'=>TRUE, 'message'=>'Invalid request','data'=>array(),'rows'=>0]);
            }
            if($request->input('_requestType') == 'LIST_PARENT')
            {
                $genres = Genres::where('parent_genre_id', NULL)->whereNull('record_id')->orderBy('name', 'ASC')->get();
                return response()->json(['error'=>FALSE, 'message'=>'Request success', 'data'=>$genres, 'rows'=>$genres->count()]);
            }
        }

        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if request is an
        if($request->ajax()) 
        {
            $this->validate($request
                , [
                    'name'=>'required|min:4'
                ]
                , [
                    'name.required'=>'Genre name is required.',
                    'name.min'=>'Genre name must be minimum of 4 characters'
                ]);
            $parentGenreId = $request->input('parent_genre_id');
            $parentGenreId = ($parentGenreId == 0 ? NULL : $parentGenreId);
            // master record
            $newGenre = new Genres();
            $newGenre->name = $request->input('name');
            $newGenre->description = $request->input('description');
            $newGenre->parent_genre_id = $parentGenreId;
            $newGenre->save();
            $recordId = $newGenre->id;

            // create copy
            $newGenre = new Genres();
            $newGenre->name = $request->input('name');
            $newGenre->description = $request->input('description');
            $newGenre->parent_genre_id = $parentGenreId;
            $newGenre->record_id = $recordId;
            $newGenre->save();
            return response()->json([]);
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
    public function edit(Request $request)
    {
        if($request->ajax()) 
        {
            $this->validate($request
            , [
                'id'=>'required|numeric'
            ]
            , [
                'id.required'=>'Genre id is required.',
                'id.numeric'=>'Genre id must be numeric'
            ]);
            $genreId = $request->input('id');
            $genre = Genres::find($genreId);
            
            return $genre->toJson();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
                array(
                        'id'=>'required|numeric',
                        'name'=>'required|min:4'
                    ),
                array(
                        'id.required'=>'Genre id is required',
                        'id.numeric'=>'Genre id is invalid (must be numeric).',
                        'name.required'=>'Genre name is required',
                        'name.min'=>'Genre name must be minimum of 4 characters'
                    )
            );
        
        if($request->ajax())
        {
            return response()->json(['isError'=>FALSE, 'message'=>'', 'data'=>[ 'affectedRows'=>$this->saveModifyGenreDetails($request) ]]);

        }
    }

    /**
     * Save changes in details of an existing genre
     * @param  \Illuminate\Http\Request $request
     * @return array         
     */
    protected function saveModifyGenreDetails(Request $request)
    {
        // Save master record
        $genreId = $request->input('id');
        $genreName = $request->input('name');
        $genreDescription = $request->input('description');
        $genreParentGenreId = $request->input('parent_genre_id');

        $genre = Genres::find($genreId);
        $genre->name = $genreName;
        $genre->description = $genreDescription;
        $genre->parent_genre_id = $genreParentGenreId;
        $affectedRows = $genre->save();
        /*$affectedRows = Genres::where('id',$genreId)->update([
                'name'=>$genreName,
                'description'=>$genreDescription,
                'parent_genre_id'=>$genreParentGenreId
            ]);*/
        if($affectedRows > 0)
        {
            // Create copy record
            $copyRecord = new Genres();
            $copyRecord->name = $genreName;
            $copyRecord->description = $genreDescription;
            $copyRecord->record_id = $genreId;  
            $copyRecord->parent_genre_id = $genreParentGenreId; 
            $copyRecord->save();
        }
        return $affectedRows;
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
