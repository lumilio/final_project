@extends('layouts.registered')

@section('content')
    <div class="container">
        <h2>Visualizzazioni dell'appartamento: {{ $apartment->title }}</h2>
        <p>
            Totale visualizzazioni di sempre:
            {{ count($apartment->views) }}
        </p>
    </div>
@endsection
