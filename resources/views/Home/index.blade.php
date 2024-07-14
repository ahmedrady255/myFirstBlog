@extends('layout.master')
@section('title','Home')

@section('content')
    <style>
    .body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
        background: #ffffff;
    }
    .welcome-container {
        padding: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        text-align: center;
        max-width: 40%;
        max-height: 20%;
        margin-top: 100px;
    }
    .welcome-container h1 {
        margin-bottom: 30px;
    }
    .welcome-container button {
        padding: 10px 20px;
        margin: 10px;
        border: none;
        background-color: #5cb85c;
        color: white;
        cursor: pointer;
        border-radius: 5px;
    }
    .welcome-container button:hover {
        background-color: #4cae4c;
    }
</style>
    @if(Route::has('login'))
        @auth
     <h1 class="text-center">Welcome to home page</h1>
        @else
     <center>
         <div class="welcome-container">
            <h1>Welcome!</h1>
            <button onclick="location.href='{{url('/login')}}'">Login</button>
            <button onclick="location.href='{{url('/register')}}'">Register</button>
         </div>
     </center>
        @endauth
    @endif
@endsection
