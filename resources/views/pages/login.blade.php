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
        </header>
    </div>
    <!-- footer/menu --> 
    <footer class="row">
        <div class ="small-12 footer">
            <h1 class="white">Log in</h1>
            <h1 class="white">Create account</h1>
            <div class="place">
                <div class="circle">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </footer>

@endsection 