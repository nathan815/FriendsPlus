<!DOCTYPE html>
<html>
<head>
  <title>@yield('title') - Friends+</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://bootswatch.com/paper/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/main.css" rel="stylesheet">
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
@yield('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>