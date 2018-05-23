@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
    @include('includes.messages')
    @include('includes.errors')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12 flex-align-sb-c">
    
    @if(Auth::check())
        @if(Auth::user()->type === 'admin')
            @if(isset($users))
                <ul>
                @foreach ($users as $key => $user)
                    <li> 
                    <p>Update info for {{$user['name']}}</p>
                    <form method="POST" action="/updateuser/{{$user['id'] }}">
                    {{ csrf_field() }}
                    <Input
                    name="name"
                    type="text"
                    placeholder={{$user['name']}}
                    />
                    <Input
                    name="email"
                    type="text"
                    placeholder={{$user['email']}}
                    />
                    <button class="admin-btn" type='submit'>Save</button>
                    </form>
                    <form action="/delete-account/{{$user['id']}}" method="GET">
                        <button class="btn-admindelete" type="submit">Delete user</button>
                    </form>
                    </li>   
                
                @endforeach
                </ul>
                <form  class="small-12" method="POST" action="/adduser">
                    {{ csrf_field() }}
                    <label>
                        <input type="text" name="name" placeholder="Name" required>
                        <span class="form-error">Please fill in name.</span>
                    </label>

                    <label>
                        <input type="email" name="email" placeholder="Email" required>
                        <span class="form-error">Invalid email.</span>
                    </label>

                    <label>
                        <input type="password" name="password" placeholder="Password" required>
                        <span class="form-error">Fill in password, must be atleast 6 characters long.</span>
                    </label>

                    <label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="form-error">Please confirm password.</span>
                    </label>

                    <div class="small-12 btn">
                        <button type="submit" class="admin-btn">Create Account</button>
                    </div>
                </form>
            @endif
        @endif
    @endif
    </select>
</main>
@include('includes.footer')
</div>
@endsection 

@section('page-scripts')


@endsection