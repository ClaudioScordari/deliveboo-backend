@extends('layouts.app')

@section('page-title', 'Modifica il ristorante ' . $restaurant->activity_name)

@section('main-content')
    <section class="container-form-section">
        <div class="container-form card border-success bg-light m-auto w-50 px-5 py-4">
            <h1 class="text-center text-success">MODIFICA L'ATTIVITA'</h1>

            <p class="fw-bold">I campi con <span class="text-danger fw-bold">*</span> sono obbligatori</p>

            <form action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->id]) }}" method="POST"
                enctype="multipart/form-data" id="restaurantForm">
                @csrf
                @method('PUT')

                {{-- Nome attività --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="activity_name">Nome Ristorante: <span
                            class="text-danger fw-bold">*</span></label>

                    <input class="@error('activity_name') is-invalid @enderror form-control"
                        value="{{ old('activity_name', $restaurant->activity_name) }}" maxlength="255" id="activity_name"
                        name="activity_name" type="text" placeholder="Scrivi il nome..." autocomplete="on">

                    {{-- Barra errore --}}
                    @error('activity_name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Partita IVA --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="VAT_number">Partita IVA: <span class="text-danger fw-bold">*</span></label>

                    <input class="@error('VAT_number') is-invalid @enderror form-control"
                        value="{{ old('VAT_number', $restaurant->VAT_number) }}" maxlength="50" id="VAT_number"
                        name="VAT_number" type="text" placeholder="Inserisci qui..." autocomplete="on" required>

                    {{-- Barra errore --}}
                    @error('VAT_number')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Indirizzo attività --}}
                <div class="mb-3 form-group">
                    <label class="d-block" for="address">Indirizzo: <span class="text-danger fw-bold">*</span></label>

                    <input class="@error('address') is-invalid @enderror form-control"
                        value="{{ old('address', $restaurant->address) }}" maxlength="255" id="address" name="address"
                        type="text" autocomplete="on" placeholder="Inserisci indirizzo..." required>

                    {{-- Barra errore --}}
                    @error('address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Img da aggiungere --}}
                <div class="mb-3 form-group">
                    <label for="img" class="form-label">Aggiorna l'immagine del tuo Ristorante:</label>

                    <input class="@error('img') is-invalid @enderror form-control" type="file" autocomplete="on"
                        id="img" name="img">

                    {{-- Barra errore --}}
                    @error('img')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Immagine corrente --}}
                @if ($restaurant->image != null)
                    <div class="my-3 text-center">
                        <img class="w-50 rounded" src="/storage/{{ $restaurant->image }}"
                            alt="{{ $restaurant->activity_name }}">
                    </div>
                @endif

                {{-- Checkbox se voglio rimuovere l'img --}}
                @if ($restaurant->image != null)
                    <div class="form-group">
                        <input value="1" type="checkbox" name="remove_file" id="remove_file">

                        <label for="remove_file" class="form-label">Oppure Rimuovila</label>
                    </div>
                @endif

                {{-- Tipi --}}
                <div class="my-4 form-group">
                    <span>Scegli il tipo:</span>

                    <div class="row pt-2 mx-5">
                        @foreach ($types as $type)
                            <div class="col-md-4 p-2">
                                <div class="form-check">
                                    <input class="form-check-input type-checkbox" type="checkbox" name="types[]"
                                        value="{{ $type->id }}" id="type-{{ $type->id }}"
                                        {{ $restaurant->types->contains($type->id) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="type-{{ $type->id }}">
                                        {{ $type->name }}
                                    </label>
                                </div>
                            </div>
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

                    <textarea cols="23" class="@error('description') is-invalid @enderror form-control" maxlength="4096"
                        name="description" id="description" placeholder="Scrivi una descrizione">{{ old('description', $restaurant->description) }}</textarea>

                    {{-- Barra errore --}}
                    @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-secondary text-white"><i class="fa-solid fa-pencil"></i> Aggiorna
                        Attività</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('restaurantForm').addEventListener('submit', function(event) {
            let checkboxes = document.getElementsByClassName('type-checkbox');

            let checked = Array.from(checkboxes).some(function(checkbox) {
                return checkbox.checked;
            });

            if (!checked) {
                event.preventDefault();
                alert('Devi selezionare almeno un tipo di cucina!');
                return false;
            }
        });
    </script>
@endsection
