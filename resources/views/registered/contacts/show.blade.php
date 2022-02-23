@extends('layouts.registered')

@section('content')
    <div class="container mt-5">
        <p>Messaggio inviato da {{ $contact->email }}, {{ $contact->name }} </p>
        <p>Oggetto: {{ $contact->oggetto_mail }}</p>
        <p>Messaggio: <br>
            {{ $contact->message }}
        </p>
        <p>Data: {{ $contact->created_at }} </p>
    </div>
@endsection
