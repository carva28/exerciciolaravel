@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inserir Persona</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('insert-persona') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name_persona" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name_persona" type="text" class="form-control @error('name_persona') is-invalid @enderror" name="name_persona" value="{{ old('name_persona') }}" required autocomplete="name_persona" autofocus>

                                @error('name_persona')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">File</label>

                            <div class="col-md-6">
                                <input id="description" type="file" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="movie_id" class="col-md-4 col-form-label text-md-right">Movie</label>

                            <div class="col-md-6">
                                <select name="movie_id">
                                    @foreach($movies as $movie)
                                        <option value="{{$movie->id}}">{{$movie->name_movie}}</option>
                                    @endforeach
                                </select>
                                
    {{--                                <input id="movie_id" type="text" class="form-control @error('movie_id') is-invalid @enderror" name="movie_id" required autocomplete="movie_id"> --}}

                                @error('movie_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Adiconar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection