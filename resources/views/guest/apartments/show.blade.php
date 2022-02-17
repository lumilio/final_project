@extends('layouts.app')

@section('content')
    <div class="mt-5 container d-flex justuify-content-center flex-wrap">


        <div style='max-width:500px' class="container d-flex flex-column">
            <h3 class=" mb-4">{{ $apartment->title }}</h3>
            <!--------- bagni, camere, mq, letti --------->
            <div class='d-flex mb-3'>
                <span class="me-3"><i class="fa-solid fa-person-booth"></i> {{ $apartment->n_rooms }}</span>
                <span class="me-3"><i class="fa-solid fa-bed"></i> {{ $apartment->n_bed }}</span>
                <span class="me-3"><i class="fa-solid fa-expand"></i> {{ $apartment->square_meters }} mq</span>
                <span class="me-3"><i class="fa-solid fa-toilet"></i> {{ $apartment->n_bathroom }}</span>
            </div>
            <!--------------------------->
            <!--------- servizi --------->
            <p> servizi :
                @forelse ($apartment->services as $service)
                    <span class="badge text-black bg-warning">{{ $service->name }}</span>
                @empty
                    nessun servizio assegnato
                @endforelse
                <!--------------------------->
            <p class="mt-1">{{ $apartment->description }}</p>

            <!-------------  MAppa    ----------->
            <div style='max-width:100%;height:450px' class='mt-3 container bg-dark'></div>
            <!--------------------------->
        </div>

        <div style='max-width:700px' class=" container d-flex justify-content-center flex-column">
            <img style='max-width:700px' class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}"
                alt="Card image cap">
            <!-------------- form per contattare il proprietario dell'annuncio --------------------------->
            <div class='bg-secondary mt-3 p-3'>
                <form action="{{route('guest.contacts.store')}}" method='post'>   
                    @csrf
                    <div class="mb-3">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                        <div class="row mb-2 d-flex flex-wrap">
                            <div style='max-width:250px'>
                                <label for="name" class="form-label"></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Mario Bross"
                                    required minleght='4' maxlenght='50' aria-describedby="nameHelper"
                                    value="{{ old('name') }}">
                                <small id="helpId" class="text-white">Inserisci il tuo nome</small>
                            <!--@error('e-mail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror -->
                            </div>
                            <div style='max-width:250px'>
                                <label for="email" class="form-label"></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="mario.bross@gmail.com" required aria-describedby="emailHelper"
                                    value="{{ old('email') }}">
                                <small id="helpId" class="text-white">inserici la tua mail migliore</small>
                            <!--@error('e-mail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror -->
                            </div>
                            <div class='d-none'>
                                <label for="apartment_id" class="form-label"></label>
                                <input type="apartment_id" name="apartment_id" id="apartment_id" class="form-control" value="{{ $apartment->id }}">
                                <small id="helpId" class="text-white">inserici la tua mail migliore</small>
                            </div>
                            <div class='d-none'>
                                <label for="slug" class="form-label"></label>
                                <input type="slug" name="slug" id="slug" class="form-control" value="{{ $apartment->slug }}">
                                <small id="helpId" class="text-white">inserici la tua mail migliore</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <textarea class="form-control" name="message" required id="message"
                                    rows="3">{{ old('message') }}</textarea>
                                <small id="message" class="text-white">Scrivi il tuo messaggio al venditore
                                    dell'appartamento</small>
                            <!--@error('e-mail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid d-flex justify-content-end">
                        <button type="submit" class="btn px-5 text-white btn-primary">Send</button>
                    </div>
                </form>
            </div>
            <!-------------------------------------------------------------------------------------------->
        </div>
    </div>
@endsection
