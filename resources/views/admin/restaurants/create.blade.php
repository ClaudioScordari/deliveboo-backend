@extends('layouts.app')

@section('page-title', 'Crea un ristorante')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        Crea un nuovo ristorante
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

                    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        
                        {{-- Nome attività --}}
                        <div class="mb-3">
                            <label class="d-block" for="name">Nome ristorante: <span class="text-danger">*</span></label>

                            <input class="@error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                maxlength="255" 
                                id="name" 
                                name="name" 
                                type="text" 
                                placeholder="Scrivi il nome..." 
                                required
                                >

                            {{-- Barra errore --}}
                            @error('name')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Partita IVA --}}
                        <div class="mb-3">
                            <label class="d-block" for="VAT_number">Partita IVA: <span class="text-danger">*</span></label>

                            <input class="@error('VAT_number') is-invalid @enderror" 
                                value="{{ old('VAT_number') }}" 
                                maxlength="50" 
                                id="VAT_number" 
                                name="VAT_number" 
                                type="text" 
                                placeholder="Inserisci qui..." 
                                required
                                >

                            {{-- Barra errore --}}
                            @error('VAT_number')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Indirizzo attività --}}
                        <div class="mb-3">
                            <label class="d-block" for="address">Indirizzo: <span class="text-danger">*</span></label>

                            <input class="@error('address') is-invalid @enderror" 
                                value="{{ old('address') }}" 
                                maxlength="255" 
                                id="address" 
                                name="address" 
                                type="text" 
                                placeholder="Inserisci indirizzo..." 
                                required
                                >

                            {{-- Barra errore --}}
                            @error('address')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Img da aggiungere --}}
                        <div class="mb-3">
                            <label for="img" class="form-label">Scegli un'immagine da assegnare al tuo ristorante:</label>

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

                        {{-- Tipi --}}
                        <div class="my-4">
                            <label class="d-block" for="types">Scegli il tipo:</label>

                            @foreach ($types as $type)
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox"
                                        name="types[]"
                                        value="{{ $type->id }}"
                                        id="type-{{ $type->id }}"
                                        {{ in_array($type->id, old('types', [])) ? 'checked' : ''}}
                                    >

                                    <label class="form-check-label" for="{{ $type->id }}">
                                        {{ $type->name }}
                                    </label>
                                </div>
                            @endforeach
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
                            <button type="submit" class="btn btn-primary">Aggiungi attività</button>
                        </div>
                        <br>
                    </form>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection