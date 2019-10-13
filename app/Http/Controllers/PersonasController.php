<?php

namespace App\Http\Controllers;

use App\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Personas::all();
        //return Personas::with('movies')->get();
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
            'name_persona' => 'required|unique:movies|string|max:60', //campo que é obrigatório ser preenchido | para validar só strings e com máximo de 255 caracteres; unique permite ser único:nome_da_tabela
            'description' => 'required|string|max:255',
            'movie_id' => 'required|exists:movies,id',
            ],[
                'name_persona.required' => 'é necessário ter um nome',
                'description' => 'é necessário ter descrição ter descrição',
                'movie_id' => 'é necessário ter descrição saber qual é o filme'
            ]);
        
        if($validator->fails()){
            return $validator->errors()->all();
        }

        $personas = Personas::create(
            [
                'name_persona' => $data['name_persona'],
                'description' => $data['description'],
                'movie_id' => $data['movie_id']
            ]
        );

        return $personas;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Personas $personas)
    {
        return $personas;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function edit(Personas $personas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personas $personas)
    {
        $data = $request->all();
        $personas->update($data);
        return 'Alterações efetuadas.'; //mensagem para user
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personas $personas)
    {
        $personas->delete();

        return "deleted";
    }
}
