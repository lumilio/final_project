@extends('layouts.registered')

@section('content')
<p>{{$contact->email}}</p>
                        <p>{{$contact->created_at}}</p>
                        <p>{{$contact->oggetto_mail}}</p>
@endsection