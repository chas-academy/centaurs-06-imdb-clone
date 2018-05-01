@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
<main class="row">
    @include('includes.menu-btn')
    @if (isset($message['error']))

    <section class="small-12" id="statusMsg">
        <p style="color: white">{{$message['error'] or ''}}</p>
    </section>
    @endif

    <section class="small-12 flex-align-sb-c">
        @if(isset($hits))
            @foreach ($hits['results'] as $key => $tvshow)
                <div id="clickable" class="movie-poster">
                    <div class="movie-rating">
                        <p class="rating-num">{{ $tvshow['vote_average'] }}</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <a href="apitvshow/add/{{$tvshow['id']}}" class="none confirm-tv">
                        @if($tvshow['poster_path'] === null)
                        <img class="poster-size" src="/img/missingposter/missingposter.png" >
                        <p class="movie-title">{{$tvshow['name']}}</p>
                        @else
                        <img class="poster-size" src="<?= config('app.poster_url') . $tvshow['poster_path']; ?>" />
                        @endif
                    </a>

                </div>
            @endforeach
        @endif
        </select>
</main>
@include('includes.footer')
</div>
@endsection

@section('page-scripts')


@endsection