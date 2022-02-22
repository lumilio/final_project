@extends('layouts.app')

@section('navbar')
@include('partials.adv')
@endsection

@section('content')
    <div class="container-fluid justify-content-center">
        <searchbar-component></searchbar-component>
        <advanced-search :services='{{ json_encode($services) }}'></advanced-search>
    </div>
@endsection
