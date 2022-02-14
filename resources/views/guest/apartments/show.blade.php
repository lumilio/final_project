@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center">
        <div class="container d-flex flex-column justify-content-center">
            <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="Card image cap">
            <p class="card-text">{{ $apartment->title }}</p>
            <p class="card-text">{{ $apartment->description }}</p>
        </div>
    </div>
@endsection
