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
                        <th scope="col">email</th>
                        <th scope="col"></th>
                        <th scope="col">oggetto</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($display as $contact)
                    <tr>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->created_at}}</td>
                        <td>{{$contact->oggetto_mail}}</td>
                        <td class='d-flex'>
                            <a href="{{route('registered.contacts.show',$contact->id)}}"><i class="fa-solid me-3 fa-glasses"></i></a>
                            <form class="me-3" method='post' action="{{route('registered.contacts.destroy', $contact->id )}}">
                            @csrf 
                            @method('DELETE')
                                <button style='background: none;
                                    color: inherit;
                                    border: none;
                                    padding: 0;
                                    font: inherit;
                                    cursor: pointer;
                                    outline: inherit;' 
                                    type="submit" style='border-box:none;'class="bg-none"><i class="text-danger ms-3 fa-solid fa-trash"></i></button>
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection