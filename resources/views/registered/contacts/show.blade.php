@extends('layouts.registered')

@section('content')
<div class="container mt-5">
    <p>messaggio inviato da {{$contact->email}}, {{$contact->name}}, {{$contact->created_at}}</p>
    <p>oggetto : {{$contact->oggetto_mail}}</p>
    <p>{{$contact->message}}</p>
</div>

@endsection