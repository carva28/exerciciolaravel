<?php

namespace App\Http\Controllers;

use App\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movies::all();
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

        $movies = Movies::create(
            [
                'name_movie' => $data['name_movie'],
                'description_movie' => $data['description_movie']
            ]
        );

        return $movies;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function show(Movies $movies)
    {
        return $movies;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit(Movies $movies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movies $movies)
    {
        $data = $request->all();
        
        $movies->update($data); 
    
        return $movies;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movies $movies)
    {
        $movies->delete();

        return "deleted";
    }
}
