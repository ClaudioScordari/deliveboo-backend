@extends('layouts.app')

@section('page-title', 'Crea un piatto')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form card border-success bg-light m-auto w-50 px-5 py-4">
            <h1 class="text-center text-success">CREA UN NUOVO PIATTO</h1>

            <p class="fw-bold">I campi con <span class="text-danger fw-bold">*</span> sono obbligatori</p>

            <form action="{{ route('admin.plates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nome piatto --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="name">Nome: <span class="text-danger">*</span></label>

                    <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                        maxlength="255" id="name" name="name" type="text" placeholder="Nome del Piatto"
                        required>

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
                        value="{{ old('price') }}" placeholder="Prezzo" required>

                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Visibile --}}
                <div class="mb-3">
                    <input value="1" type="checkbox" name="visible" id="visible">
                    <label for="visible" class="form-label"><span class="fw-bolder">Disponibile?</span></label>
                </div>

                {{-- Ingredienti --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="ingredients">Ingredienti: <span class="text-danger">*</span></label>

                    <textarea cols="23" class="form-control @error('ingredients') is-invalid @enderror" maxlength="4096" name="ingredients" id="ingredients" placeholder="Scrivi gli ingredienti" required>{{ old('ingredients') }}
                    </textarea>

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

                    <input class="@error('img') is-invalid @enderror form-control" type="file" id="img"
                        name="img">

                    {{-- Barra errore --}}
                    @error('img')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Descrizione --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="description">Descrizione:</label>

                    <textarea cols="23" class="form-control @error('description') is-invalid @enderror" maxlength="4096" name="description" id="description" placeholder="Scrivi una descrizione">
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
                    <button type="submit" class="btn btn-secondary text-white">Aggiungi piatto <i class="fa-solid fa-plus"></i></button>
                </div>
                <br>
            </form>
        </div>
    </section>
@endsection
