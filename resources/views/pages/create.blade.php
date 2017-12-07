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


    <section class="row">
        <div class ="small-12 create-acc">
            <h1 class="white">Create account</h1>
            <form action="/" class="form">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="password" placeholder="Confirm Password">
                <button type="submit">Done</button>
            </form>        
        </div>
    </section


@endsection 