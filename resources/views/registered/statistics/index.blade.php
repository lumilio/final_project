@extends('layouts.registered')

@section('content')
    <div class="container">
        <h2>Visualizzazioni dell'appartamento: {{ $apartment->title }}</h2>
        <p>
            Totale visualizzazioni di sempre:
            {{ count($apartment->views) }}
        </p>

        <div class='d-flex flex-column' >
            <span>2022</span>
            <span>gen, views:{{count($views_array[0][22][1])}}, messages:{{count($contacts_array[0][22][1])}}, </span>
            <span>feb, views:{{count($views_array[0][22][2])}}, messages:{{count($contacts_array[0][22][2])}}, </span>
            <span>mar, views:{{count($views_array[0][22][3])}}, messages:{{count($contacts_array[0][22][3])}}, </span>
            <span>apr, views:{{count($views_array[0][22][4])}}, messages:{{count($contacts_array[0][22][4])}}, </span>
            <span>mag, views:{{count($views_array[0][22][5])}}, messages:{{count($contacts_array[0][22][5])}}, </span>
            <span>giu, views:{{count($views_array[0][22][6])}}, messages:{{count($contacts_array[0][22][6])}}, </span>
            <span>lug, views:{{count($views_array[0][22][7])}}, messages:{{count($contacts_array[0][22][7])}}, </span>
            <span>ago, views:{{count($views_array[0][22][8])}}, messages:{{count($contacts_array[0][22][8])}}, </span>
            <span>set, views:{{count($views_array[0][22][9])}}, messages:{{count($contacts_array[0][22][9])}}, </span>
            <span>ott, views:{{count($views_array[0][22][10])}}, messages:{{count($contacts_array[0][22][10])}}, </span>
            <span>nov, views:{{count($views_array[0][22][11])}}, messages:{{count($contacts_array[0][22][11])}}, </span>
            <span>dec, views:{{count($views_array[0][22][12])}}, messages:{{count($contacts_array[0][22][12])}}, </span>  
        </div>
    </div>
@endsection
