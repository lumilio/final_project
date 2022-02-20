@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex flex-column align-items-center">
        <advanced-search :services='{{ json_encode($services) }}'></advanced-search>
    </div>
@endsection
