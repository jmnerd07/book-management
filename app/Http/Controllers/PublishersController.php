<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;

class PublishersController extends Controller
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
                'publisher_name'=> 'required|min:5'
              ],
              [
                'publisher_name.required'=>'Publisher name is required. Publisher not saved.',
                'publisher_name.min'=>'Publisher name must be minimum of 5 characters'
              ]);
            if( $validator->fails())
            {
                $return['error'] = $validator->errors();
                $return['model'] = ['publisher_name'=>FALSE,'id'=>FALSE];
                echo json_encode( $return );
                return;
            }
            $return['error'] = $validator->errors();
            $publisher = new Publisher();
            $publisher->name = $request->get('publisher_name');
            $publisher->save();
            $publisher_id = $publisher->id;
            $publisher = new Publisher();
            $publisher->name = $request->get('publisher_name');
            $publisher->record_id = $publisher_id;
            $publisher->save();
            $return['model'] = ['publisher_name'=>$request->get('publisher_name'), 'id'=>$publisher_id];
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
