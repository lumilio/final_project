@extends('layouts.registered')

@section('content')
<div class="container mt-5 inbox">
    <p>Messaggio inviato da <span class="fw-bold">{{$contact->email}}</span>, {{$contact->name}}, {{$contact->created_at}}</p>
    <p><span class="fw-bold">Oggetto</span> : {{$contact->oggetto_mail}}</p>
    <p>{{$contact->message}}</p>
</div>

@endsection
