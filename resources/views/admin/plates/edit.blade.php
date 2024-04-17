@extends('layouts.app')

@section('page-title', 'Modifica Piatto')

@section('main-content')
<section class="container-form-section p-5">
    <div class="container-form card border-success bg-light m-auto w-50 px-5 py-4">
        <h1 class="text-center text-success">MODIFICA IL TUO PIATTO</h1>

        <p class="fw-bold my-3">I campi con <span class="text-danger fw-bold">*</span> sono obbligatori</p>
    
        <form action="{{ route('admin.plates.update', ['plate' => $plate->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            {{-- Nome piatto --}}
            <div class="mb-3 form-group">
                <label class="d-block" for="name">Nome Piatto: <span class="text-danger">*</span></label>
    
                <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $plate->name) }}" maxlength="255"
                    autocomplete="on" id="name" name="name" type="text" placeholder="Nome del piatto..." required>
    
                {{-- Barra errore --}}
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            {{-- Prezzo --}}
            <div class="mb-3 form-group" style="width: 20%">
                <label for="price" class="form-label">Prezzo: <span class="text-danger">*</span></label>
    
                <input type="number" min="0" step="0.01" name="price" id="price" class="form-control"
                    value="{{ old('price', $plate->price) }}" placeholder="Prezzo" max="1000" required>
    
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
            {{-- Visibile --}}
            <div class="mb-3">
                <input value="1" type="checkbox" name="visible" id="visible" {{ $plate->visible == 1 ? 'checked' : '' }}>
                <label for="visible" class="form-label">Disponibile?</label>
            </div>
    
            {{-- Ingredienti --}}
            <div class="mb-3 form-group text-left">
                <label class="d-block" for="ingredients">Ingredienti: <span class="text-danger">*</span></label>
    
                <textarea cols="23" class="form-control @error('ingredients') is-invalid @enderror" maxlength="4096" name="ingredients" id="ingredients" placeholder="Scrivi gli ingredienti" required>{{ old('ingredients', $plate->ingredients) }}</textarea>
                
                {{-- Barra errore --}}
                @error('ingredients')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            {{-- Img da aggiungere --}}
            <div class="mb-3 form-group">
                <label for="img" class="form-label">Scegli un'immagine da assegnare al tuo piatto:</label>
    
                <input class="form-control @error('img') is-invalid @enderror form-control" type="file" id="img" name="img">
    
                {{-- Barra errore --}}
                @error('img')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            {{-- Immagine corrente --}}
            @if ($plate->image != null)
                <div class="my-3 text-center">
                    <img class="w-50 rounded" src="/storage/{{ $plate->image }}" alt="{{ $plate->name }}">
                </div>
            @endif
    
            {{-- Checkbox se voglio rimuovere l'img --}}
            @if ($plate->image != null)
                <div>
                    <input value="1" type="checkbox" name="remove_file" id="remove_file">
    
                    <label for="remove_file" class="form-label">Oppure Rimuovila</label>
                </div>
            @endif
    
            {{-- Descrizione --}}
            <div class="mb-3 form-group">
                <label class="d-block" for="description">Descrizione:</label>
    
                <textarea cols="23" class="form-control @error('description') is-invalid @enderror" maxlength="4096" name="description" id="description" placeholder="Scrivi una descrizione">{{ old('description', $plate->description) }}
                </textarea>
    
                {{-- Barra errore --}}
                @error('description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div>
                <button type="submit" class="btn btn-secondary text-white"><i class="fa-solid fa-pencil"></i> Aggiorna Piatto</button>
            </div>
        </form>
    </div>
</section>
@endsection
