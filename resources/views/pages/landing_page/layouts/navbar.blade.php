<header class="main-header">
    <!-- logo -->
    <a class="logo-holder" href="/"><img src="{{asset('balkon/images/tiaralogo.png')}}" alt=""></a>
    <!-- logo end -->  
    <!-- share button-->  
    {{-- <div class="show-share-wrap">
        <a href="{{route('auth.login')}}"><div class="show-share"><span>Login</span><img src="{{asset('balkon/images/login.png')}}" alt=""></div></a>
    </div> --}}
    <!-- share button end-->  		
    <!-- search button--> 	 
    {{-- <div class="show-search show-fixed-search vissearch"><i class="fa fa-search"></i></div> --}}
    <!-- search button end --> 
    <!-- mobile nav --> 
    <div class="nav-button-wrap">
        <div class="nav-button vis-main-menu"><span></span><span></span><span></span></div>
    </div>
    <!-- mobile nav end--> 
    <!--  navigation --> 
    <div class="nav-holder">
        <nav>
            <ul>
                <li>
                    <a href="/" class="{{ (Request::is('/') ? 'act-link' : '') }}">Home </a>
                </li>
                <li>
                    <a href="{{route('landing.services')}}" class="{{ (Request::is('services') ? 'act-link' : '') }}">Services</a>
                </li>
                <li>
                    <a href="{{route('landing.portofolio')}}" class="{{ (Request::is('portofolio') ? 'act-link' : '') }}">Portfolio</a>
                </li>
                <li>
                    <a href="{{route('landing.about')}}" class="{{ (Request::is('about') ? 'act-link' : '') }}">About</a>
                </li>
                <li>
                    <a href="{{route('landing.contacts')}}" class=" {{ (Request::is('contacts') ? 'act-link' : '') }}">Contacts </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- navigation  end -->
</header>