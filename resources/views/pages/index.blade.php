@extends('layouts.layout') @section('content')
<div class="grid-x">
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
                
                </select>
            </div>
            <div class="small-6 cell">
                <select name="sortBy" id="sortBy" class="sortBtn">
                
                </select>
            </div>
        </div>
    </header>
</div>
@endsection