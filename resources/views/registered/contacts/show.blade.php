@extends('layouts.registered')

@section('content')
    <div class="container mt-5">
        <p>Messaggio inviato da {{ $contact->email }}, {{ $contact->name }} </p>
        <p> <span class="fw-bold">Oggetto:</span> {{ $contact->oggetto_mail }}</p>
        <p><span class="fw-bold">Messaggio:</span> <br>
            {{ $contact->message }}
        </p>
        <p><span class="fw-bold">Data:</span> {{ $contact->created_at }} </p>
    </div>
@endsection
