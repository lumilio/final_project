@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <h2>Singolo appartamento</h2>

        <p>
            Servizi aggiuntivi:
            @if (count($apartment->services) > 0)
                @foreach ($apartment->services as $service)

                    {{ $service->name }}
                @endforeach

            @else
                <span>Non ci sono servizi aggiuntivi</span>
            @endif
        </p>


    </div>
@endsection
