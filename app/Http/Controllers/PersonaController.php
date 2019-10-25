<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Persona::all();
        $persona = Persona::with('movie')->get();
        //return Persona::with('movie')->get();

        $response = [
            'data' => $persona,
            'message' => 'Listagem de Personas',
            'result' => 'OK'
        ];

        //return response($persona,200);
        return response($response);
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
            'name_persona' => 'required|unique:personas|string|max:60', //campo que é obrigatório ser preenchido | para validar só strings e com máximo de 255 caracteres; unique permite ser único:nome_da_tabela
            //'description' => 'required|string|max:255',
            'description' => 'required|image',
            'movie_id' => 'required|exists:movies,id',
            ],[
                'name_persona.required' => 'é necessário ter um nome',
                'description' => 'é necessário ter descrição ter descrição',
                'movie_id' => 'é necessário ter descrição saber qual é o filme'
            ]);
        
        if($validator->fails()){
            return $validator->errors()->all();
        }
        //$request->file('description')->store('public');
        //$request->file('description')->store('images');  -- cria uma nova posta images e adiciona
        $file = $request->file('description')->store('images');
        $data['description'] = $file;


        $persona = Persona::create(
            [
                'name_persona' => $data['name_persona'],
                'description' => $data['description'],
                'movie_id' => $data['movie_id']
            ]
        );

        //return $persona;

        //return response($persona,201);

        $response = [
            'data' => $persona,
            'message' => 'Personas adicionada',
            'result' => 'OK'
        ];


        return response($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        return $persona;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $data = $request->all();
        $persona->update($data);
        //return $persona; //mensagem para user

        $response = [
            'data' => $persona,
            'message' => 'Personas atualizada',
            'result' => 'OK'
        ];


        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();

        //return "deleted";

        $response = [
            'data' => '',
            'message' => 'Personas eliminada',
            'result' => 'OK'
        ];


        return response($response);
    }
}
