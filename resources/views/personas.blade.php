@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @foreach($personas as $persona)

                        
                        <div class="card-header">
                        <div class="row">
                            
                            <b>Nome do filme: </b> 
                            <p> {{ $persona->movie->name_movie}} </p>
                        </div>
                        </div>
                        {{-- asasa --}}
                        <div class="card-body">
                            <div class="row">
                            Persona:<p>{{ $persona->name_persona }}</p>
                            <div class="col-md-4">
                                <img class="img-fluid" src="/uploads/{{$persona->description}}" />
                            </div>
                            </div>
                        </div>
                    @endforeach
               
            </div>
        </div>
    </div>
</div>
@endsection
