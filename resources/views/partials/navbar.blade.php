<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Friends+</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav navbar-left">

            @if(Auth::check())
              <li>
                <a href="/">
                  <span class="glyphicon glyphicon-home"></span> 
                  <span class="hidden-sm">Home</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="/messages" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-envelope"></span> 
                  <span class="hidden-sm">Messages</span>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"><img src="/assets/img/navbar_loading.gif" /> Loading...</li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="/requests" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-user"></span> 
                  <span class="hidden-sm">Requests</span>
                  <span class="label label-warning">2</span> 
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"><img src="/assets/img/navbar_loading.gif" /> Loading...</li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="/notifications" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-bell"></span> 
                  <span class="hidden-sm">Notifications</span>
                  <span class="label label-warning">2</span> 
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"><img src="/assets/img/navbar_loading.gif" /> Loading...</li>
                </ul>
              </li>
            @endif

          </ul>

          <ul class="nav navbar-nav navbar-right">

            @if(Auth::check())

              <li>
                <form class="navbar-form" role="search" action="{{ route('search.results') }}">
                    <input type="text" class="form-control" placeholder="Search for people..." name="q" autocomplete="off" value="{{ Route::is('search.results') ? Request::get('q') : '' }}">
                </form>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Hi, <strong>{{ Auth::user()->getUsername() }}</strong> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="/profile">
                    <strong>{{ Auth::user()->getName() }}</strong>
                    <br />
                    View Profile
                  </a></li>
                  <li class="divider"></li>
                  <li><a href="/find-friends">Find Friends</a></li>
                  <li><a href="/help">Help Center</a></li>
                  <li><a href="/settings">Settings</a></li>
                  <li><a href="{{ route('auth.logout') }}">Log Out</a></li>
                </ul>
              </li>
            @else

              <form class="navbar-form login" method="post" action="{{ route('auth.login') }}">
                <div class="form-group">
                  <input type="text" required placeholder="Username/Email" class="form-control" name="login"  value="{{ old('login') }}"  />
                </div>
                <div class="form-group">
                  <input type="password" required placeholder="Password" class="form-control" name="password" />
                </div>
                &nbsp;
                <button type="submit" class="btn btn-default">Log In</button>&nbsp; 
                @if(!Request::is('home'))
                  <a href="{{ route('auth.signup') }}" class="btn btn-warning"><strong>Sign Up</strong></a>
                @endif
                {!! csrf_field() !!}
              </form>

            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>