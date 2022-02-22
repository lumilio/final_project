@extends('layouts.app')

@section('content')
    <div class="mt-5 container">
        <h2 class="mb-4">{{ $apartment->title }}</h2>
        <h3><i class="fas fa-map-marker-alt"></i> {{ $apartment->address }}.</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <div>
                    <img class="rounded-start" width="100%" src="{{ asset('storage/' . $apartment->image) }}"
                        alt="Immagine appartamento">
                </div>

                <!---------dettagli appartamento bagni, camere, mq, letti --------->
                <div class='my-5'>
                    <span class="me-3"><i class="fa-solid fa-person-booth"></i> {{ $apartment->n_rooms }}</span>
                    <span class="me-3"><i class="fa-solid fa-bed"></i> {{ $apartment->n_bed }}</span>
                    <span class="me-3"><i class="fa-solid fa-expand"></i> {{ $apartment->square_meters }}
                        mq</span>
                    <span class="me-3"><i class="fa-solid fa-toilet"></i> {{ $apartment->n_bathroom }}</span>

                    <!--------- servizi --------->
                    <p class="my-3"> Servizi disponibili:
                        @forelse ($apartment->services as $service)
                            <div class="badge text-black bg-warning ">
                                <span>
                                    <img class="mx-2" height="20"
                                        src="{{ asset('img/service_logo/' . $service->icon . '.svg') }}"
                                        alt="{{ $service->name }}">
                                </span>
                                <span>
                                    {{ $service->name }}
                                </span>

                            </div>
                        @empty
                            Nessun servizio aggiuntivo
                        @endforelse

                    </p>
                    <!--------------------------->
                </div>
            </div>
            <!---- descrizione appartamento ----->
            <div class="col-12 col-md-6">
                @if ($apartment->description)
                    <p class="apartment_description">{{ $apartment->description }}</p>
                @else
                    <p>Nessuna descrizione.</p>
                @endif
            </div>
            <!--------------------------->


            <!-------------  Mappa    ----------->
            <div class="map_container container">
                <map-component :apartment='{{ json_encode($apartment) }}'></map-component>
            </div>
            <!--------------------------->
        </div>

        <div class="message_container container">
            <div class="row mb-5 bg_primary p-3">

                <!-------------- form per contattare il proprietario dell'annuncio --------------------------->
                <form action="{{ route('guest.contacts.store') }}" method='post'>
                    @csrf
                    <div class="mb-3">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="name" class="form-label"></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Mario Bross"
                                    required minleght='4' maxlenght='50' aria-describedby="nameHelper"
                                    value="{{ old('name') }}">
                                <small id="helpId" class="text-white">Inserisci il tuo nome</small>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="email" class="form-label"></label>
                                @auth
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="mario.bross@gmail.com" required aria-describedby="emailHelper"
                                        value="{{ Auth::user()->email }}">
                                @else
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="mario.bross@gmail.com" required aria-describedby="emailHelper"
                                        value="{{ old('email') }}">
                                @endauth
                                <small id="helpId" class="text-white">inserici la tua mail migliore</small>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='d-none'>
                                <label for="apartment_id" class="form-label"></label>
                                <input type="apartment_id" name="apartment_id" id="apartment_id" class="form-control"
                                    value="{{ $apartment->id }}">
                            </div>

                            <div class='d-none'>
                                <label for="slug" class="form-label"></label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ $apartment->slug }}">
                            </div>

                            <div class='d-none'>
                                <label for="oggetto_mail" class="form-label"></label>
                                <input type="text" name="oggetto_mail" id="oggetto_mail" class="form-control"
                                    value="{{ $apartment->title }}">
                            </div>
                        </div>

                        <div class="col">
                            <textarea class="form-control" name="message" required id="message"
                                rows="3">{{ old('message') }}</textarea>
                            <small id="message" class="text-white">Scrivi il tuo messaggio al venditore
                                dell'appartamento</small>
                            @error('message')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-light">Invia</button>
                        </div>
                    </div>
                </form>
                <!-------------------------------------------------------------------------------------------->
            </div>
        </div>
    </div>
@endsection
