@extends('layouts.registered')

@section('content')
    <div class="container-fluid cont_sponsor">
        <h1 class="text-center py-4 title_sponsor fw-bold">Sponsor</h1>
        <div class="row">
            <p class="fs-4 mb-4 text-center desc_sponsor">Sponsorizza il tuo appartamento affinchè venga mostrato prima degli altri, <br> scegliendo
                uno dei seguenti
                pacchetti:</p>
            @foreach ($sponsors as $sponsor)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card text-center card_sponsor rounded-3 p-3 mb-4">
                        <h2 class="text-center sponsor_name">{{ $sponsor->name }}</h2>
                        <div class="card-body border-top justify-content-between d-flex flex-column">
                            <p class="border-bottom price">Prezzo: <br>{{ $sponsor->price }}€</p>
                            <p class="border-bottom time">Durata sponsorizzazione: <br>{{ $sponsor->duration }} ore</p>
                            <a class="btn btn-orange text-white" href="">
                                Acquista
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
