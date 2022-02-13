@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Elementi</h1>
        </div>

        <h2>Inserisci un nuovo appartamento</h2>
        <div class="apartments">
            @include('partials.error')
            <form action="{{ route('registered.apartments.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" aria-describedby="titleHelper"
                        placeholder="Inserisci un titolo descrittivo" value="{{ old('title') }}">
                    <small id="titleHelper" class="form-text text-muted">Scrivi un titolo descrittivo per l'appartamento, max
                        255
                        caratteri</small>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" name="address" id="address"
                        class="form-control @error('address') is-invalid @enderror" aria-describedby="addressHelper"
                        placeholder="Inserisci l'indirizzo" value="{{ old('address') }}">
                    <small id="addressHelper" class="form-text text-muted">Scrivi l'indirizzo dell'appartamento, max 255
                        caratteri</small>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="file" class="form-control" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror" aria-describedby="imageHelper"
                        accept="images/*">
                    <small id="imageHelper" class="form-text text-muted">Scegli un immagine di max 500 MB</small>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea placeholder="Inserisci la descrizione"
                        class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check py-2">
                        <p>Seleziona un servizio aggiuntivo:</p>
                        @foreach ($services as $service)
                            <label class="form-check-label d-flex " for="services">
                                <input type="checkbox" class="form-check-input mx-2" name="services[]" id="services"
                                    value="{{ $service->id }}">
                                {{ $service->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('services')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="text-center pb-5">
                    <button type="submit" class="btn btn-success w-25">Salva</button>
                </div>
            </form>
        </div>
    </div>
@endsection
