@extends('layouts.app')

@section('navbar')
@include('partials.adv')
@endsection

@section('content')
    <div class="container-fluid justify-content-center">
        <div class="font_style text-center">
            <h3 class="mt-4 fw-bold">Cerca per Città o Indirizzo</h3>
        </div>
        <searchbar-component></searchbar-component>
        <advanced-search :services='{{ json_encode($services) }}'>
        </advanced-search>

    </div>
@endsection
