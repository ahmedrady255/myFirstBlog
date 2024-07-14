<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>@yield('title','unknown page')</title>
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('home.index')}}">Blog-test</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(Route::has('login'))
                    @auth
                @if(Auth::user()->is_admin==1)
                  <li class="nav-item">
                  <a class="nav-link" href="{{route("dashboard.index")}}">Dashboard</a>
                     </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("posts.index")}}">All posts</a>
                    </li>
                    </ul>
               @else
                   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("posts.index")}}">My posts</a>
                    </li>
                   </ul>
              @endif
              <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 700px">

                    <li class="nav-item">
                        <a href="" class="nav-link">{{Auth::user()->name}}</a>
                    </li>
                     <li class="nav-item">
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf

                             <button class="nav-link">logout</button>

                         </form>
                     </li>
                      @endauth
                  @endif
              </ul>

            <form class="d-flex"  action="{{route("dashboard.search")}}" method="post">
                @csrf
              <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>

        </div>
      </nav>
</head>
<body >           {{-- content start --}}
    <div>
     @yield('content')
    </div>
</body>
</html>
