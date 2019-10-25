<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Movie;
class MainController extends Controller
{
    //
    public function index()
    {
        return view('welcome');
    }

    public function list()
    {
        $personas = Persona::all();
        return view('personas')
            ->with('personas', $personas);  //nome de variavel acessivel no blade e o conteudo que vai ter
    }

    public function form()
    {   
        $movies = Movie::all();
        return view('insert')
        ->with('movies',$movies);
    }

    public function insert(Request $request)
    {
        $this->validate($request,[
            'name_persona' => 'required|unique:personas|string|max:60', //campo que é obrigatório ser preenchido | para validar só strings e com máximo de 255 caracteres; unique permite ser único:nome_da_tabela
            'description' => 'required|image',
            'movie_id' => 'required|exists:movies,id',
            ],[
                'name_persona.required' => 'é necessário ter um nome',
                'description' => 'é necessário ter descrição ter descrição',
                'movie_id' => 'é necessário ter descrição saber qual é o filme'
            ]);
            $data = $request->all();

            $file = $request->file('description')->store('images');

            $data['description'] = $file;

            Persona::create($data);

            return redirect()->route('list');

    }
}
