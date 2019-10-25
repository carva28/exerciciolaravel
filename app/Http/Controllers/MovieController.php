<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
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
        $data = $request->all();

        $validator=Validator::make($data,[
            'name_movie' => 'required|unique:movies|string|max:60', //campo que é obrigatório ser preenchido | para validar só strings e com máximo de 255 caracteres; unique permite ser único:nome_da_tabela
            'description_movie' => 'required|string|max:255',
            ],[
                'name_movie.required' => 'é necessário preencher o título do filme',
                'description_movie.required' => 'é necessário o filme ter descrição'
            ]);
        
        if($validator->fails()){
            return $validator->errors()->all();
        }

        $movie = Movie::create(
            [
                'name_movie' => $data['name_movie'],
                'description_movie' => $data['description_movie']
            ]
        );

        return $movie;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $data = $request->all();
        
        $movie->update($data); 
    
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return "deleted";
    }
}
