<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}" />
  <title>@yield('title') - Friends+</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap/paper.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/css/main.css" />
  @yield('stylesheets')
</head>
<body>

  @include('partials.navbar')

  @yield('content_outside_container')
  
  <div class="container">

    @include('partials.alerts')

    <div class="main-container">
      @yield('main_content')
    </div>

    @include('partials.footer')

  </div>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/modules/friend_system.js"></script>
@yield('scripts')
</body>
</html>