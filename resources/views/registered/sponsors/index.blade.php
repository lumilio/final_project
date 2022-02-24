@extends('layouts.registered')

@section('content')
    <div class="container-fluid cont_sponsor">
        <h1 class="text-center py-4 title_sponsor fw-bold">Sponsor</h1>
        <div class="row">
            <p class="fs-4 mb-4 text-center desc_sponsor">Sponsorizza il tuo appartamento affinchè venga mostrato prima degli altri, <br> scegliendo
                uno dei seguenti
                pacchetti:</p>
            @foreach ($sponsors as $sponsor)

                <div class="col-4">
                    <div class="card rounded-3 p-3">
                        <h2 class="text-center">{{ $sponsor->name }}</h2>
                        <div class="card-body border-top">
                            <p>Prezzo: {{ $sponsor->price }}€</p>
                            <p>Durata sponsorizzazione: {{ $sponsor->duration }} ore</p>
                            <a class="btn btn-warning" href="{{ route('registered.sponsors.show', $sponsor->id) }}">

                                Acquista
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
