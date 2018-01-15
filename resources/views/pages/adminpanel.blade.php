@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.admin-header')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12">
        <p style="color: white">{{$message['error'] or ''}}</p>
    </section>
    <section class="small-12">
    	
    </section>
</main>
</div>
@include('includes.admin-offcanvas')
@endsection 