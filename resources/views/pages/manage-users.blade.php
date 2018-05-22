@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
    @include('includes.messages')
    @include('includes.errors')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12 flex-align-sb-c">
        @if(isset($users))
            @foreach ($users as $key => $user)
            <div>
                <h1>{{$user['id']}}</h1>
                <h2>{{$user['name']}}</h2>
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