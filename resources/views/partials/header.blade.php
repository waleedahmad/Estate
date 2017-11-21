<!-- Start Header -->
<header class="navbar yamm navbar-default navbar-fixed-top">
    <div class="topBar">
        <div class="container">
            <p class="topBarText"><img class="icon" src="/images/icon-phone.png" alt=""/>{{\App\Config::where('name', '=', 'phone')->first()->value}}</p>
            <p class="topBarText"><img class="icon" src="/images/icon-mail.png" alt=""/>{{\App\Config::where('name', '=', 'email')->first()->value}}</p>
            <ul class="socialIcons">
                <li><a target="_blank" href="{{\App\Config::where('name', '=', 'facebook')->first()->value}}"><img src="/images/icon-fb.png" alt=""/></a></li>
                <li><a target="_blank" href="{{\App\Config::where('name', '=', 'twitter')->first()->value}}"><img src="/images/icon-twitter.png" alt=""/></a></li>
                <li><a target="_blank" href="{{\App\Config::where('name', '=', 'google_plus')->first()->value}}"><img src="/images/icon-google.png" alt=""/></a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"> {{\App\Config::where('name', '=', 'app_name')->first()->value}}<span>Estate</span></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/" @if(Request::is('/'))class="current" @endif>HOME</a>
                </li>

                <li>
                    <a href="/listings" @if(Request::is('listings'))class="current" @endif>LISTINGS</a>
                </li>
                <li>
                    <a href="/agents" @if(Request::is('agents'))class="current" @endif>AGENTS</a>
                </li>

                @if(Auth::check())
                    @if(Auth::user()->type === 'user' || Auth::user()->type === 'agent' )
                        <li>
                            <a href="/user/submit_property" @if(Request::is('user/submit_property'))class="current" @endif>SUBMIT</a>
                        </li>
                    @endif
                @endif

                <li>
                    <a href="/contact" @if(Request::is('contact'))class="current" @endif>CONTACT</a>
                </li>
                <li class="dropdown">
                    <ul class="nav navbar-nav userButtons">
                        <li>
                            <div class="verticalDivider"></div>
                        </li>


                        @if(Auth::check())

                            @if(Auth::user()->type === 'admin')
                                <li>
                                    <a href="/admin" class="dropdown-toggle buttonGrey">
                                        Dashboard ({{Auth::user()->type}})
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="/user/messages">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="/user/dashboard" class="dropdown-toggle buttonGrey">
                                        Dashboard ({{Auth::user()->type}})
                                    </a>
                                </li>
                            @endif

                            <li><a href="/logout" class="dropdown-toggle buttonGrey">Logout</a></li>
                        @else
                            <li><a href="/login" class="dropdown-toggle buttonGrey">LOGIN</a></li>
                            <li><a style="margin-right:0px;" href="/register" class="dropdown-toggle buttonGrey">REGISTER</a>
                        @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div><!-- end header container -->
</header><!-- End Header -->

