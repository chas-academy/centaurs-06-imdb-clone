@extends('layouts.layout')
@section('content')
@include('includes.messages')
@include('includes.errors')

<?php $user = Auth::user(); ?>

<header id="desk-hide" class="row">
    <div id="desk-hide" class="small-12 header-flex-align-sb-c">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <form class="small-12 header-flex-align-sb-c fast" id="search" data-toggler=".visible" data-animate="fade-in fade-out">
        <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more...">
    </form>
</header>

    <main class="row off-canvas-content">
    @include('includes.menu-btn')
    @forelse($reviews as $review)
    <div class="small-12 watchlist-movie">
        <div id="approve-review-container" class="small-12 flex-align-c-c">
            <div class="small-12 review-rate">
                    <div>
                    @if($review->review_rating === 0.5)
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    @elseif($review->review_rating === 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 1.5)
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 2)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 2.5)
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 3)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 3.5)
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 4)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 4.5)
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($review->review_rating === 5)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @endif
                    </div>
                        <a href="/approve/review/{{ $review->id }}"><i class="fa fa-check approve-review" aria-hidden="true"></i></a>
                        <a href="/delete/review/movie/{{ $review->id  }}"><i class="fa fa-close delete-review" aria-hidden="true"></i></a>
                </div>
                <h3 class="review-title">{{ $review->title }}</h3>
                <div class="small-12 review-description">
                    <div class="small-12 review-info">
                        <p class="review-auth"><b>Author:</b> {{ $review->author->name }} </p>
                        <p class="review-date"><b>Date:</b> {{ $review->updated_at }}</p>
                    </div>
                    <div class="small-12">
                        <p class="review-content">
                            {{ $review->content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
        <p>No pending reviews to handle currently!</p>
    @endforelse
   	</main>
	@include('includes.footer')
</div>

@endsection