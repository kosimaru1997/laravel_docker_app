<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('javascript')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="/css/memo.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="row m-0">
                <div class="col-md-2 p-0">
                    <div class="card">
                        <div class="card-header">タグ一覧</div>
                        <a href="/memo" class="card-text d-block mt-2 mx-2">すべてのメモを表示</a>
                        <div class="card-body memo-card-body pt-1">
                    @foreach($tags as $tag)
                        <div class="d-flex">
                            <a href="/memo/?tag={{$tag['id']}}" class="card-text d-block elipsis mb-2 mx-2">
                                <span class="border rounded px-2">{{ $tag['name'] }}</span>
                            </a>
                            <form id="delete-form" action="{{ route('destroy_tag') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tag_id" value="{{$tag['id']}}"/>
                                <i class="fas fa-times cursor-p" onclick="deleteHandle(event);"></i>
                            </form>
                        </div>
                    @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">メモ一覧 <a href="{{ route('memo') }}"><i class="fas fa-plus-circle"></i></a></div>
                        <div class="card-body memo-card-body">
                    @foreach($memos as $memo)
                          <a href="{{ route('edit',['id'=>$memo])}}" class="card-text d-block elipsis mb-2">{{ $memo['content'] }}</a>
                    @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>