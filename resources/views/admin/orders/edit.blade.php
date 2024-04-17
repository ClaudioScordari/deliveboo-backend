@extends('layouts.app')

@section('page-title', 'Modifica stato Pagamento')

@section('main-content')
<section class="container-form-section mt-4">
    <div class="container-form card border-success bg-light m-auto w-75 px-5 py-4">
        <h1 class="text-center text-success">Modifica stato Pagamento</h1>

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
    
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3 form-group text-center">
                {{-- Stato Pagamento --}}
                <label for="payment_status">Stato del Pagamento:</label>
                <select name="payment_status" id="payment_status" class="form-control w-75 mx-auto">
                    <option value="Completato" {{ $order->payment_status == 'Completato' ? 'selected' : '' }}>Completato</option>
                    <option value="In Attesa" {{ $order->payment_status == 'In Attesa' ? 'selected' : '' }}>In Attesa</option>
                    <option value="Fallito" {{ $order->payment_status == 'Fallito' ? 'selected' : '' }}>Fallito</option>
                    `<span class="text-succes">Completato</span>`
                </select>

                {{-- Barra errore --}}
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="text-center">
                <button type="submit" class="btn btn-secondary text-white"><i class="fa-solid fa-pencil"></i> Aggiorna Stato</button>
            </div>
        </form>
    </div>
</section>
@endsection