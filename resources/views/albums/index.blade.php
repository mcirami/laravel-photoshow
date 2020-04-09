@extends ('layouts.app')

@section('content')

    <h3>Albums</h3>

    @if(count($albums) > 0)

	    <?php

	        //$colcount = count($albums);
	        $i = 1;

        ?>

        <div id="albums">
            <div class="row text-center">

                @foreach ($albums as $album)

                    @if ($i == 3)

                        <div class="medium-4 columns end">
                            <a href="/albums/{{ $album->id }}">
                                {{--<img class="thumbnail" src="/images/album_covers/{{$album->cover_image}}" alt="{{ $album->name }}">--}}

                                {{--Using storage--}}
                                <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{ $album->name }}">
                            </a>
                            <br>
                            <h4>{{ $album->name }}</h4>
                        </div>

                    @else

                        <div class="medium-4 columns">
                            <a href="/albums/{{ $album->id }}">
                                {{--<img class="thumbnail" src="/images/album_covers/{{$album->cover_image}}" alt="{{ $album->name }}">--}}

                                {{--Using storage--}}
                                <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{ $album->name }}">
                            </a>
                            <br>
                            <h4>{{ $album->name }}</h4>
                        </div>

                    @endif

                    @if($i % 3 == 0)
                        </div>
                        <div class="row text-center">

		                 <?php $i = 1; ?>

                   {{-- @else
                        </div>--}}
                    @endif

                    <?php $i++; ?>

                @endforeach

            </div>
        </div>

    @else

        <p>No Albums To Display</p>

    @endif

@endsection