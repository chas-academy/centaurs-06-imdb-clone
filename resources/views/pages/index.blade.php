@extends('layouts.layout') @section('content')
        <header class="small-header">
            <div class="row flex-align">
                <div class="small-6 cell">
                    <img id="logo" src="{{ asset('img/imdbLogo.png') }}" alt="imdb-logo">
                </div>
                <div class="small-6 cell">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row flex-align">
                <div class="small-6 cell">
                    <select name="genre" id="genre" class="sortBtn">
                        <option value="">Genre</option>
                        <option value="">Genre</option>
                        <option value="">Genre</option>
                        <option value="">Genre</option>
                        <i class="fa fa-chevron-down fa-fix"></i>
                    </select>
                </div>
                <div class="small-6 cell">
                    <select name="sortBy" id="sortBy" class="sortBtn">
                        <option value="">Sorted By</option>
                        <option value="">Sorted By</option>
                        <option value="">Sorted By</option>'
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
        </header>
           <!-- Section with three small movieposters -->
    <section class="grid-x padding-15">
        <div class="row m-left">
            <div class="rate-score">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="num-rate">8.1</p>
            </div>
                <img src="http://via.placeholder.com/90x150">
                <h3 class="movie-title">Title</h3>
            </div>
        <div class="row">
            <div class="rate-score">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="num-rate">4.8</p>
            </div>
                <img src="http://via.placeholder.com/90x150">
                <h3 class="movie-title">Title</h3>
            </div>
        <div class="row m-right">
            <div class="rate-score">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="num-rate">7.5</p>
            </div>
                <img src="http://via.placeholder.com/90x150">
                <h3 class="movie-title">Title</h3>
            </div>
    </section>
            <!-- Section with one big poster -->
    <section class="grid-x" style="margin-top:20px;">
        <div class="row">
            <img src="http://via.placeholder.com/290x400">
        <div>
    </section>

  @endsection 