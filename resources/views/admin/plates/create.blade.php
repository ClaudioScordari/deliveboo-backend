@extends('layouts.app')

@section('page-title', 'Crea un piatto')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        Crea un nuovo piatto
                    </h1>
                    
                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <br>

                    <form action="{{ route('admin.plates.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        
                        {{-- Nome piatto --}}
                        <div class="mb-3">
                            <label class="d-block" for="name">Nome piatto: <span class="text-danger">*</span></label>

                            <input class="@error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                maxlength="255" 
                                id="name" 
                                name="name" 
                                type="text" 
                                placeholder="Nome del piatto..." 
                                required
                                >

                            {{-- Barra errore --}}
                            @error('name')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Prezzo --}}
                        <div class="mb-3" style="width: 15%">
                            <label for="price" class="form-label">Prezzo : <span class="text-danger">*</span></label>

                            <input 
                                type="number" 
                                min="0" 
                                step="0.01"
                                name="price" 
                                id="price" 
                                class="form-control" 
                                value="{{ old('price') }}" 
                                placeholder="Prezzo"
                                required
                            >

                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Visibile --}}
                        <div class="mb-3">
                            <input value="1" type="checkbox" name="visible" id="visible">
                            <label for="visible" class="form-label">- <span class="fw-bold">Spunta se vuoi che il tuo piatto appaia nel Menù</span></label>
                        </div>

                        {{-- Ingredienti --}}
                        <div class="mb-3">
                            <label class="d-block" for="ingredients">Ingredienti: <span class="text-danger">*</span></label>

                            <p class="fw-bold">Scrivi gli ingredienti con un Nome separato da una virgola e da uno spazio</p>

                            <textarea 
                                cols="23" 
                                class="@error('ingredients') is-invalid @enderror" 
                                maxlength="4096" 
                                name="ingredients" 
                                id="ingredients" 
                                placeholder="Scrivi gli ingredienti"
                                >
                                {{ old('ingredients') }}
                            </textarea>

                            {{-- Barra errore --}}
                            @error('ingredients')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>
                        
                        {{-- Img da aggiungere --}}
                        <div class="mb-3">
                            <label for="img" class="form-label">Scegli un'immagine da assegnare al tuo piatto:</label>

                            <input 
                                style="width: 25%" 
                                class="@error('img') is-invalid @enderror form-control" 
                                type="file" 
                                id="img" 
                                name="img"
                                >

                            {{-- Barra errore --}}
                            @error('img')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>
                        
                        {{-- Descrizione --}}
                        <div class="mb-3">
                            <label class="d-block" for="description">Descrizione:</label>

                            <textarea 
                                cols="23" 
                                class="@error('description') is-invalid @enderror" 
                                maxlength="4096" 
                                name="description" 
                                id="description" 
                                placeholder="Scrivi una descrizione"
                                >
                                {{ old('description') }}
                            </textarea>

                            {{-- Barra errore --}}
                            @error('description')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <button type="submit" class="btn btn-primary">Aggiungi piatto</button>
                        </div>
                        <br>
                    </form>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection