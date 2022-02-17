@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Elementi</h1>
        </div>

        <h2>Appartamenti</h2>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">messaggio</th>
                        <th scope="col">email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($display as $contact)
                    <tr>
                        <td>{{$contact->message}}</td>
                        <td>{{$contact->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection