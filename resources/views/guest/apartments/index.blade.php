@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center hero_image">
    </div>


    <div class="container-fluid d-flex justify-content-center">
        <div class="container d-flex justify-content-center flex-wrap">

                @forelse ($apartment_array as $item)
                    <a href="{{route('guest.apartments.show', $item->slug)}}" class="card  m-5" style="width: 40%">
                        <img class="card-img-top" src="{{$item->image}}" alt="Card image cap">
                        <p class="card-text">{{$item->title}}</p>
                        <p class="card-text">{{$item->description}}</p>
                    </a>
                @empty
                    <p>no data</p>
                @endforelse
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        {{$apartment_array->links()}}
    </div>
@endsection
