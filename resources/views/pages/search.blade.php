@extends('layouts.layout') 
@section('content')
<div class="off-canvas-content" data-off-canvas-content>
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12 flex-align-sb-c">
        <form class="small-12 flex-align-sb-c fast" id="search" data-toggler=".visible" data-animate="fade-in fade-out" method="get" action="/search">
            <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more..." name="q">
        </form>
        @forelse ($results as $hits)
            @foreach ($hits as $hit)

            <li>
                <p>{{ print_r($hit['hits']) }}</p>
            </li>
            @endforeach
        @empty
            <p>No results found.</p>
        @endforelse
    </section>
</main>
@include('includes.footer')
</div>
@endsection
