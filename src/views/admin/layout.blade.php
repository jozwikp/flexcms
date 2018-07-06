<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="has-navbar-fixed-top">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <title>Flexcms - {{ config('app.name', 'Laravel') }}</title>

    @yield('css')

  </head>
  <body >

    <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
      <div class="container">

        <div class="navbar-brand">
          <a class="navbar-item" href="/">
            Your project
          </a>

          <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>

        <div class="navbar-menu large-space-menu" id="navMenu">
          <div class="navbar-start">

            <a href="/flexcms" class="navbar-item">
              Start
            </a>
            <a href="{{route('list.create')}}" class="navbar-item">Dodaj listę</a>
            <a href="{{route('page.create')}}" class="navbar-item">Dodaj stronę</a>
            <a href="{{route('user.index')}}" class="navbar-item">Użytkownicy</a>
            <a href="{{route('author')}}" class="navbar-item">Autor</a>
            <a class="navbar-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Wyloguj
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </nav>

    <div class="container no-cover-photo">
      @if(!empty($errors))
        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      @endif

      @if (session('status'))
        <div class="container">
          <div class="notification is-info">
              <h4>{{ session('status') }}</h4>
          </div>
        </div>
      @endif

       @yield('content')
    </div>

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
      @yield('script')

  </body>
</html>
