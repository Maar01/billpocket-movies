<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Http\apiTraits\ApiResponse;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    use ApiResponse;
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
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(Request $request)
    {
        $movieData = $request->all();

        $movie = Movie::updateOrCreate(
            [ 'mdb_id' => $movieData['id'], 'original_title' => $movieData['original_title'] ],
            [ 'poster_path' => $movieData['poster_path'] ]
        );
        $newFav = new Favourite();
        $newFav->user_id = Auth::user()->id;
        $newFav->movie_id = $movie->id;

        if ($newFav->save()) {
            $this->setHttpResponse('sucess', 201);
        } else {
            $this->setHttpResponse('error', 409, ['error' => 'Fav not added']);
        }

        return $this->sendResponse();
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
