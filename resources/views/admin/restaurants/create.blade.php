@extends('layouts.app')

@section('page-title', 'Crea un ristorante')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form card border-success bg-light m-auto w-50 px-5 py-4">
            <h1 class="text-center text-success">CREA LA TUA ATTIVITA'</h1>

            <p class="fw-bold my-3">I campi con <span class="text-danger fw-bold">*</span> sono obbligatori</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
        
                {{-- Nome attività --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="activity_name">Nome ristorante: <span class="text-danger">*</span></label>
        
                    <input class="form-control @error('activity_name') is-invalid @enderror" value="{{ old('activity_name') }}" maxlength="255"
                        id="activity_name" autocomplete="on" name="activity_name" type="text" placeholder="Scrivi il nome..." required>
        
                    {{-- Barra errore --}}
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Partita IVA --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="VAT_number">Partita IVA: <span class="text-danger">*</span></label>
        
                    <input class="form-control @error('VAT_number') is-invalid @enderror" value="{{ old('VAT_number') }}" maxlength="50"
                        id="VAT_number" autocomplete="on" name="VAT_number" type="text" placeholder="Inserisci qui..." required>
        
                    {{-- Barra errore --}}
                    @error('VAT_number')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                {{-- Indirizzo attività --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="address">Indirizzo: <span class="text-danger">*</span></label>
        
                    <input class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" maxlength="255"
                        id="address" autocomplete="on" name="address" type="text" placeholder="Inserisci indirizzo..." required>
        
                    {{-- Barra errore --}}
                    @error('address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                {{-- Img da aggiungere --}}
                <div class="mb-3 form-group">
                    <label for="img" class="form-label">Inserisci un'immagine del tuo Ristorante:</label>
        
                    <input class="form-control @error('img') is-invalid @enderror form-control" type="file" id="img"
                        name="img">
        
                    {{-- Barra errore --}}
                    @error('img')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                {{-- Tipi --}}
                <div class="my-4 form-group">
                    <span for="types">Seleziona i tuoi tipi di Cucina: <span class="text-danger">*</span></span>

                    <div class="row pt-2 mx-5">
                        @php $first = true; @endphp

                        @foreach ($types as $type)
                            <div class="col-md-4 p-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->id }}"
                                        id="{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }} {{ $first ? 'required' : '' }}>
                
                                    <label class="form-check-label" for="{{ $type->id }}">
                                        {{ $type->name }}
                                    </label>
                                </div>
                            </div>

                            @php $first = false; @endphp
                        @endforeach

                        {{-- Barra errore --}}
                        @error('types')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                </div>
        
                {{-- Descrizione --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="description">Descrizione:</label>
        
                    <textarea cols="23" class="form-control @error('description') is-invalid @enderror" maxlength="4096" name="description"
                        id="description" placeholder="Scrivi una descrizione">{{ old('description') }}</textarea>
        
                    {{-- Barra errore --}}
                    @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div>
                    <button type="submit" class="btn btn-secondary text-white"><i class="fa-solid fa-plus"></i> Crea Attività</button>
                </div>
            </form>
        </div>
    </section>

@endsection
