@extends('layouts.app')

@section('page-title', 'Modifica il ristorante ' . $restaurant->activity_name)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        Modifica il ristorante
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

                    <form action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->id]) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        
                        {{-- Nome attività --}}
                        <div class="mb-3">
                            <label class="d-block" for="activity_name">Nome ristorante: <span class="text-danger">*</span></label>

                            <input class="@error('activity_name') is-invalid @enderror" 
                                value="{{ old('activity_name', $restaurant->activity_name) }}" 
                                maxlength="255" 
                                id="activity_name" 
                                name="activity_name" 
                                type="text" 
                                placeholder="Scrivi il nome..." 
                                required
                                >

                            {{-- Barra errore --}}
                            @error('activity_name')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Nome proprietario --}}
                        <div class="mb-3">
                            <label class="d-block" for="user_name">Inserisci il nome e cognome del proprietario: <span class="text-danger">*</span></label>

                            <input class="@error('user_name') is-invalid @enderror" 
                                value="{{ old('user_name', $restaurant->user->name) }}" 
                                maxlength="255" 
                                id="user_name" 
                                name="user_name" 
                                type="text" 
                                placeholder="Nome proprietario..." 
                                required
                                >

                            {{-- Barra errore --}}
                            @error('user_name')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Partita IVA --}}
                        <div class="mb-3">
                            <label class="d-block" for="VAT_number">Partita IVA: <span class="text-danger">*</span></label>

                            <input class="@error('VAT_number') is-invalid @enderror" 
                                value="{{ old('VAT_number', $restaurant->VAT_number) }}" 
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
                                value="{{ old('address', $restaurant->address) }}" 
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
                            <label for="dataFile" class="form-label">Scegli un'immagine da assegnare al tuo ristorante:</label>

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

                        {{-- Immagine corrente --}}
                        {{-- 
                            @if ($restaurant->image != null)
                                <div class="my-3">
                                    <img style="width: 300px" src="/storage/{{ $restaurant->image }}" alt="{{ $restaurant->activity_name }}">
                                </div>
                            @endif 
                        --}}

                        {{-- Checkbox se voglio rimuovere l'img --}}
                        @if ($restaurant->image != null)
                            <div>
                                <input value="1" type="checkbox" name="remove_file" id="remove_file">

                                <label for="remove_file" class="form-label">- Rimuovi immagine</label>
                            </div>
                        @endif

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
                                        {{ $restaurant->types->contains($type->id) ? 'checked' : ''}}
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
                                {{ old('description', $restaurant->description) }}
                            </textarea>

                            {{-- Barra errore --}}
                            @error('description')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <button type="submit" class="btn btn-primary">Aggiorna attività</button>
                        </div>
                        <br>
                    </form>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection