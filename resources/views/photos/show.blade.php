@extends('layouts.app')

@section('content')

    <a class="button secondary" href="/albums/{{ $photo->album_id }}">Back To Gallery</a>
    <h1>{{ $photo->title }}</h1>
    <p>{{ $photo->description }}</p>

    <hr>

    <div id="photos">
        <div class="row">
            <img src="/images/photos/{{ $photo->album_id }}/{{$photo->photo}}" alt="{{ $photo->title }}">
            <br><br>
            {!!Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete Photo', ['class' => 'button alert'])}}
            {!!Form::close()!!}
            <hr>
            <small>Size: {{$photo->size}}</small>
        </div>
    </div>

@endsection